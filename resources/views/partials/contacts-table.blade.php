<!-- resources/views/partials/contacts-table.blade.php -->

<div class="pt-4">
    <h2 class="text-lg font-medium leading-tight tracking-tight text-gray-900 mb-4 dark:text-white">
        {{ __('messages.contacts') }}
    </h2>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead
                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
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
