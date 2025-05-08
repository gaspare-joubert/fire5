<!-- resources/views/partials/_files-table.blade.php -->

<div class="pt-4">
    <h2 class="text-lg font-medium leading-tight tracking-tight text-gray-900 mb-4 dark:text-white">
        {{ __('messages.files') }}
    </h2>
    <div class="mb-4">
        <form id="file-upload-form" enctype="multipart/form-data" class="flex flex-col gap-4">
            @csrf
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                       for="file_input">
                    {{ __('messages.file.upload') }}
                </label>
                <input
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    id="file_input"
                    type="file"
                    name="files[]"
                    multiple>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400" id="file_input_help">
                    {{ __('messages.file.allowed_types') }}
                </p>
            </div>
            <div>
                <button type="submit"
                        class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 cursor-pointer">
                    {{ __('messages.file.upload_button') }}
                </button>
            </div>
            <div id="upload-status" class="hidden p-4 mb-4 text-sm rounded-lg" role="alert">
            </div>
        </form>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table id="files-table"
               class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead
                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    {{ __('messages.name') }}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{ __('messages.mime_type') }}
                </th>
                <th scope="col" class="px-6 py-3">
                    {{ __('messages.size') }} ({{ __('messages.bytes') }})
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
