<?php

namespace App\Services\Files;

use App\Exceptions\ApiBadRequestException;
use App\Models\File;
use Illuminate\Http\UploadedFile;
use Storage;

class FileService
{
    private $handlers = [
        ImageHandler::class,
        PDFHandler::class,
    ];

    private ?AbstractFileHandler $fileHandler = null;


    public function getStream(File $file){
        if( Storage::exists($file->path))
            return Storage::download($file->path, $file->original_name);
        return null;
    }

    public function delete(File $file){
        $this->getFileHandler($file->mine_type)->delete($file);
    }

    public function save(UploadedFile $uploadedFile){
        $path = $this->getFileHandler($uploadedFile->getClientMimeType())->store($uploadedFile);

        $file = new File([
            'mine_type' => $uploadedFile->getMimeType(),
            'original_name' => $uploadedFile->getClientOriginalName(),
            'original_extension' => $uploadedFile->getClientOriginalExtension(),
            'path' => $path,
        ]);

        // Todo: check if saving was successfully
        $file->save();

        return $file;
    }

    private function findHandlerClass(string $fileType): string{
        foreach ($this->handlers as $handler)
            if (in_array($fileType, $handler::fileTypes))
                return $handler;

        throw new ApiBadRequestException('File format (mime type) not supported');
    }

    private function getFileHandler(string $fileType): AbstractFileHandler{
        $handlerClass = $this->findHandlerClass($fileType);

        if (!($this->fileHandler instanceof $handlerClass))
            $this->fileHandler = new $handlerClass;

        return $this->fileHandler;
    }
}
