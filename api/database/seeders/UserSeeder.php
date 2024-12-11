<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserOption;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(10)->create()->each(function ($user) {
            UserOption::factory()->create([
                'user_id' => $user->id,
            ]);
        });
    }
}
