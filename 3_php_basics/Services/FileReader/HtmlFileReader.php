<?php


namespace Services\FileReader;


class HtmlFileReader implements FileReaderInterface
{
    protected const TAG = 'p';

    public function readFile(string $fileName): string
    {
        $domReader = new \DOMDocument();
        $domReader->loadHTMLFile($fileName);

        $text = '';

        $elements = $domReader->getElementsByTagName(static::TAG);

        foreach ($elements as $element) {
            $text .= ' ' . $element->nodeValue;
        }


        return $text;
    }
}
