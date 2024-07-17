@extends('layouts.main')


@section('title', 'Orders')
@section('content')
    <div class="container grid px-6 mx-auto">

        <div class="flex justify-between items-center mb-4">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Orders
            </h2>
            <a href="{{ route('orders.create') }}"
                class="flex items-center px-3 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                <span>Create</span>
                <svg class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                        clip-rule="evenodd" fill-rule="evenodd"></path>
                </svg>
            </a>
        </div>

        <div class="w-full overflow-hidden rounded-lg shadow-xs mb-5">
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">No</th>
                            <th class="px-4 py-3">Customer ID</th>
                            <th class="px-4 py-3">Payment ID</th>
                            <th class="px-4 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach ($orders as $order)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3">
                                    {{ $loop->iteration }} .
                                </td>
                                <td class="px-4 py-3">
                                    <p class="font-semibold text-sm">{{ $order->customer_id }}</p>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $order->payment_id }}
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center space-x-4 text-sm">
                                        <a href="{{ route('orders.show', $order->id) }}">Detail</a>

                                        <button onclick="confirmDelete('{{ $order->id }}')"
                                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                            aria-label="Delete">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M6 2a1 1 0 011-1h6a1 1 0 011 1v1h3a1 1 0 011 1v1a1 1 0 01-1 1v10a2 2 0 01-2 2H5a2 2 0 01-2-2V5a1 1 0 01-1-1V3a1 1 0 011-1h3V2zm1 2v10a1 1 0 001 1h6a1 1 0 001-1V4H7z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </button>

                                        <form id="delete-form-{{ $order->id }}"
                                            action="{{ route('orders.destroy', $order->id) }}" method="post"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
