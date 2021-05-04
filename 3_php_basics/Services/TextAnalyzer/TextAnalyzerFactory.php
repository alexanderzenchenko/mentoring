<?php

namespace Services\TextAnalyzer;


class TextAnalyzerFactory
{
    public const UTF_8 = 'UTF-8';

    /**
     * @param string $text
     * @return TextAnalyzerInterface
     */
    public static function createTextAnalyzer(string $text): TextAnalyzerInterface
    {
        if (mb_check_encoding($text, static::UTF_8)) {
            return new MultibyteAnalyzer($text);
        }

        return new ASCIIAnalyzer($text);
    }
}
