<?php

namespace App\Services\Files;

use Illuminate\Http\UploadedFile;

class PDFHandler extends AbstractFileHandler
{
    protected string $directory = "pdf";

    public const fileTypes = [
        'application/pdf',
    ];

    public function store(UploadedFile $uploadedFile): string
    {
        return $uploadedFile->store($this->directory);
    }
}
