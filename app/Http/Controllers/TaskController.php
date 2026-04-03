<?php

namespace App\Http\Controllers;

use App\Data\Requests\Task\CreateTaskData;
use App\Data\Requests\Task\TaskFilterData;
use App\Data\Requests\Task\UpdateTaskData;
use App\Enums\TaskStatus;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function __construct(
        private TaskService $taskService
    ) {}

    /**
     * Все задачи
     * 
     * @param TaskFilterData $data
     * 
     * @return View
     */
    public function index(TaskFilterData $data): View
    {
        $tasks = $this->taskService->getTasks($data);

        return view('tasks.index', [
            'tasks' => $tasks,
        ]);
    }

    /**
     * Форма создания задачи
     * 
     * @return View
     */
    public function create(): View
    {
        $statuses = TaskStatus::forSelect();
        
        return view('tasks.create', [
            'statuses' => $statuses,
        ]);
    }

    /**
     * Сохранение новой задачи
     * 
     * @param CreateTaskData $data
     * 
     * @return RedirectResponse
     */
    public function store(CreateTaskData $data): RedirectResponse
    {
        try {
            $task = $this->taskService->createTask($data);
            
            return redirect()
                ->route('tasks.show', $task)
                ->with('success', 'Задача успешно создана!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Ошибка при создании задачи: ' . $e->getMessage());
        }
    }

    /**
     * Просмотр одной задачи
     * 
     * @param Task $task
     * 
     * @return View
     */
    public function show(Task $task): View
    {
        $statuses = TaskStatus::forSelect();
        
        return view('tasks.show', [
            'task' => $task,
            'statuses' => $statuses,
        ]);
    }

    /**
     * Форма редактирования задачи
     * 
     * @param Task $task
     * 
     * @return View
     */
    public function edit(Task $task): View
    {
        $statuses = TaskStatus::forSelect();
        
        return view('tasks.edit', [
            'task' => $task,
            'statuses' => $statuses,
        ]);
    }

    /**
     * Обновление задачи
     * 
     * @param UpdateTaskData $data
     * @param Task $task
     * 
     * @return RedirectResponse
     */
    public function update(UpdateTaskData $data, Task $task): RedirectResponse
    {
        try {
            $updatedTask = $this->taskService->updateTask($task, $data);
            
            return redirect()
                ->route('tasks.show', $updatedTask)
                ->with('success', 'Задача успешно обновлена!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Ошибка при обновлении задачи: ' . $e->getMessage());
        }
    }

    /**
     * Удаление задачи
     * 
     * @param Task $task
     * 
     * @return RedirectResponse
     */
    public function destroy(Task $task): RedirectResponse
    {
        try {
            $this->taskService->deleteTask($task);
            
            return redirect()
                ->route('tasks.index')
                ->with('success', 'Задача успешно удалена!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Ошибка при удалении задачи: ' . $e->getMessage());
        }
    }
}
