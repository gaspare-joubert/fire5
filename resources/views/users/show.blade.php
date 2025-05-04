@extends('layouts.app')

@section('content')
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-6 mx-auto md:h-screen lg:py-0 max-w-screen-md">
            <a href="{{ url('/') }}" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
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
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        {{ __('messages.user.account_details') }}
                    </h1>
                    <div class="space-y-4 md:space-y-6">
                        <div>
                            <h2 class="block mb-1 text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('messages.name') }}</h2>
                            <p class="text-base font-medium text-gray-900 dark:text-white">{{ $user->name }}</p>
                        </div>
                        <div>
                            <h2 class="block mb-1 text-sm font-medium text-gray-500 dark:text-gray-400">{{ __('messages.email') }}</h2>
                            <p class="text-base font-medium text-gray-900 dark:text-white">{{ $user->email }}</p>
                        </div>
                        <div class="pt-4">
                            <a href="{{ route('users.edit',['user'=>$user->id]) }}" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-block dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ __('messages.user.account_edit') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
