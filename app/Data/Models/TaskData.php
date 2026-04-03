<?php

namespace App\Data\Models;

use App\Enums\TaskStatus;
use Spatie\LaravelData\Data;

class TaskData extends Data
{
    public function __construct(
        public int $id,

        public string $title,

        public ?string $description,

        public TaskStatus $status,

        public string $created_at,

        public string $updated_at,
    ) {}
}