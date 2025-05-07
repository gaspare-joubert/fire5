<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class UserResourceCollection extends SafeResourceCollection
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects = UserResource::class;

    /**
     * Transform the resource collection into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection,
            'errors' => $this->hasProcessingErrors() ? $this->getProcessingErrors() : null
        ];
    }
}
