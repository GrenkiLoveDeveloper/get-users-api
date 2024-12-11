<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

abstract class QueryFilter
{
    /**
     * The builder instance.
     *
     * @var \Illuminate\Database\Eloquent\Builder
     */
    protected Builder $builder;

    /**
     * @var string
     */
    protected string $delimiter = ',';

    public Request|Collection $request;

    /**
     * Initialize a new filter instance.
     *
     * @param \Illuminate\Http\Request|\Illuminate\Support\Collection $request
     */
    public function __construct(Request|Collection $request)
    {
        $this->request = $request;
    }

    /**
     * Получение всех фильтров из запроса
     */
    public function filters(): array
    {
        return $this->request->all();
    }

    /**
     * Apply the filters on the builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Builder $builder): Builder
    {
        $this->builder = $builder;

        foreach ($this->filters() as $name => $value) {
            if (method_exists($this, $name)) {
                call_user_func_array([$this, $name], array_filter([$value]));
            }
        }

        return $this->builder;
    }

    protected function paramToArray($param)
    {
        return explode($this->delimiter, $param);
    }
}
