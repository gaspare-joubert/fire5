<?php
/**
 * @file AddressResource.php
 *
 * @author Gaspare Joubert
 * @date 07/05/2025 10:33
 *
 */

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read string $address_line_1
 * @property-read string $address_line_2
 * @property-read string $city
 * @property-read string $postcode
 */
class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     *
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'address_line_1' => $this->address_line_1 ?? '',
            'address_line_2' => $this->address_line_2 ?? '',
            'city'           => $this->city ?? '',
            'postcode'       => $this->postcode ?? '',
        ];
    }
}
