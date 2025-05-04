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
     */
    public function rules(): array
    {
        return [
            'files'   => 'required|array',
            'files.*' => 'required|file|mimetypes:application/pdf,image/jpeg,image/png|max:10240',
        ];
    }
}
