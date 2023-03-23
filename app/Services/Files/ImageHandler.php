<?php

namespace App\Services\Files;

use Illuminate\Http\UploadedFile;

class ImageHandler extends AbstractFileHandler
{
    protected string $directory = "images";

    public const fileTypes = [
        'image/jpg',
        'image/jpeg',
        'image/png',
    ];

    public function store(UploadedFile $uploadedFile): string
    {
        return $uploadedFile->store($this->directory);
    }
}
