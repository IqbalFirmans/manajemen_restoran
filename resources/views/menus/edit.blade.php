@extends('layouts.main')

@section('title', 'Edit Menu')
@section('content')

<section class="mt-4">
    <div class="container grid px-6 mx-auto">
        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
                Edit Menu
            </h4>

            <form action="{{ route('menus.update', $menu->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="grid gap-6 mb-8 md:grid-cols-2 lg:grid-cols-3">
                    <input type="hidden" value="{{ $menu->image }}" name="oldImage">

                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">
                                Menu Name
                            </span>
                            <input
                            class="block w-full mt-2 text-sm focus:outline-none form-input @error('name') border-red-600 @enderror"
                            placeholder="Name" name="name" value="{{ $menu->name }}" />

                            @error('name')
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </span>
                            @enderror
                        </label>

                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">
                                Price
                            </span>
                            <input
                                class="block w-full mt-2 text-sm focus:outline-none form-input @error('price') border-red-600 @enderror"
                                placeholder="Price" name="price" value="{{ $menu->price }}" />

                            @error('price')
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </span>
                            @enderror
                        </label>

                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">
                                Category
                            </span>
                            <select
                                class="block w-full mt-2 text-sm focus:outline-none form-select @error('category_id') border-red-600 @enderror"
                                name="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $menu->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('category_id')
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </span>
                            @enderror
                        </label>

                        <label class="block text-sm md:col-span-2 lg:col-span-3">
                            <span class="text-gray-700 dark:text-gray-400">
                                Description
                            </span>
                            <textarea class="block w-full mt-2 text-sm focus:outline-none form-input @error('description') border-red-600 @enderror"
                                placeholder="Description" name="description">{{ $menu->description }}</textarea>

                            @error('description')
                                <span class="text-xs text-red-600 dark:text-red-400">
                                    {{ $message }}
                                </span>
                            @enderror
                        </label>

                        <div class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">
                                Image
                            </span>
                            <div>
                                <input type="file" id="image" name="image"
                                    class="mt-2 text-sm focus:outline-none form-input @error('image') border-red-600 @enderror"
                                    onchange="document.getElementById('img-preview').src = window.URL.createObjectURL(this.files[0])" />
                                @error('image')
                                    <span class="text-xs text-red-600 dark:text-red-400">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="mt-4">
                                <label class="block text-sm text-gray-700 dark:text-gray-400">Image Preview</label>
                                <img class="w-full h-80 w-30 object-cover mt-2" id="img-preview" src="{{ asset('storage/' . $menu->image) }}">
                            </div>
                        </div>

                    </div>

                    <div class="flex justify-end items-center mb-2 mt-2 space-x-3">
                        <a href="/menus"
                            class="flex items-center px-3 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                            <span>Back</span>
                        </a>
                        <button type="submit"
                            class="flex items-center px-3 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                            <span>Edit</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

@endsection
