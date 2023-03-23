<?php

namespace App\Services\Files;

use Illuminate\Http\UploadedFile;

abstract class AbstractFileHandler
{
    protected string $directory = "";

    public const fileTypes = [];

    public abstract function store(UploadedFile $uploadedFile): string;
}
