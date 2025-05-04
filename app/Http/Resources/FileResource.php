<?php
/**
 * @file FileResource.php
 *
 * @author Gaspare Joubert
 * @date 04/05/2025 14:06
 *
 */

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read int $id
 * @property-read string $name
 * @property-read string $size
 * @property-read string $mime_type
 * @property-read string $uploaded_at
 * @property-read int $user_id
 * @property-read string $created_at
 * @property-read string $updated_at
 * @property-read string $path
 * @property-read string $original_name
 */
class FileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'name'        => $this->original_name,
            'size'        => $this->size,
            'mime_type'   => $this->mime_type,
            'uploaded_at' => $this->created_at,
            'user_id'     => $this->user_id,
        ];
    }
}
