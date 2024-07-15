@extends('layouts.main')

@section('content')
    <div class="container grid px-6 mx-auto">


        <div class="flex items-center mb-4">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Categories
            </h2>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Customer ID</th>
                    <th>Payment ID</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr>
                        <td>{{ $order->customer_id }}</td>
                        <td>{{ $order->payment_id }}</td>
                        <td>{{ $order->status }}</td>
                    </tr>
                @empty
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
