<?php

namespace App\Filters\Task;

use App\Filters\Task\Abstracts\BaseFilter;
use App\Filters\Task\Filters\SearchFilter;
use App\Filters\Task\Filters\StatusFilter;

class TaskFilter extends BaseFilter
{
    protected array $filters = [
        'search' => SearchFilter::class,
        'status' => StatusFilter::class,
    ];


}