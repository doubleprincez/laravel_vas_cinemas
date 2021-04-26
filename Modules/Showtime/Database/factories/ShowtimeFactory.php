<?php

namespace Modules\Showtime\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Cinema\Entities\Cinema;
use Modules\Movie\Entities\Movie;

class ShowtimeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Showtime\Entities\Showtime::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
//            'cinema_id' => $this->faker->randomElement(Cinema::pluck('id')->toArray()),
//            'movie_id' => $this->faker->randomElement(Movie::pluck('id')->toArray()),
            'start_time' => $this->faker->dateTimeBetween('now', '30 days')
        ];
    }
}

