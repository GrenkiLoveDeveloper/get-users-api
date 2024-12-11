<?php

namespace Database\Factories;

use App\Models\UserOption;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserOption>
 */
class UserOptionFactory extends Factory
{
    protected $model = UserOption::class;

    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'ip' => fake()->ipv4(),
            'comment' => fake()->sentence(),
        ];
    }
}
