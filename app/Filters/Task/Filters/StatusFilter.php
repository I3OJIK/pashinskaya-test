<?php

namespace App\Filters\Task\Filters;

use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Builder;

class StatusFilter
{
    /**
     * Фильтрация по статусу задачи
     * 
     * @param Builder $query
     * @param string $status
     * 
     * @return Builder
     */
    public function apply(Builder $query, string $status): Builder
    {
        return $query->where('status', $status);
    }
}