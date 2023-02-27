<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(503,1002),
            'company_id' => $this->faker->numberBetween(1,500),
            'user_email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'price' => $this->faker->numberBetween(50,220),
            'date' => $this->faker->unique()->date(),
            'status'=>$this->faker->randomElement(['completed','pending','in progress'])
        ];
    }
}
