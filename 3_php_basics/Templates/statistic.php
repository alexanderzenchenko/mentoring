<?php
ob_start();

function printArray(array $array)
{
    foreach ($array as $key => $value) {
        echo '"' . $key . '" :' . $value . '<br>';
    }
}
?>
<p>
    <?= $createdAt ?>
</p>
<h3>Statistic for the text:</h3>
<p>
    <?= $text ?>
</p>
<div class="col">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Action</th>
                <th scope="col">Result</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Number of characters:</td>
                <td><?= $analyzer->numberOfCharacters() ?></td>
            </tr>
            <tr>
                <td>Number of words:</td>
                <td><?= $analyzer->numberOfWords() ?></td>
            </tr>
            <tr>
                <td>Number of sentences:</td>
                <td><?= $analyzer->numberOfSentences() ?></td>
            </tr>
            <tr>
                <td>Frequency of characters:</td>
                <td><?php printArray($analyzer->frequencyOfCharacters()) ?></td>
            </tr>
            <tr>
                <td>Destribution as percentage:</td>
                <td><?php printArray($analyzer->distributionAsPercentage()) ?></td>
            </tr>
            <tr>
                <td>Avg word length:</td>
                <td><?= $analyzer->averageWordLength() ?></td>
            </tr>
            <tr>
                <td>Avg number of words in sentence:</td>
                <td><?= $analyzer->averageNumberOfWordsInSentence() ?></td>
            </tr>
            <tr>
                <td>Top 10 words:</td>
                <td><?php printArray($analyzer->top10Words()) ?></td>
            </tr>
            <tr>
                <td>Top 10 longest words:</td>
                <td><?php printArray($analyzer->top10LongestWords()) ?></td>
            </tr>
            <tr>
                <td>Top 10 shortest words:</td>
                <td><?php printArray($analyzer->top10ShortestWords()) ?></td>
            </tr>
            <tr>
                <td>Top 10 longest sentences:</td>
                <td><?php printArray($analyzer->top10LongestSentences()) ?></td>
            </tr>
            <tr>
                <td>Top 10 shortest sentences:</td>
                <td><?php printArray($analyzer->top10ShortestSentences()) ?></td>
            </tr>
            <tr>
                <td>Number of palindrome words:</td>
                <td><?= $analyzer->numberOfPalindromeWords() ?></td>
            </tr>
            <tr>
                <td>Top 10 longest palindrome words:</td>
                <td><?php printArray($analyzer->top10LongestPalindromeWords()) ?></td>
            </tr>
            <tr>
                <td>Is a whole text is a palindrome:</td>
                <td><?= $analyzer->isWholeTextPalindrome()?'yes':'no' ?></td>
            </tr>
        </tbody>
    </table>
</div>
<h3>Reversed text:</h3>
<p>
    <?= $analyzer->reversedText() ?>
</p>

<h3>Reversed text:</h3>
<p>
    <?= $analyzer->reversedIntactText() ?>
</p>
<?php return ob_get_clean(); ?>
