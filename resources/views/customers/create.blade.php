@extends('layouts.main')

@section('title', 'Create Customer')
@section('content')

    <section class="mt-4">
        <div class="container grid px-6 mx-auto">
            <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md">
                <h4 class="mb-4 text-lg font-semibold text-gray-600">
                    Create New Customer
                </h4>

                <form action="{{ route('customers.store') }}" method="post">
                    @csrf
                    <div class="grid gap-6 mb-8 md:grid-cols-2 lg:grid-cols-3">

                        <label class="block text-sm">
                            <span class="text-gray-700">
                                Customer Name
                            </span>
                            <input
                                class="block w-full mt-2 text-sm focus:outline-none form-input @error('name') border-red-600 @enderror"
                                placeholder="Name" name="name" value="{{ old('name') }}" />

                            @error('name')
                                <span class="text-xs text-red-600">
                                    {{ $message }}
                                </span>
                            @enderror
                        </label>

                        <label class="block text-sm">
                            <span class="text-gray-700">
                                Customer Email * Optional
                            </span>
                            <input
                                class="block w-full mt-2 text-sm focus:outline-none form-input @error('email') border-red-600 @enderror"
                                placeholder="Email" name="email" value="{{ old('email') }}" />

                            @error('email')
                                <span class="text-xs text-red-600">
                                    {{ $message }}
                                </span>
                            @enderror
                        </label>

                        <label class="block text-sm">
                            <span class="text-gray-700">
                                Customer Phone
                            </span>
                            <input
                                class="block w-full mt-2 text-sm focus:outline-none form-input @error('phone') border-red-600 @enderror"
                                placeholder="Phone" name="phone" value="{{ old('phone') }}" />

                            @error('phone')
                                <span class="text-xs text-red-600">
                                    {{ $message }}
                                </span>
                            @enderror
                        </label>

                    </div>

                    <div class="flex justify-end items-center mb-2 mt-2 space-x-3">
                        <a href="/customers"
                            class="flex items-center px-3 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                            <span>Back</span>
                        </a>
                        <button type="submit"
                            class="flex items-center px-3 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                            <span>Create</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

@endsection
