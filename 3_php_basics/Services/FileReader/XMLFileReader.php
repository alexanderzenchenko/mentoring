<?php


namespace Services\FileReader;


class XMLFileReader implements FileReaderInterface
{

    public function readFile(string $fileName): string
    {
        return simplexml_load_file($fileName)->text;
    }
}
