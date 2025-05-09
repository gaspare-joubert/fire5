<?php
/**
 * @file ContactResource.php
 *
 * @author Gaspare Joubert
 * @date 07/05/2025 13:24
 *
 */

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read int $id
 * @property-read string $name
 * @property-read string $email
 * @property-read string $contact_number
 */
class ContactResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     *
     * @return array<string, int|string>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id ?? '',
            'name'           => $this->name ?? '',
            'email'          => $this->email ?? '',
            'contact_number' => $this->contact_number ?? ''
        ];
    }
}
