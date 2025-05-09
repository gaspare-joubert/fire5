<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\FileStoreRequest;
use App\Http\Resources\FileResource;
use App\Services\FileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;

class FileController extends Controller
{
    protected FileService $fileService;

    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    /**
     * Store uploaded files
     */
    public function store(FileStoreRequest $request, int $id): JsonResponse
    {
        $uploadedFiles = [];

        if ($request->hasFile('files')) {
            // Ensure we always pass an array to storeFiles
            $files = $request->file('files');
            $filesArray = Arr::wrap($files);

            $uploadedFiles = $this->fileService->storeFiles(
                $filesArray,
                $id
            );
        }

        if (!$uploadedFiles) {
            return response()->json(
                [
                    'status'  => __('messages.status_error'),
                    'message' => __('messages.file.store_failed'),
                ]
            );
        }

        return response()->json(
            [
                'status'  => __('messages.status_success'),
                'message' => __('messages.file.store_success'),
                'files'   => FileResource::collection($uploadedFiles)
            ]
        );
    }
}
