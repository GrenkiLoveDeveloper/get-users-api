<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BasePaginationResourceCollection extends ResourceCollection
{
    /**
     * Class BasePaginationResourceCollection
     *
     * @param mixed $resource The data resource for the collection
     * @param class-string|null $collects Specifies the resource class to collect (optional)
     */
    public function __construct(mixed $resource, ?string $collects = null)
    {
        $this->collects = $collects;
        parent::__construct($resource);
    }

    /**
     * Transform the resource collection into an array.
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }

    /**
     * Настройка информации о постраничной навигации для ресурса.
     *
     * @param \Illuminate\Http\Request $request
     * @param array $paginated
     * @param array $default
     * @return array
     */
    public function paginationInformation(Request $request, array $paginated, array $default)
    {
        return [
            'meta' => [
                'current_page' => $default['meta']['current_page'],
                'per_page' => $default['meta']['per_page'],
                'total' => $default['meta']['total'],
            ],
        ];
    }
}
