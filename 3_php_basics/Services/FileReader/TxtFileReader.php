<?php


namespace Services\FileReader;


class TxtFileReader implements FileReaderInterface
{

    public function readFile(string $fileName): string
    {
        return file_get_contents($fileName);
    }
}
