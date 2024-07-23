@extends('layouts.main')

@section('title', 'Detail Order')
@section('content')
    <div class="container grid px-6 mx-auto">
        <div class="flex justify-between items-center mb-4">
            <h2 class="my-6 text-2xl font-semibold text-gray-700">
                Detail Order
            </h2>
        </div>

        <div class="w-full overflow-hidden rounded-lg shadow-xs mb-5">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <tbody class="bg-white divide-y">
                        @forelse ($orders as $order)
                            <tr class="text-gray-700">
                                <td class="px-4 py-3">
                                    <p class="font-semibold text-sm">{{ $order->menu->name }}</p>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    Quantity: {{ $order->quantity }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    Harga: Rp
                                    {{ number_format($order->current_price * $order->quantity, 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-3 text-center text-gray-500">
                                    Orders Not Found
                                </td>
                            </tr>
                        @endforelse
                        @if ($orders->count() > 0)
                            <tr class="bg-gray-50">
                                <td class="px-4 py-3 text-sm font-semibold text-gray-700">
                                    Jenis Pembayaran
                                </td>
                                <td></td>
                                <td class="px-4 py-3 text-sm font-semibold text-gray-700" colspan="2">
                                    {{ $payment->method->name }}
                                </td>
                            </tr>
                            <tr class="bg-gray-50">
                                <td class="px-4 py-3 text-sm font-semibold text-gray-700">
                                    Total Pembayaran
                                </td>
                                <td></td>
                                <td class="px-4 py-3 text-sm font-semibold text-gray-700" colspan="2">
                                    Rp {{ number_format($payment->total_bayar, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
