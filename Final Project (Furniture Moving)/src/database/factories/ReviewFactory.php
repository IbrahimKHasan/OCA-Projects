<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'user_id' => $this->faker->unique()->numberBetween(503,1002),
            'company_id' => $this->faker->numberBetween(1,500),
            'review_body' => $this->faker->text(),
            'review_rate' => $this->faker->numberBetween(1,5),

        ];
    }
}
