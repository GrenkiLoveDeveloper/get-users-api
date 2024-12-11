<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * Создание пользователя
     *
     * @param array $data
     * @return User
     */
    public function createUser(array $data): User
    {
        return DB::transaction(function () use ($data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            $user->option()->create([
                'ip' => $data['ip'] ?? request()->ip(),
                'comment' => $data['comment'] ?? null,
            ]);

            return $user->load('option');
        });
    }

    /**
     * Обновление пользователя
     *
     * @param User $user
     * @param array $data
     * @return User
     */
    public function updateUser(User $user, array $data): User
    {
        return DB::transaction(function () use ($user, $data) {
            if (!empty($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            }

            $user->update($data);

            if (isset($data['ip']) || isset($data['comment'])) {
                $user->option()->updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'ip' => $data['ip'] ?? $user->option->ip,
                        'comment' => $data['comment'] ?? $user->option->comment,
                    ]
                );
            }

            return $user->load('option');
        });
    }

    /**
     * Удаление пользователя.
     *
     * @param User $user
     * @return void
     */
    public function deleteUser(User $user): void
    {
        $user->delete();
    }
}
