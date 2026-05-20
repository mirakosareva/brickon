@extends('admin.layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Категории</h1>
    <a href="{{ route('admin.categories.create') }}" class="bg-brickon-red text-white px-4 py-2 rounded-lg">+ Добавить категорию</a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr class="bg-gray-50">
                <th class="px-6 py-3 text-left">Название</th>
                <th class="px-6 py-3 text-left">Slug</th>
                <th class="px-6 py-3 text-left">Товаров</th>
                <th class="px-6 py-3 text-left">Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr class="border-t">
                <td class="px-6 py-4">{{ $category->name }}</td>
                <td class="px-6 py-4">{{ $category->slug }}</td>
                <td class="px-6 py-4">{{ $category->products_count }}</td>
                <td class="px-6 py-4">
                    <a href="{{ route('admin.categories.edit', $category) }}" class="text-blue-500 mr-3">✏️</a>
                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline-block" onsubmit="return confirm('Удалить?')">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-500">🗑️</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection