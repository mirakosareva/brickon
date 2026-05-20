@extends('admin.layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Новая категория</h1>
    <a href="{{ route('admin.categories.index') }}" class="text-gray-500">← Назад</a>
</div>

<div class="bg-white rounded-lg shadow p-6 max-w-lg">
    <form action="{{ route('admin.categories.store') }}" method="PUT">
        @csrf
        <div class="mb-4">
            <label class="block font-medium mb-1">Название</label>
            <input type="text" name="name" class="w-full border rounded-lg px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block font-medium mb-1">Slug</label>
            <input type="text" name="slug" class="w-full border rounded-lg px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block font-medium mb-1">Описание</label>
            <textarea name="description" rows="3" class="w-full border rounded-lg px-3 py-2"></textarea>
        </div>
        <button type="submit" class="bg-brickon-red text-white px-6 py-2 rounded-lg">Сохранить</button>
    </form>
</div>
@endsection