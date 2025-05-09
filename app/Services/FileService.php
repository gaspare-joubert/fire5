<?php
/**
 * @file FileService.php
 *
 * @author Gaspare Joubert
 * @date 04/05/2025 13:46
 *
 */

namespace App\Services;

use App\Models\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class FileService
{
    /**
     * Store a single uploaded file
     */
    public function storeFile(UploadedFile $uploadedFile, int $userId): ?File
    {
        try {
            $filename = Str::uuid() . '.' . $uploadedFile->getClientOriginalExtension();
            $path = $uploadedFile->storeAs('', $filename, 'secure');

            // Create a record in the database
            return File::create(
                [
                    'user_id'       => $userId,
                    'name'          => $filename,
                    'original_name' => $uploadedFile->getClientOriginalName(),
                    'mime_type'     => $uploadedFile->getMimeType(),
                    'path'          => 'secure/' . $path,
                    'size'          => $uploadedFile->getSize(),
                ]
            );
        } catch (\Exception $e) {
            Log::error('Failed to store file and create record in database.', [
                'filename'  => $filename,
                'path'      => 'secure/' . $path,
                'exception' => $e->getMessage(),
            ]);

            return null;
        }
    }

    /**
     * Store multiple uploaded files
     *
     * @param array<int, UploadedFile> $files
     * @return array<int, File|null>
     */
    public function storeFiles(array $files, int $userId): array
    {
        $uploadedFiles = [];

        foreach ($files as $uploadedFile) {
            $uploadedFiles[] = $this->storeFile($uploadedFile, $userId);
        }

        return $uploadedFiles;
    }
}
