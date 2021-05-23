<?php

namespace Services\FileReader;

use Symfony\Component\HttpFoundation\File\File;

interface FileReaderInterface
{
    public function readFile(string $fileName): string;
}
