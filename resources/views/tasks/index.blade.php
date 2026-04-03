@extends('layouts.app')

@section('title', 'Список задач')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Список задач</h1>

    <!-- Блок поиска и фильтрации -->
    <div class="mb-6 p-4 bg-gray-50 rounded-lg">
        <form method="GET" action="{{ route('tasks.index') }}" class="flex flex-col md:flex-row gap-4">
            <!-- Поле поиска -->
            <div class="flex-1">
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}"
                       placeholder="Поиск по названию..."
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Фильтр по статусу -->
            <div class="w-full md:w-48">
                <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Все статусы</option>
                    <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>Новая</option>
                    <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>В работе</option>
                    <option value="done" {{ request('status') == 'done' ? 'selected' : '' }}>Выполнена</option>
                </select>
            </div>

            <!-- Кнопки -->
            <div class="flex gap-2">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition">
                    Найти
                </button>
                <a href="{{ route('tasks.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition">
                    Сбросить
                </a>
            </div>
        </form>
    </div>

    <!-- Информация о фильтрах -->
    @if(request()->has('search') || request()->has('status'))
        <div class="mb-4 text-sm text-gray-600">
            Найдено: {{ $tasks->total() }} записей
            @if(request('search'))
                по запросу "{{ request('search') }}"
            @endif
            <a href="{{ route('tasks.index') }}" class="text-blue-500 hover:text-blue-700 ml-2">
                ✕ Очистить фильтры
            </a>
        </div>
    @endif

    <!-- Таблица задач -->
    @if($tasks->isEmpty())
        <div class="text-center py-8">
            <p class="text-gray-500 mb-4">Нет задач</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-100 border-b">
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">ID</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Название</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Статус</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Создано</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Обновлено</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3 text-sm">{{ $task->id }}</td>
                        <td class="px-4 py-3">
                            <a href="{{ route('tasks.show', $task) }}" class="text-blue-600 hover:text-blue-800 font-medium">
                                {{ $task->title }}
                            </a>
                        </td>
                        <td class="px-4 py-3">
                            <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                {{ $task->status->label() }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-600">{{ $task->created_at->format('d.m.Y H:i') }}</td>
                        <td class="px-4 py-3 text-sm text-gray-600">{{ $task->updated_at->format('d.m.Y H:i') }}</td>
                        <td class="px-4 py-3">
                            <div class="flex gap-2">
                                <a href="{{ route('tasks.show', $task) }}" 
                                   class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm transition">
                                    Просмотр
                                </a>
                                <a href="{{ route('tasks.edit', $task) }}" 
                                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm transition">
                                    Ред.
                                </a>
                                <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm transition"
                                            onclick="return confirm('Удалить задачу?')">
                                        Удалить
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Пагинация -->
        @if(method_exists($tasks, 'links') && $tasks->hasPages())
            <div class="mt-6">
                {{ $tasks->links() }}
            </div>
        @endif
    @endif
</div>
@endsection