@extends('layouts.app')

@section('title', 'Редактировать задачу')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Редактировать задачу</h1>
        <a href="{{ route('tasks.show', $task) }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition">
            ← Назад
        </a>
    </div>

    <form action="{{ route('tasks.update', $task) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Название задачи -->
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                Название задачи <span class="text-red-500">*</span>
            </label>
            <input type="text" 
                   name="title" 
                   id="title" 
                   value="{{ old('title', $task->title) }}"
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('title') border-red-500 @enderror"
                   placeholder="Введите название задачи"
                   required>
            @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Описание задачи -->
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                Описание задачи
            </label>
            <textarea name="description" 
                      id="description" 
                      rows="5"
                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror"
                      placeholder="Введите описание задачи (необязательно)">{{ old('description', $task->description) }}</textarea>
            @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Статус задачи -->
        <div class="mb-6">
            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                Статус <span class="text-red-500">*</span>
            </label>
            <select name="status" 
                    id="status" 
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('status') border-red-500 @enderror"
                    required>
                @foreach($statuses as $value => $label)
                    <option value="{{ $value }}" {{ old('status', $task->status->value) == $value ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
            @error('status')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Кнопки -->
        <div class="flex gap-2">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition">
                Сохранить изменения
            </button>
            <a href="{{ route('tasks.show', $task) }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition">
                Отмена
            </a>
        </div>
    </form>
</div>
@endsection