<!-- resources/views/partials/address-fields.blade.php -->

<div>
    <label for="address_line_1"
           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('messages.address_line_1') }}
        <span class="text-red-500">{{ __('messages.required_field_indicator') }}</span></label>
    <input type="text" name="address_line_1" id="address_line_1"
           value="{{ old('address_line_1', $address->address_line_1 ?? '') }}"
           class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
           required>
    @error('address_line_1')
    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
<div>
    <label for="address_line_2"
           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('messages.address_line_2') }}</label>
    <input type="text" name="address_line_2" id="address_line_2"
           value="{{ old('address_line_2', $address->address_line_2 ?? '') }}"
           class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    @error('address_line_2')
    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
<div>
    <label for="city"
           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('messages.city') }}
        <span class="text-red-500">{{ __('messages.required_field_indicator') }}</span></label>
    <input type="text" name="city" id="city" value="{{ old('city', $address->city ?? '') }}"
           class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
           required>
    @error('city')
    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
<div>
    <label for="postcode"
           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('messages.postcode') }}
        <span class="text-red-500">{{ __('messages.required_field_indicator') }}</span></label>
    <input type="text" name="postcode" id="postcode"
           value="{{ old('postcode', $address->postcode ?? '') }}"
           class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
           required>
    @error('postcode')
    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
