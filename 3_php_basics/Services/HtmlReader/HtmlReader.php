<?php


namespace Services\HtmlReader;


class HtmlReader implements HtmlReaderInterface
{
    const TAG = 'p';

    public function read(string $html): string
    {
        $domReader = new \DOMDocument();

        libxml_use_internal_errors(true);
        $domReader->loadHTML($html);
        libxml_clear_errors();

        $text = '';

        $elements = $domReader->getElementsByTagName(static::TAG);

        foreach ($elements as $element) {
            $text .= ' ' . $element->nodeValue;
        }

        return $text;
    }
}
