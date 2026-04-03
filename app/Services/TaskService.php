<?php

namespace App\Services;

use App\Data\Requests\Task\CreateTaskData;
use App\Data\Requests\Task\TaskFilterData;
use App\Data\Requests\Task\UpdateTaskData;
use App\Filters\Task\TaskFilter;
use App\Models\Task;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TaskService
{
    public function __construct(
        private TaskFilter $taskFilter
    )
    {}

    /**
     * Получить список задач с фильтрацией и пагинацией
     * 
     * @param TaskFilterData $filterData
     * 
     * @return LengthAwarePaginator
     */
    public function getTasks(TaskFilterData $data): LengthAwarePaginator
    {
        $query = Task::query();

        // Применяем фильтры
        $this->taskFilter->apply($query, $data->toArray());

        // Получаем пагинированный результат
        return $query->paginate($data->per_page);
    }

    /**
     * Получить задачу по ID
     * 
     * @param int $id
     * 
     * @return Task|null
     */
    public function getTaskById(int $id): ?Task
    {
        return Task::findOrFail($id);
    }

    /**
     * Создать новую задачу
     * 
     * @param CreateTaskData $data
     * 
     * @return Task
     */
    public function createTask(CreateTaskData $data): Task
    {
        $task = Task::create([
            'title' => $data->title,
            'description' => $data->description,
            'status' => $data->status,
        ]);

        return $task;
    }

    /**
     * Обновить задачу
     * 
     * @param Task $task
     * @param UpdateTaskData $data
     * 
     * @return Task
     */
    public function updateTask(Task $task, UpdateTaskData $data): Task
    {
        $task->update([
            'title' => $data->title,
            'description' => $data->description,
            'status' => $data->status,
        ]);

        return $task;
    }

    /**
     * Удалить задачу
     * 
     * @param Task $task
     * 
     * @return bool
     */
    public function deleteTask(Task $task): bool
    {
        $deleted = $task->delete();

        return $deleted;
    }

}
