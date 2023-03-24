<?php

namespace App\Services\Files;

use App\Models\File;
use Illuminate\Http\UploadedFile;
use Exception;
use Storage;

abstract class AbstractFileHandler
{
    protected string $directory = "";

    public const fileTypes = [];

    public abstract function store(UploadedFile $uploadedFile): string;

    public function delete(File $file): bool{
        try {
            $path = $file->path;

            if(Storage::exists($path))
                Storage::delete($path);
        } catch(Exception) {
            return false;
        } finally {
            $file->delete();
        }

        return true;
    }
}
