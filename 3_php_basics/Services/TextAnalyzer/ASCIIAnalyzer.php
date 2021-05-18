<?php

namespace Services\TextAnalyzer;


class ASCIIAnalyzer extends TextAnalyzerAbstract//implements AnalyzerInterface
{
    /**
     * @return int
     */
    public function numberOfCharacters(): int
    {
        return strlen($this->text);
    }

    /**
     * @return array
     */
    public function frequencyOfCharacters(): array
    {
        $countChars = count_chars($this->text);

        $result = [];
        foreach ($countChars as $char => $count) {
            if ($count > 0) {
                $result[chr($char)] = $count;
            }
        }

        return $result;
    }

    /**
     * @param string $text
     * @param int $format
     * @param false $unique
     * @return array|int|string[]
     */
    protected function wordsCount(string $text, $format = 0, $unique = false)
    {
        $result = str_word_count($text, $format);

        if ($format === 0) {
            return $result;
        }

        if ($unique) {
            $result = array_unique($result);
        }

        return $result;
    }

    /**
     * @param string $str
     * @return int
     */
    protected function strlen(string $str): int
    {
        return strlen($str);
    }

    /**
     * @param string $str
     * @return string
     */
    protected function strrev(string $str): string
    {
        return strrev($str);
    }

    /**
     * @param string $str
     * @return string
     */
    protected function strtolower(string $str): string
    {
        return strtolower($str);
    }
}
