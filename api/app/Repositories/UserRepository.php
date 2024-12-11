<?php

namespace App\Repositories;

use App\Http\Filters\UserFilter;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserRepository
{
    /**
     * Получить пользователя по ID.
     *
     * @param int $id
     * @return User|null
     */
    public function findById(int $id): ?User
    {
        return User::with('option')->find($id);
    }

    /**
     * Получить всех пользователей с фильтрацией.
     *
     * @param UserFilter $filter
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllWithFilter(UserFilter $filter): LengthAwarePaginator
    {
        return User::filter($filter)->with('option')->paginate(10);
    }
}
