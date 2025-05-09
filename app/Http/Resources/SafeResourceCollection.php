<?php

namespace App\Http\Resources;

use AllowDynamicProperties;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

#[AllowDynamicProperties] class SafeResourceCollection extends ResourceCollection
{
    /**
     * Stores any errors that occur during resource processing.
     *
     * @var array<int, array<string, mixed>>
     */
    protected array $processingErrors = [];

    /**
     * Create a new resource instance.
     */
    public function __construct(mixed $resource)
    {
        $collects = $this->collects();

        // Make sure we have a valid string resource class
        if ($collects !== null) {
            $this->collects = $collects;
        } else {
            // Provide a default if collects() returns null
            $this->collects = JsonResource::class;
        }

        // Safely collect resources
        $safeResources = $this->collectResources($resource);

        parent::__construct($safeResources);
    }

    /**
     * Safely collect resources with error handling
     *
     * @return Collection<int, mixed>
     */
    protected function collectResources(mixed $resource): Collection
    {
        $collects = $this->collects;

        $resources = [];
        $errors = [];

        foreach ($resource as $key => $value) {
            try {
                $resources[] = new $collects($value);
            } catch (\Throwable $e) {
                Log::error("Failed to create resource for item {$key}", [
                    'resource_class' => $collects,
                    'exception'      => $e->getMessage()
                ]);

                $errors[] = [
                    'item_key' => $key,
                    'error'    => __('messages.resource.process_error')
                ];
            }
        }

        // Store errors for potential use in response
        $this->processingErrors = $errors;

        return collect($resources);
    }

    /**
     * Get any errors that occurred during processing
     *
     * @return array<int, array<string, mixed>>
     */
    public function getProcessingErrors(): array
    {
        return $this->processingErrors;
    }

    /**
     * Whether any errors occurred during processing
     */
    public function hasProcessingErrors(): bool
    {
        return !empty($this->processingErrors);
    }
}
