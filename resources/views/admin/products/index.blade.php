@extends('admin.layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Товары</h1>
    <a href="{{ route('admin.products.create') }}" class="bg-brickon-red text-white px-4 py-2 rounded-lg hover:bg-red-700">+ Добавить товар</a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left">Фото</th>
                <th class="px-6 py-3 text-left">Название</th>
                <th class="px-6 py-3 text-left">Категория</th>
                <th class="px-6 py-3 text-left">Цена</th>
                <th class="px-6 py-3 text-left">Остаток</th>
                <th class="px-6 py-3 text-left">Действия</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach($products as $product)
            <tr>
                <td class="px-6 py-4">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="w-12 h-12 object-cover rounded">
                    @else
                        <div class="w-12 h-12 bg-gray-100 rounded flex items-center justify-center">📦</div>
                    @endif
                </td>
                <td class="px-6 py-4">{{ $product->name }}</td>
                <td class="px-6 py-4">{{ $product->category->name ?? '-' }}</td>
                <td class="px-6 py-4">{{ number_format($product->price) }} ₽</td>
                <td class="px-6 py-4">{{ $product->stock }}</td>
                <td class="px-6 py-4">
                    <a href="{{ route('admin.products.edit', $product) }}" class="text-blue-500 hover:underline mr-3">✏️</a>
                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline-block" onsubmit="return confirm('Удалить?')">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-500 hover:underline">🗑️</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $products->links() }}
</div>
@endsection