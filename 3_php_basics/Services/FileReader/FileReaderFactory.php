<?php


namespace Services\FileReader;


use Services\FileReader\Exceptions\NoFileReaderExistsException;
use Symfony\Component\HttpFoundation\File\File;

class FileReaderFactory
{
    public static function createFileReader(File $file): FileReaderInterface
    {
        switch ($file->getExtension()) {
            case 'txt':
                return new TxtFileReader();
            case 'xml':
                return new XMLFileReader();
            case 'html':
                return new HtmlFileReader();
            default:
                throw new NoFileReaderExistsException('No file reader for this extension');
        }
    }
}
