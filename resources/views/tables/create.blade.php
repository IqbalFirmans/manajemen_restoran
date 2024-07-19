@extends('layouts.main')

@section('title', 'Create Table')
@section('content')

<section class="mt-4">

    <div class="container grid px-6 mx-auto">
        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md">
            <h4 class="mb-4 text-lg font-semibold text-gray-600">
                Create New Table
            </h4>

            <form action="{{ route('tables.store') }}" method="post">
                @csrf
                <div class="grid gap-6 mb-8 md:grid-cols-2 lg:grid-cols-3">
                    <label class="block text-sm">
                        <span class="text-gray-700">
                            Table Number
                        </span>
                        <input type="number"
                            class="block w-full mt-2 text-sm focus:outline-none form-input @error('table_number') border-red-600 @enderror"
                            placeholder="No." name="table_number" value="{{ old('table_number') }}" />

                        @error('table_number')
                            <span class="text-xs text-red-600">
                                {{ $message }}
                            </span>
                        @enderror
                    </label>

                    <label class="block text-sm">
                        <span class="text-gray-700">
                            Table Capacity
                        </span>
                        <input type="number"
                            class="block w-full mt-2 text-sm focus:outline-none form-input @error('capacity') border-red-600 @enderror"
                            placeholder="Capacity" name="capacity" value="{{ old('capacity') }}" />

                        @error('capacity')
                            <span class="text-xs text-red-600">
                                {{ $message }}
                            </span>
                        @enderror
                    </label>

                    <label class="block text-sm">
                        <span class="text-gray-700">
                            Status
                        </span>
                        <select
                            class="block w-full mt-2 text-sm focus:outline-none form-select @error('status') border-red-600 @enderror"
                            name="status">
                            <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>
                                Available
                            </option>
                            <option value="occupied" {{ old('status') == 'occupied' ? 'selected' : '' }}>
                                Occupied
                            </option>
                            <option value="reserved" {{ old('status') == 'reserved' ? 'selected' : '' }}>
                                Reserved
                            </option>
                        </select>

                        @error('status')
                            <span class="text-xs text-red-600">
                                {{ $message }}
                            </span>
                        @enderror
                    </label>
                </div>

                <div class="flex justify-end items-center mb-2 mt-2 space-x-3">
                    <a href="/tables"
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
