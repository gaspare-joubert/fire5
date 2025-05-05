@extends('layouts.app')

@section('content')
    <section class="bg-gray-50 dark:bg-gray-900">
        <div
            class="flex flex-col items-center justify-center px-6 py-6 mx-auto max-h-screen overflow-hidden lg:py-0 max-w-screen-md">
            <a href="{{ url('/') }}"
               class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                <img class="w-8 h-8 mr-2" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg"
                     alt="logo">
                {{ __('messages.app_name') }}
            </a>
            <div
                class="w-full bg-white rounded-lg shadow dark:border md:mt-0 md:max-w-2xl xl:p-0 dark:bg-gray-800 dark:border-gray-700 overflow-hidden flex flex-col">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8 w-full overflow-y-auto max-h-[calc(100vh-180px)]">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        {{ __('messages.user.account_edit') }}
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="{{ route('web.users.update', ['id' => $user->id]) }}"
                          method="POST">
                        @csrf
                        @method('PATCH')
                        @include('partials.user-fields')
                        @include('partials.address-fields')
                        <div class="flex items-center justify-between pt-4">
                            <button type="submit"
                                    class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ __('messages.save') }}</button>
                            <a href="{{ route('web.users.show', ['id' => $user->id]) }}"
                               class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">{{ __('messages.cancel') }}</a>
                        </div>
                        @include('partials.contacts-table')
                    </form>
                    @include('partials.files-table')
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        window.fileUploadFormAction = '{{ route('files.upload') }}';
        window.csrfToken = '{{ csrf_token() }}';
        window.uploadErrorMessage = '{{ __('messages.file.upload_error') }}';
        window.statusSuccess = '{{ __('messages.status_success') }}';
    </script>
@endsection
