@extends('layouts.main')

@section('title', 'Categories')

@section('content')
    <header>
        <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 sm:py-12 lg:px-8">
            <div class="sm:flex sm:items-center sm:justify-between">
                <div class="text-center sm:text-left">
                    <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl">All Categories!</h1>

                    <p class="mt-1.5 text-sm text-gray-500">Let's write a new categories menu! 🎉</p>
                </div>

                <div class="mt-4 flex flex-col gap-4 sm:mt-0 sm:flex-row sm:items-center">
                    <a
                        class="block rounded-lg bg-indigo-600 px-5 py-3 text-sm font-medium text-white transition hover:bg-indigo-700 focus:outline-none focus:ring"
                        href="{{ route('categories.create') }}">
                        Create Post
                    </a>
                </div>
            </div>
        </div>
    </header>

    <section>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table id="example" class="w-full text-sm text-left rtl:text-right text-light-500 dark:text-light-400">
                <thead class="text-xs text-light-700 uppercase bg-light-50 dark:bg-light-700 dark:text-light-400">
                    <tr>

                        <th scope="col" class="px-6 py-3">No</th>
                        <th scope="col" class="px-6 py-3">Category Name</th>
                        <th scope="col" class="px-6 py-3">Menu Count</th>
                        <th scope="col" class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr class="bg-white border-b dark:bg-light-800 dark:border-light-700">
                            <td class="px-6 py-4">1</td>
                            <th scope="row" class="px-6 py-4 font-medium text-dark-900 whitespace-nowrap dark:text-dark">
                                {{ $category->name }}
                            </th>
                            <td class="px-6 py-4">{{ $category->menus_count }}</td>
                            <td class="px-6 py-4">
                                <a href="#"
                                    class="inline-block rounded bg-indigo-600 px-4 py-2 text-xs font-medium text-white hover:bg-indigo-700">
                                    View
                                </a>
                                <a href="{{ route('categories.edit', $category->id) }}"
                                    class="inline-block rounded bg-yellow-600 px-4 py-2 text-xs font-medium text-white hover:bg-yellow-700">
                                    Edit
                                </a>

                                <form action="{{ route('categories.destroy', $category->id) }}" method="post"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-block rounded bg-red-600 px-4 py-2 text-xs font-medium text-white hover:bg-red-700">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
