@extends('layouts.main')

@section('title', 'Create Category')
@section('content')

    <section class="bg-gray-100">
        <div class="mx-auto max-w-screen-xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-x-16 gap-y-8 lg:grid-cols-5">

                <div class="rounded-lg bg-white p-8 shadow-lg lg:col-span-3 lg:p-12">
                    <form action="{{ route('categories.store') }}" class="space-y-4" method="POST">
                        @csrf
                        <div>
                            <label class="sr-only" for="name">Name</label>
                            <input class="w-full rounded-lg border-red-500 p-3 text-sm" placeholder="Name" type="text"
                                id="name" name="name" value="{{ old('name') }}" />

                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="sr-only" for="slug">Slug</label>
                            <input class="w-full rounded-lg border-gray-200 p-3 text-sm" placeholder="Slug" type="text"
                                id="slug" name="slug"/>

                            @error('slug')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-4 flex justify-end gap-3">
                            <a href="/categories" class="inline-block w-full rounded-lg bg-red-600 px-5 py-3 font-medium text-white sm:w-auto">Back</a>
                            <button type="submit"
                                class="inline-block w-full rounded-lg bg-indigo-600 px-5 py-3 font-medium text-white sm:w-auto">
                                Create
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
