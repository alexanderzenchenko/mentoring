<?php

namespace Services\TextAnalyzer;

class MultibyteAnalyzer extends TextAnalyzerAbstract
{
    const SENTENCES_PATTERN = '/(?<=[.?!])/u';
    const WORD_SPLIT_PATTERN = '/\s+/u';

    /**
     * @return int
     */
    public function numberOfCharacters(): int
    {
        return mb_strlen($this->text);
    }

    /**
     * @return array
     */
    public function frequencyOfCharacters(): array
    {
        $l = mb_strlen($this->text, 'UTF-8');
        $unique = array();
        for($i = 0; $i < $l; $i++) {
            $char = mb_substr($this->text, $i, 1, 'UTF-8');
            if(!array_key_exists($char, $unique))
                $unique[$char] = 0;
            $unique[$char]++;
        }
        return $unique;
    }

    /**
     * @param string $text
     * @param int $format
     * @param false $unique
     * @return array|false|int|string[]
     */
    protected function wordsCount(string $text, $format = 0, $unique = false)
    {
        $words = preg_split('~[^\p{L}\p{N}\']+~u',$text);

        return $format === 0 ? count($words) : $words;
    }

    /**
     * @param string $str
     * @return int
     */
    protected function strlen(string $str): int
    {
        return mb_strlen($str);
    }

    /**
     * @param string $str
     * @return string
     */
    protected function strrev(string $str): string
    {
        $r = '';

        for ($i = mb_strlen($str); $i>=0; $i--) {
            $r .= mb_substr($str, $i, 1);
        }

        return $r;
    }

    /**
     * @param string $str
     * @return string
     */
    protected function strtolower(string $str): string
    {
        return mb_strtolower($str);
    }
}
