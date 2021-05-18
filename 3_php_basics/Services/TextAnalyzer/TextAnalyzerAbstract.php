<?php

namespace Services\TextAnalyzer;


abstract class TextAnalyzerAbstract implements TextAnalyzerInterface
{
    const SENTENCES_PATTERN = '/(?<=[.?!])/'; //'/([^\.\!\?]+[\.\?\!]*)/'
    const WORD_SPLIT_PATTERN = '/\s+/';
    const TOP_WORDS_COUNT = 10;

    protected string $text;

    /**
     * TextAnalyzerAbstract constructor.
     * @param string $text
     */
    public function __construct(string $text)
    {
        $this->text = $text;
    }

    /**
     * @return int
     */
    public abstract function numberOfCharacters(): int;

    /**
     * @param string $text
     * @param int $format
     * @param false $unique
     * @return mixed
     */
    protected abstract function wordsCount(string $text, $format = 0, $unique = false);

    /**
     * @param string $str
     * @return int
     */
    protected abstract function strlen(string $str): int;

    /**
     * @param string $str
     * @return string
     */
    protected abstract function strrev(string $str): string;

    /**
     * @param string $str
     * @return string
     */
    protected abstract function strtolower(string $str): string;

    /**
     * @return int
     */
    public function numberOfWords(): int
    {
        return $this->wordsCount($this->text);
    }

    /**
     * @return int
     */
    public function numberOfSentences(): int
    {
        return preg_match_all(static::SENTENCES_PATTERN, $this->text, $match);
    }

    /**
     * @return array
     */
    public abstract function frequencyOfCharacters(): array;

    /**
     * @return array
     */
    public function distributionAsPercentage(): array
    {
        $numberOfCharacters = $this->numberOfCharacters($this->text);
        $frequencyOfCharacters = $this->frequencyOfCharacters();

        if ($numberOfCharacters === 0) {
            return [];
        }

        array_walk($frequencyOfCharacters, function(&$count, $char) use ($numberOfCharacters) {
            $count = $count / $numberOfCharacters * 100;
        });

        return $frequencyOfCharacters;
    }

    /**
     * @return int
     */
    public function averageWordLength(): int
    {
        $words = $this->wordsCount($this->text, 1);
        $numberOfWords = $this->numberOfWords();

        if ($numberOfWords === 0) {
            return 0;
        }

        $sum = 0;

        foreach ($words as $word) {
            $sum += $this->strlen($word);
        }

        return $sum / $numberOfWords;
    }

    /**
     * @return int
     */
    public function averageNumberOfWordsInSentence(): int
    {
        $sentences = $this->splitBySentences($this->text);
        $numberOfSentences = $this->numberOfSentences();

        if ($numberOfSentences === 0) {
            return 0;
        }

        $sum = 0;

        foreach ($sentences as $sentence) {
            $sum += $this->wordsCount($sentence);
        }

        return $sum / $this->numberOfSentences();
    }

    /**
     * @return array
     */
    public function top10Words(): array
    {
        $words = $this->wordsCount($this->text, 1);
        $mostUsedWords = array_count_values($words);
        arsort($mostUsedWords);

        return array_slice($mostUsedWords, 0, self::TOP_WORDS_COUNT);
    }

    /**
     * @return array
     */
    public function top10LongestWords(): array
    {
        $words = $this->wordsCount($this->text, 1, true);
        $wordsWithLength = $this->getWordsOrSentencesWithLength($words);
        arsort($wordsWithLength);

        return array_splice($wordsWithLength, 0, self::TOP_WORDS_COUNT);
    }

    /**
     * @return array
     */
    public function top10ShortestWords(): array
    {
        $words = $this->wordsCount($this->text, 1, true);
        $wordsWithLength = $this->getWordsOrSentencesWithLength($words);
        asort($wordsWithLength);

        return array_splice($wordsWithLength, 0, self::TOP_WORDS_COUNT);
    }

    /**
     * @return array
     */
    public function top10LongestSentences(): array
    {
        $sentences = $this->splitBySentences($this->text);
        $sentencesWithLength = $this->getWordsOrSentencesWithLength($sentences);
        arsort($sentencesWithLength);

        return array_splice($sentencesWithLength, 0, self::TOP_WORDS_COUNT);
    }

    /**
     * @return array
     */
    public function top10ShortestSentences(): array
    {
        $sentences = $this->splitBySentences($this->text);
        $sentencesWithLength = $this->getWordsOrSentencesWithLength($sentences);
        asort($sentencesWithLength);

        return array_splice($sentencesWithLength, 0, self::TOP_WORDS_COUNT);
    }

    /**
     * @return int
     */
    public function numberOfPalindromeWords(): int
    {
        $words = $this->wordsCount($this->text, 1);
        $count = 0;

        foreach ($words as $word) {
            if ($this->isPalindrome($word)) {
                $count++;
            }
        }

        return $count;
    }

    /**
     * @return array
     */
    public function top10LongestPalindromeWords(): array
    {
        $words = $this->wordsCount($this->text, 1);

        $result = [];

        foreach ($words as $word) {
            if ($this->isPalindrome($word)) {
                $result[] = $word;
            }
        }

        $wordsWithLength = $this->getWordsOrSentencesWithLength($result);

        arsort($wordsWithLength);

        return array_splice($wordsWithLength, 0, self::TOP_WORDS_COUNT);
    }

    /**
     * @return bool
     */
    public function isWholeTextPalindrome(): bool
    {
        return static::isPalindrome($this->text);
    }

    /**
     * @return string
     */
    public function reversedText(): string
    {
        return $this->strrev($this->text);
    }

    /**
     * @return string
     */
    public function reversedIntactText(): string
    {
        $words = $this->wordsCount($this->text, 1);

        $reversedWords = array_reverse($words);

        return implode(' ', $reversedWords);
    }

    /**
     * @param string $text
     * @return array
     */
    private function splitBySentences(string $text): array
    {
        return preg_split(static::SENTENCES_PATTERN, $text);
    }

    /**
     * @param array $words
     * @return array
     */
    private function getWordsOrSentencesWithLength(array $words): array
    {
        $wordsWithLength = [];

        foreach ($words as $word) {
            $wordsWithLength[$word] = $this->strlen($word);
        }

        return $wordsWithLength;
    }

    /**
     * @param string $word
     * @return bool
     */
    private function isPalindrome(string $word): bool
    {
        $word = str_replace(' ', '', $word);
        $word = $this->strtolower($word);
        $reverse = $this->strrev($word);

        return $word == $reverse;
    }
}
