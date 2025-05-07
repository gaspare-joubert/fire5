<?php
/**
 * @file UserResource.php
 *
 * @author Gaspare Joubert
 * @date 02/05/2025 19:05
 *
 */

namespace App\Http\Resources;

use App\Models\Address;
use App\Models\Contact;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;

/**
 * @property-read int $id
 * @property-read string $name
 * @property-read string $email
 * @property-read string $created_at
 * @property-read string $updated_at
 * @property-read bool $is_admin
 * @property-read Address|null $address
 * @property-read Contact|null $contacts
 * @property-read File[]|null $files
 * @method bool relationLoaded(string $relation)
 */
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        $data = [
            'name'       => $this->name ?? null,
            'email'      => $this->email ?? null,
            'created_at' => $this->created_at ?? null,
        ];

        // Add address data safely
        $this->addAddressData($data);

        // Add Contacts data safely
        $this->addContactsData($data);

        // Add Files data safely
        $this->addFilesData($data);

        // Add sensitive data only for authorized users
        $currentUser = $request->user();
        if ($currentUser && ($currentUser->id === $this->id || $currentUser->isAdmin())) {
            $data['id'] = $this->id ?? null;
            $data['is_admin'] = $this->is_admin ?? null;
        }

        return $data;
    }

    /**
     * Safely add address data to the response
     */
    protected function addAddressData(array &$data): void
    {
        $emptyAddress = [
            'address_line_1' => '',
            'address_line_2' => '',
            'city'           => '',
            'postcode'       => ''
        ];

        // If no address relation is loaded or address is null, return empty address
        if (!$this->relationLoaded('address') || !$this->address) {
            $data['address'] = $emptyAddress;

            return;
        }

        try {
            $data['address'] = new AddressResource($this->address);
        } catch (\Throwable $e) {
            Log::error('Failed to instantiate AddressResource', [
                'user_id'   => $this->id ?? null,
                'exception' => $e->getMessage()
            ]);

            $errorAddress = $emptyAddress;
            $errorAddress['_error'] = __('messages.resource.address_load_error');
            $data['address'] = $errorAddress;
        }
    }

    /**
     * Safely add contacts data to the response
     */
    protected function addContactsData(array &$data): void
    {
        $emptyContact = [
            'name'           => '',
            'email'          => '',
            'contact_number' => ''
        ];

        // If no contact relation is loaded or contact is null, return empty contact
        if (!$this->relationLoaded('contacts') || !$this->contacts) {
            $data['contacts'] = $emptyContact;

            return;
        }

        try {
            $data['contacts'] = ContactResource::collection($this->contacts);
        } catch (\Throwable $e) {
            Log::error('Failed to instantiate ContactResource', [
                'user_id'   => $this->id ?? null,
                'exception' => $e->getMessage()
            ]);

            $errorContact = $emptyContact;
            $errorContact['_error'] = __('messages.resource.contacts_load_error');
            $data['contacts'] = $errorContact;
        }
    }

    /**
     * Safely add files data to the response
     */
    protected function addFilesData(array &$data): void
    {
        $emptyFile = [
            'name'        => '',
            'size'        => 0,
            'mime_type'   => '',
        ];

        // If no files relation is loaded or files is null, return empty array
        if (!$this->relationLoaded('files') || !$this->files) {
            $data['files'] = [];
            return;
        }

        try {
            $data['files'] = FileResource::collection($this->files);
        } catch (\Throwable $e) {
            Log::error('Failed to instantiate FileResource collection', [
                'user_id'   => $this->id ?? null,
                'exception' => $e->getMessage()
            ]);

            $errorFile = $emptyFile;
            $errorFile['_error'] = __('messages.resource.files_load_error');
            $data['files'] = [$errorFile];
        }
    }
}
