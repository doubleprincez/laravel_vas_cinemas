<?php

namespace Modules\Cinema\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\User\Entities\User;

class CinemaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Cinema\Entities\Cinema::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->sentence(5);
        return [
            'name' => $name,
            'manager_id' => $this->faker->randomElement(User::pluck('id')->toArray()),
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'seat_capacity' => $this->faker->numberBetween(300, 500),
            'other_details' => $this->faker->sentence(30),
            'in_use' => $this->faker->boolean
        ];
    }
}

