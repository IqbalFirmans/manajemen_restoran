@extends('layouts.main')

@section('title', 'Menus')
@section('content')
    <style>
        .menu-img {
            max-width: 90px;
            max-height: 90px;
            object-fit: cover;
        }
    </style>

    <div class="container grid px-6 mx-auto">
        <!-- Search input -->
        <div class="flex justify-center mt-4 flex-1 lg:mr-32">
            <div class="relative w-full max-w-xl mr-6 focus-within:text-purple-500">
                <div class="absolute inset-y-0 flex items-center pl-2">
                    <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <form action="{{ route('menus.index') }}" method="get">

                    <input
                        class="w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                        type="search" name="search" value="{{ request('search') }}" autocomplete="off"
                        placeholder="Search for Menus" autofocus aria-label="Search" />
                </form>
            </div>
        </div>
        <div class="flex justify-between items-center mb-4">
            <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                Menus
            </h2>
            <a href="{{ route('menus.create') }}"
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
            <div class="p-2">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Page {{ $menus->currentPage() }} of {{ $menus->lastPage() }}
                </p>
            </div>
            <div class="w-full overflow-x-auto">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">No</th>
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Price</th>
                            <th class="px-4 py-3">Description</th>
                            <th class="px-4 py-3">Image</th>
                            <th class="px-4 py-3">Category</th>
                            <th class="px-4 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @forelse ($menus as $menu)
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3">
                                    {{ $loop->iteration }} .
                                </td>
                                <td class="px-4 py-3">
                                    <p class="font-semibold text-sm">{{ $menu->name }}</p>
                                </td>
                                <td class="px-4 py-3">
                                    <p class="text-sm">Rp. {{ number_format($menu->price, 0, null, '.') }}</p>
                                </td>
                                <td class="px-4 py-3">
                                    <p class="text-sm">{{ Str::limit($menu->description, 50) }}</p>
                                </td>
                                <td class="px-4 py-3">
                                    <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}"
                                        class="menu-img">
                                </td>
                                <td class="px-4 py-3">
                                    <p class="text-sm">{{ $menu->category->name }}</p>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center space-x-4 text-sm">
                                        <a href="{{ route('menus.edit', $menu->id) }}"
                                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                            aria-label="Edit">
                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                </path>
                                            </svg>
                                        </a>

                                        <form action="{{ route('menus.destroy', $menu->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                                aria-label="Delete">
                                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-3 text-center text-gray-500">
                                    Menus Not found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-4 mb-4">
            {{ $menus->links() }}
        </div>
    </div>
@endsection
