@extends('layouts.main')

@section('title', 'Detail Order')
@section('content')
    <div class="container grid px-6 mx-auto">
        <div class="flex justify-between items-center mb-4">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Detail Order
            </h2>
        </div>

        <div class="w-full overflow-hidden rounded-lg shadow-xs mb-5">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach ($orders as $order)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3">
                                    <p class="font-semibold text-sm">{{ $order->menu->name }}</p>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    quantity: {{ $order->quantity }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    Harga: Rp {{ number_format($order->menu->price * $order->quantity, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                        <tr class="bg-gray-50 dark:bg-gray-900">
                            <td class="px-4 py-3 text-sm font-semibold text-gray-700 dark:text-gray-200">
                                Total Pembayaran
                            </td>
                            <td></td>
                            <td class="px-4 py-3 text-sm font-semibold text-gray-700 dark:text-gray-200" colspan="2">
                                Rp {{ number_format($payment->total_bayar, 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr class="bg-gray-50 dark:bg-gray-900">
                            <td class="px-4 py-3 text-sm font-semibold text-gray-700 dark:text-gray-200">
                                Jenis Pembayaran
                            </td>
                            <td></td>
                            <td class="px-4 py-3 text-sm font-semibold text-gray-700 dark:text-gray-200" colspan="2">
                                {{ $payment->method->name }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
