<?php

namespace App\Services\Files\Zip;

use Illuminate\Support\Collection;
use ZipArchive;

class ZipService
{
    const ZIP_DIR = 'storage/';

    public function compress(Collection $files, string $zipTitle){
        $zip = new ZipArchive();

        $zipName = self::ZIP_DIR . $zipTitle;

        $zip->open($zipName, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        foreach ($files as $f){
            $zip->addFile($f->getAbsolutePath(), $f->original_name);
        }

        $zip->close();

        return $zipName;
    }
}
