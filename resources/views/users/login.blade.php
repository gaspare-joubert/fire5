@extends('layouts.app')

@section('content')
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-6 mx-auto max-h-screen overflow-hidden lg:py-0">
            <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                <img class="w-8 h-8 mr-2" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg" alt="logo">
                {{ __('messages.app_name') }}
            </a>
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    @if (session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        {{ __('messages.login_to_your_account') }}
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="{{ route('web.users.login') }}" method="POST">
                        @csrf
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('messages.your_email') }} <span class="text-red-500">{{ __('messages.required_field_indicator') }}</span></label>
                            <input type="email" name="email" id="email"
                                   class="bg-gray-50 border {{ $errors->has('email') ? 'border-red-500' : 'border-gray-300' }} text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="{{ __('messages.email_placeholder') }}"
                                   value="{{ old('email') }}"
                                   required>
                            @error('email')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('messages.password') }} <span class="text-red-500">{{ __('messages.required_field_indicator') }}</span></label>
                            <input type="password" name="password" id="password"
                                   placeholder="{{ __('messages.password_placeholder') }}"
                                   class="bg-gray-50 border {{ $errors->has('password') ? 'border-red-500' : 'border-gray-300' }} text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   required>
                            @error('password')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ __('messages.login') }}</button>
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            {{ __('messages.user.account_not_already') }} <a href="{{ route('web.users.create') }}" class="font-medium text-primary-600 hover:underline dark:text-primary-500">{{ __('messages.user.account_create') }}</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
