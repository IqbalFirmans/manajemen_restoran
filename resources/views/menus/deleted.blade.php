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

@section('search')
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
            <form action="{{ route('menus.deleted') }}" method="get">
                <input
                    class="w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                    type="search" name="search" value="{{ request('search') }}" autocomplete="off"
                    placeholder="Search for Deleted Menu" autofocus aria-label="Search" />
            </form>
        </div>
        <a href="{{ route('menus.deleted') }}"
            class="flex items-center px-3 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            <span>Refresh</span>
        </a>
    </div>
@endsection

<div class="container grid px-6 mx-auto">
    <div class="flex justify-between items-center mb-4">
        <h2 class="my-6 text-2xl font-semibold text-gray-700">
            Deleted Menu
        </h2>

    </div>

    <div class="w-full overflow-hidden rounded-lg shadow-xs mb-5">
        <div class="p-2">
            <p class="text-sm text-gray-600">
                Page {{ $deletedMenu->currentPage() }} of {{ $deletedMenu->lastPage() }}
            </p>
        </div>
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Price</th>
                        <th class="px-4 py-3">Description</th>
                        <th class="px-4 py-3">Image</th>
                        <th class="px-4 py-3">Category</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y">
                    @forelse ($deletedMenu as $menu)
                        <tr class="text-gray-700">
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
                                <div class="flex items-center space-x-2 text-sm">
                                    <button type="submit" onclick="confirmAccept('{{ $menu->id }}')"
                                        class="flex items-center px-3 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                                        </svg>
                                    </button>

                                    <button onclick="confirmDelete('{{ $menu->id }}')"
                                        class="flex items-center px-2 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>

                                    </button>

                                    <form id="accept-form-{{ $menu->id }}"
                                        action="{{ route('menus.restore', $menu->id) }}" method="post"
                                        style="display: none;">
                                        @csrf
                                    </form>

                                    <form id="delete-form-{{ $menu->id }}"
                                        action="{{ route('menus.forceDelete', $menu->id) }}" method="post"
                                        style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>


                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-3 text-center text-gray-500">
                                Deleted Menu Not found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-4 mb-4">
        {{ $deletedMenu->links() }}
    </div>
</div>
@endsection
