<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', __('messages.app_name')) }}</title>

    <script>
        window.AppTranslations = {
            csrfToken: "{{ csrf_token() }}",
            statusSuccess: "{{ __('messages.status_success') }}",
            modalDefaultTitle: "{{ __('messages.notification') }}",
            successTitle: "{{ __('messages.modal_success_title') }}",
            errorTitle: "{{ __('messages.modal_error_title') }}",
            defaultErrorMessage: "{{ __('messages.default_error_message') }}",
            modalInitSuccess: "{{ __('messages.modal_init_success') }}",
            modalInitError: "{{ __('messages.modal_init_error') }}",
            modalDeleting: "{{ __('messages.modal_deleting') }}"
        };
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="bg-gray-100 text-gray-900">

<nav class="bg-white border-b border-gray-200 px-4 py-2.5 shadow-sm">
    <div class="container mx-auto flex flex-wrap justify-between items-center">
        <a href="/"
           class="text-xl font-semibold text-blue-600 hover:underline hover:text-blue-800">{{ __('messages.app_name') }}</a>
        @auth
            <form method="POST" action="{{ route('web.users.logout') }}" class="inline">
                @csrf
                <button type="submit"
                        class="text-xl font-semibold text-blue-600 hover:underline hover:text-blue-800 cursor-pointer">
                    {{ __('messages.logout') }}
                </button>
            </form>
        @endauth
    </div>
</nav>

@include('partials._notification-modal')

<main class="container mx-auto px-4 py-10">
    @yield('content')
</main>

@yield('scripts')
</body>
</html>
