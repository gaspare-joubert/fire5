<!-- resources/views/partials/user-fields.blade.php -->

<div>
    <label for="name"
           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('messages.name') }}
        <span class="text-red-500">{{ __('messages.required_field_indicator') }}</span></label>
    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
           class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
           required>
    @error('name')
    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
