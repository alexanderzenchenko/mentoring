<?php

namespace Services\FileUploader;

use Services\FileUploader\Exceptions\FileTypeException;
use Services\FileUploader\Exceptions\FileUploaderException;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;

class FileUploader implements FileUploaderInterface
{
    protected const UPLOAD_DIR = __DIR__ . '/../../uploads/';
    protected const ALLOWED_EXTENSIONS = ['txt', 'xml', 'html'];

    public function upload(string $inputName, Request $request)
    {
        $file = $request->files->get($inputName);

        if ($file === null) {
            throw new FileUploaderException('No file chosen');
        }

        if (!$this->checkFileType($file->guessClientExtension())) {
            throw new FileTypeException('Not allowed extension');
        }

        try {
            return $file->move(static::UPLOAD_DIR, $file->getClientOriginalName());
        } catch (FileException $e) {
            throw $e;
        }
    }

    private function checkFileType($fileType)
    {
        return in_array($fileType, static::ALLOWED_EXTENSIONS);
    }
}
