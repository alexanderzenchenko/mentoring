<?php

namespace Services\TextAnalyzer;

interface TextAnalyzerInterface
{
    public function numberOfCharacters(): int;
    public function numberOfWords(): int;
    public function numberOfSentences(): int;
    public function frequencyOfCharacters(): array;
    public function distributionAsPercentage(): array;
    public function averageWordLength(): int;
    public function averageNumberOfWordsInSentence(): int;
    public function top10Words(): array;
    public function top10LongestWords(): array;
    public function top10ShortestWords(): array;
    public function top10LongestSentences(): array;
    public function top10ShortestSentences(): array;
    public function numberOfPalindromeWords(): int;
    public function top10LongestPalindromeWords(): array;
    public function isWholeTextPalindrome(): bool;
    public function reversedText(): string;
    public function reversedIntactText(): string;
}
