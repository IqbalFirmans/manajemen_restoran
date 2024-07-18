@extends('layouts.auth')

@section('main')
    <div class="flex flex-col overflow-y-auto md:flex-row">
        <div class="h-32 md:h-auto md:w-1/2">
            <img aria-hidden="true" class="object-cover w-full h-full dark:hidden"
                src="../assets/img/create-account-office.jpeg" alt="Office" />
            <img aria-hidden="true" class="hidden object-cover w-full h-full dark:block"
                src="../assets/img/create-account-office-dark.jpeg" alt="Office" />
        </div>
        <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
            <div class="w-full">
                <form action="{{ route('register') }}" method="post">
                    @csrf
                    <h1 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">
                        Create account
                    </h1>
                    <label class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Name</span>
                        <input
                            class="block w-full mt-1 @error('name') border-red-600 @enderror text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder="Enter Name" name="name" value="{{ old('name') }}" autocomplete="name"
                            autofocus />

                        @error('name')
                            <span class="text-xs text-red-600 dark:text-red-400">
                                {{ $message }}
                            </span>
                        @enderror
                    </label>

                    <label class="block text-sm mt-4">
                        <span class="text-gray-700 dark:text-gray-400">Email</span>
                        <input
                            class="block w-full mt-1 @error('email') border-red-600 @enderror text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder="Enter Email" name="email" value="{{ old('email') }}" autocomplete="email"
                            autofocus />

                        @error('email')
                            <span class="text-xs text-red-600 dark:text-red-400">
                                {{ $message }}
                            </span>
                        @enderror
                    </label>

                    <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Password</span>
                        <input
                        class="block w-full mt-1 text-sm @error('password') border-red-600 @enderror dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        placeholder="***************" name="password" type="password" autocomplete="new-password"/>

                        @error('password')
                            <span class="text-xs text-red-600 dark:text-red-400">
                                {{ $message }}
                            </span>
                        @enderror

                    </label>

                    <label class="block mt-4 text-sm">
                        <span class="text-gray-700 dark:text-gray-400">
                            Confirm password
                        </span>
                        <input class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                            placeholder="***********" type="password" name="password_confirmation" autocomplete="new-password"/>
                    </label>

                    <!-- You should use a button here, as the anchor is only used for the example  -->
                    <button
                        class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                        type="submit">
                        Create account
                    </button>

                    <p class="mt-4">
                        <a class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline"
                            href="{{ route('login') }}">
                            Already have an account? Login
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </div>
@endsection
