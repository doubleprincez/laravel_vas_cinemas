<?php

namespace Modules\Movie\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Movie\Entities\Genre;

class MovieFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Movie\Entities\Movie::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'genre_id' => $this->faker->randomElement(Genre::pluck('id')->toArray()),
            'title' => $this->faker->sentence(5),
            'movie_length' => $this->faker->numberBetween(20, 250),
            'release_year' => $this->faker->dateTime,
            'available' => $this->faker->boolean
        ];
    }
}

