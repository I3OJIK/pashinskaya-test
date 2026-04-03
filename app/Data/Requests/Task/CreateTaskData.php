<?php

namespace App\Data\Requests\Task;

use App\Enums\TaskStatus;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Enum;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Data;

class CreateTaskData extends Data
{
    public function __construct(
        #[Min(10), Max(150)]
        public string $title,
        
        #[Max(1000)]
        public ?string $description = null,

        #[Enum(TaskStatus::class)]
        public TaskStatus $status,
    ) {}
    
}