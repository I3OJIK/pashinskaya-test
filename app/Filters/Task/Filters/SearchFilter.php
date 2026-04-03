<?php

namespace App\Filters\Task\Filters;

use Illuminate\Database\Eloquent\Builder;

class SearchFilter
{
    /**
     * Поиск по title
     * 
     * @param Builder $query
     * @param string $searchTerm
     * 
     * @return Builder
     */
    public function apply(Builder $query, string $searchTerm): Builder
    {
        return $query->where('title', 'LIKE', "%{$searchTerm}%");
    }
}