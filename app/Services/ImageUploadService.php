<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageUploadService
{
    private string $disk;

    public function __construct()
    {
        $this->disk = config('filesystems.uploads_disk', 'public');
    }

    /**
     * Store an uploaded image, replacing any previous file at $previousPath.
     */
    public function store(UploadedFile $file, string $directory, ?string $previousPath = null): string
    {
        $path = $file->store($directory, $this->disk);

        $this->delete($previousPath);

        return $path;
    }

    public function delete(?string $path): void
    {
        if ($path && Storage::disk($this->disk)->exists($path)) {
            Storage::disk($this->disk)->delete($path);
        }
    }

    /**
     * A URL the browser can load. The local "public" disk serves a permanent
     * URL via the storage:link symlink; the "b2" disk is a private bucket, so
     * it needs a short-lived signed URL generated per request instead.
     */
    public function url(?string $path): ?string
    {
        if (! $path) {
            return null;
        }

        $disk = Storage::disk($this->disk);

        return config("filesystems.disks.{$this->disk}.driver") === 's3'
            ? $disk->temporaryUrl($path, now()->addMinutes(30))
            : $disk->url($path);
    }
}
