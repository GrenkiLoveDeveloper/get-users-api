<?php

namespace App\Http\Filters;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;

final class UserFilter extends QueryFilter
{
    /**
     * Фильтр по имени
     *
     * @param string|null $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function name(?string $value = null): Builder
    {
        return $this->builder->where('name', 'like', "%{$value}%");
    }

    /**
     * Сортировать пользователей по указанному полю и порядку.
     *
     * @param array $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function sort(array $value = []): Builder
    {
        $allowedFields = $this->getAllowedSortFields();

        /** по умолчанию name */
        $sortBy = $value['by'] ?? 'name';
        $sortOrder = strtolower($value['order'] ?? 'asc');

        /** можем ли сортировать по этому имени если нет откатываем до name */
        if (!in_array($sortBy, $allowedFields, true)) {
            $sortBy = 'name';
        }

        $sortOrder = in_array($sortOrder, ['asc', 'desc']) ? $sortOrder : 'asc';

        return $this->builder->orderBy($sortBy, $sortOrder);
    }

    /**
     * Разрешенные поля для сортировки
     *
     * @return array
     */
    protected function getAllowedSortFields(): array
    {
        return array_merge(
            $this->builder->getModel()->getFillable(),
            ['created_at', 'updated_at']
        );
    }
}
