@extends('admin.layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">Заказы</h1>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left">№</th>
                <th class="px-6 py-3 text-left">Пользователь</th>
                <th class="px-6 py-3 text-left">Сумма</th>
                <th class="px-6 py-3 text-left">Статус</th>
                <th class="px-6 py-3 text-left">Оплата</th>
                <th class="px-6 py-3 text-left">Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr class="border-t">
                <td class="px-6 py-4">{{ $order->order_number }}</td>
                <td class="px-6 py-4">{{ $order->user->name ?? 'Гость' }}</td>
                <td class="px-6 py-4">{{ number_format($order->total_amount) }} ₽</td>
                <td class="px-6 py-4">
                    <form action="{{ route('admin.orders.status', $order) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <select name="status" onchange="this.form.submit()" class="border rounded px-2 py-1 text-sm">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>⏳ Ожидает</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>🔄 В обработке</option>
                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>✅ Выполнен</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>❌ Отменён</option>
                        </select>
                    </form>
                </td>
                <td class="px-6 py-4">
                    @if($order->payment_status == 'paid')
                        <span class="text-green-600">Оплачен</span>
                    @else
                        <span class="text-red-600">Не оплачен</span>
                    @endif
                </td>
                <td class="px-6 py-4">
                    <a href="{{ route('orders.show', $order) }}" class="text-blue-500">👁️</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $orders->links() }}
</div>
@endsection