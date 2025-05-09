<?php
/**
 * @file FileStoreRequest.php
 *
 * @author Gaspare Joubert
 * @date 04/05/2025 14:36
 *
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, string|array<int, string>>
     */
    public function rules(): array
    {
        return [
            'files'   => 'required|array',
            'files.*' => 'required|file|mimetypes:application/pdf,image/jpeg,image/png,text/plain|max:10240',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'files.required'    => __('messages.validation.files.required'),
            'files.array'       => __('messages.validation.files.array'),
            'files.*.required'  => __('messages.validation.files.item_required'),
            'files.*.file'      => __('messages.validation.files.file'),
            'files.*.mimetypes' => __('messages.validation.files.mimetypes'),
            'files.*.max'       => __('messages.validation.files.max'),
        ];
    }
}
