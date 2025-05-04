@extends('layouts.app')

@section('content')
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-6 mx-auto max-h-screen overflow-hidden lg:py-0 max-w-screen-md">
            <a href="{{ url('/') }}" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                <img class="w-8 h-8 mr-2" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg" alt="logo">
                {{ __('messages.app_name') }}
            </a>
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 md:max-w-2xl xl:p-0 dark:bg-gray-800 dark:border-gray-700 overflow-hidden flex flex-col">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8 w-full overflow-y-auto max-h-[calc(100vh-180px)]">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        {{ __('messages.user.account_edit') }}
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="{{ route('web.users.update', ['id' => $user->id]) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('messages.name') }} <span class="text-red-500">{{ __('messages.required_field_indicator') }}</span></label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="address_line_1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('messages.address_line_1') }} <span class="text-red-500">{{ __('messages.required_field_indicator') }}</span></label>
                            <input type="text" name="address_line_1" id="address_line_1" value="{{ old('address_line_1', $address->address_line_1 ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            @error('address_line_1')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="address_line_2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('messages.address_line_2') }}</label>
                            <input type="text" name="address_line_2" id="address_line_2" value="{{ old('address_line_2', $address->address_line_2 ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @error('address_line_2')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="city" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('messages.city') }} <span class="text-red-500">{{ __('messages.required_field_indicator') }}</span></label>
                            <input type="text" name="city" id="city" value="{{ old('city', $address->city ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            @error('city')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="postcode" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('messages.postcode') }} <span class="text-red-500">{{ __('messages.required_field_indicator') }}</span></label>
                            <input type="text" name="postcode" id="postcode" value="{{ old('postcode', $address->postcode ?? '') }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            @error('postcode')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="pt-4">
                            <h2 class="text-lg font-medium leading-tight tracking-tight text-gray-900 mb-4 dark:text-white">
                                {{ __('messages.contacts') }}
                            </h2>
                            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">
                                                {{ __('messages.name') }}
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                {{ __('messages.email') }}
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                {{ __('messages.contact_number') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($contacts as $contact)
                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    {{ $contact->name }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    {{ $contact->email }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    {{ $contact->contact_number }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                <td colspan="3" class="px-6 py-4 text-center">
                                                    No contacts found
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="pt-4">
                            <h2 class="text-lg font-medium leading-tight tracking-tight text-gray-900 mb-4 dark:text-white">
                                {{ __('messages.files') }}
                            </h2>
                            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">
                                                {{ __('messages.name') }}
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                {{ __('messages.mime_type') }}
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                {{ __('messages.size') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($files as $file)
                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    {{ $file->original_name }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    {{ $file->mime_type }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    {{ $file->size }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                <td colspan="3" class="px-6 py-4 text-center">
                                                    No files found
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-4">
                            <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ __('messages.save') }}</button>
                            <a href="{{ route('web.users.show', ['id' => $user->id]) }}" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">{{ __('messages.cancel') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
