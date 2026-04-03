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
     * @param TaskStatus $status
     * 
     * @return Builder
     */
    public function apply(Builder $query, TaskStatus $status): Builder
    {
        return $query->where('status', $status->value);
    }
}