<?php

namespace Modules\Movie\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Cinema\Entities\Cinema;
use Modules\Image\Entities\Image;
use Modules\Movie\Entities\Genre;
use Modules\Movie\Entities\Movie;
use Modules\Showtime\Entities\Showtime;
use Modules\Town\Entities\Town;

class MovieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Genre::count() < 1) {
            $genres = ['Action', 'Narrative', 'Science Fiction', 'Animation', 'Comedy', 'Fantasy'];
            foreach ($genres as $genre) {
                Genre::create([
                    'name' => $genre
                ]);
            }

        }
        $now = Carbon::now();

        if (Genre::count() > 0 && Movie::count() < 1 && Town::count() > 0) {
            $town = Town::where('code', 'lagos')->first();
            $cinemas = Cinema::factory()->count(3)->has(Image::factory()->count(1))->create(['town_id' => $town->id]);
            foreach ($cinemas as $cinema) {
                $movies = Movie::factory()->count(10)->has(Image::factory()->count(1))->create()->each(function ($m) use ($cinema) {
                    $m->cinema()->attach($cinema->id);
                });
                foreach ($movies as $movie) {
                    $rand = random_int(1, 20); // this is only available from php v 7.0+
                    Showtime::create(['movie_id' => $movie->id, 'cinema_id' => $cinema->id, 'start_time' => $now->addDays($rand)]);
                }
            }


        }
    }
}
