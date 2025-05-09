<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\File>
 */
class FileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $content = fake()->paragraphs(3, true);

        if (is_iterable($content)) {
            // If it's iterable (like a Generator or array), convert it to an array and then implode
            $contentArray = iterator_to_array($content);
            $contentString = implode("\n", $contentArray);
        } else {
            $contentString = $content;
        }

        $filename = Str::uuid() . '.txt';
        Storage::disk('secure')->put($filename, $contentString);
        $size = Storage::disk('secure')->size($filename);

        return [
            'user_id'       => User::factory(),
            'name'          => $filename,
            'original_name' => fake()->word() . '.txt',
            'mime_type'     => 'text/plain',
            'path'          => 'secure/' . $filename,
            'size'          => $size,
        ];
    }
}
