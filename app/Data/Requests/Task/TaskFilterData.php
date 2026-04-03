<?php

namespace App\Data\Requests\Task;

use App\Enums\TaskStatus;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Enum;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Data;

class TaskFilterData extends Data
{
    public function __construct(
        public ?string $search = null,

        #[Enum(TaskStatus::class)]
        public ?TaskStatus $status = null,

        #[Min(20), Max(100)]
        public ?int $perPage = 20,
    ) {}
    
}