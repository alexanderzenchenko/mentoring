<?php

namespace Services\TextAnalyzer;

interface TextAnalyzerInterface
{
    /**
     * @return int
     */
    public function numberOfCharacters(): int;

    /**
     * @return int
     */
    public function numberOfWords(): int;

    /**
     * @return int
     */
    public function numberOfSentences(): int;

    /**
     * @return array
     */
    public function frequencyOfCharacters(): array;

    /**
     * @return array
     */
    public function distributionAsPercentage(): array;

    /**
     * @return int
     */
    public function averageWordLength(): int;

    /**
     * @return int
     */
    public function averageNumberOfWordsInSentence(): int;

    /**
     * @return array
     */
    public function top10Words(): array;

    /**
     * @return array
     */
    public function top10LongestWords(): array;

    /**
     * @return array
     */
    public function top10ShortestWords(): array;

    /**
     * @return array
     */
    public function top10LongestSentences(): array;

    /**
     * @return array
     */
    public function top10ShortestSentences(): array;

    /**
     * @return int
     */
    public function numberOfPalindromeWords(): int;

    /**
     * @return array
     */
    public function top10LongestPalindromeWords(): array;

    /**
     * @return bool
     */
    public function isWholeTextPalindrome(): bool;

    /**
     * @return string
     */
    public function reversedText(): string;

    /**
     * @return string
     */
    public function reversedIntactText(): string;
}
