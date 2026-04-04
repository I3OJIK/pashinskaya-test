@extends('layouts.app')

@section('title', 'Просмотр задачи #' . $task->id)

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Просмотр задачи #{{ $task->id }}</h1>
        <a href="{{ route('tasks.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition">
            ← Назад к списку
        </a>
    </div>

    <!-- Информация о задаче -->
    <div class="space-y-4">
        <!-- Название -->
        <div class="border-b pb-3">
            <label class="block text-sm font-medium text-gray-500 mb-1">Название задачи</label>
            <div class="text-lg font-semibold text-gray-800">{{ $task->title }}</div>
        </div>

        <!-- Описание -->
        <div class="border-b pb-3">
            <label class="block text-sm font-medium text-gray-500 mb-1">Описание</label>
            <div class="text-gray-700">
                @if($task->description)
                    {{ nl2br(e($task->description)) }}
                @else
                    <span class="text-gray-400 italic">Нет описания</span>
                @endif
            </div>
        </div>

        <!-- Статус -->
        <div class="border-b pb-3">
            <label class="block text-sm font-medium text-gray-500 mb-1">Статус</label>
            <div>
                <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                    {{ $task->status->label() }}
                </span>
            </div>
        </div>

        <!-- Дата создания -->
        <div class="border-b pb-3">
            <label class="block text-sm font-medium text-gray-500 mb-1">Дата создания</label>
            <div class="text-gray-700">{{ $task->created_at->format('d.m.Y H:i:s') }}</div>
            <div class="text-sm text-gray-500">{{ $task->created_at->diffForHumans() }}</div>
        </div>

        <!-- Дата обновления -->
        <div class="border-b pb-3">
            <label class="block text-sm font-medium text-gray-500 mb-1">Последнее обновление</label>
            <div class="text-gray-700">{{ $task->updated_at->format('d.m.Y H:i:s') }}</div>
            <div class="text-sm text-gray-500">{{ $task->updated_at->diffForHumans() }}</div>
        </div>
    </div>

    <!-- Кнопки действий -->
    <div class="flex gap-2 mt-6 pt-4 border-t">
        <a href="{{ route('tasks.edit', $task) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition">
            Редактировать
        </a>
        
        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" 
                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition"
                    onclick="return confirm('Удалить задачу?')">
                Удалить
            </button>
        </form>
    </div>
</div>
@endsection