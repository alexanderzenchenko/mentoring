<?php

namespace Services\FileUploader;

use Symfony\Component\HttpFoundation\Request;

interface FileUploaderInterface
{
    public function upload(string $inputName, Request $request);
}
