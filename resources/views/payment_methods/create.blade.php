@extends('layouts.main')

@section('title', 'Create Payment Method')
@section('content')

    <section class="mt-4">
        <div class="container grid px-6 mx-auto">
            <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
                    Create New Payment Methods
                </h4>

                <form action="{{ route('payment_methods.store') }}" method="post">
                    @csrf
                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">
                                Type of Payment
                            </span>
                            <input
                                class="block w-full mt-2 text-sm focus:outline-none form-input @error('name') border-red-600 @enderror"
                                placeholder="Name" name="name" value="{{ old('name') }}" />

                            @error('name')
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </span>
                            @enderror
                        </label>

                        <label class="mt-4 block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">
                                Description
                            </span>
                            <input
                                class="block w-full mt-2 text-sm focus:outline-none form-input @error('description') border-red-600 @enderror"
                                placeholder="Description" name="description" value="{{ old('description') }}" />

                            @error('description')
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </span>
                            @enderror
                        </label>

                        <div class="mt-4 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">
                                Status
                            </span>
                            <div class="mt-2">
                                <label class="inline-flex items-center text-gray-600 dark:text-gray-400">
                                    <input type="radio"
                                        class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                                        name="status" value="active" checked/>
                                    <span class="ml-2">Active</span>
                                </label>
                                <label class="inline-flex items-center ml-6 text-gray-600 dark:text-gray-400">
                                    <input type="radio"
                                        class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                                        name="status" value="nonactive" />
                                    <span class="ml-2">Nonactive</span>
                                </label>
                            </div>
                        </div>

                        <div class="flex justify-end items-center mb-2 mt-2 space-x-3">
                            <a href="/payment_methods"
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
