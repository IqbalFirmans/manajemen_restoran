@extends('layouts.main')

@section('title', 'Orders')
@section('content')
@section('search')
    <div class="flex justify-center mt-4 flex-1 lg:mr-32">
        <div class="relative w-full max-w-xl mr-6 focus-within:text-purple-500">
            <div class="absolute inset-y-0 flex items-center pl-2">
                <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                        clip-rule="evenodd"></path>
                </svg>
            </div>
            <form action="{{ route('orders.history') }}" method="get">
                <input
                    class="w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                    type="search" name="search" value="{{ request('search') }}" autocomplete="off"
                    placeholder="Search for Order" autofocus aria-label="Search" />
            </form>
        </div>
        <a href="{{ route('orders.history') }}"
            class="flex items-center px-3 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            <span>Refresh</span>
        </a>
    </div>
@endsection

<div class="container grid px-6 mx-auto">

    <div class="flex justify-between items-center mb-4">
        <h2 class="my-6 text-2xl font-semibold text-gray-700">
            Orders History  
        </h2>
    </div>

    <div class="w-full overflow-hidden rounded-lg shadow-xs mb-5">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3">Customer</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Total Harga</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y">
                    @forelse ($orders as $order)
                        <tr class="text-gray-700">
                            <td class="px-4 py-3">
                                {{ $loop->iteration }} .
                            </td>
                            <td class="px-4 py-3">
                                <p class="font-semibold text-sm">{{ $order->created_at }}</p>
                            </td>
                            <td class="px-4 py-3">
                                <p class="font-semibold text-sm">{{ $order->customer->name }}</p>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <span
                                    class="px-2 py-1 font-semibold leading-tight
                                            @if ($order->status == 'accepted') text-green-700 bg-green-100 rounded-full

                                            @elseif($order->status == 'canceled')
                                             text-red-700 bg-red-100 rounded-full

                                            @elseif($order->status == 'pending')
                                            text-orange-700 bg-yellow-100 rounded-full @endif">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <p class="font-semibold text-sm">
                                    Rp. {{ number_format($order->payment->total_bayar, 0, null, '.') }}
                                </p>
                            </td>
                            <td class="px-4 py-3 flex">
                                <div class="flex items-center space-x-4 text-sm">
                                    <a href="{{ route('orders.show', $order->id) }}"
                                        class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg focus:outline-none focus:shadow-outline-gray"
                                        aria-label="View">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                            <path fill-rule="evenodd"
                                                d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>

                                </div>

                                <button onclick="confirmDelete('{{ $order->id }}')"
                                    class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-red-600 rounded-lg focus:outline-none focus:shadow-outline-gray"
                                    aria-label="Delete">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </button>

                                <form id="delete-form-{{ $order->id }}"
                                    action="{{ route('orders.destroy', $order->id) }}" method="post"
                                    style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-3 text-center text-gray-500">
                                Orders Not Found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
