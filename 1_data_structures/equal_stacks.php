<?php

/*
 * Complete the 'equalStacks' function below.
 *
 * The function is expected to return an INTEGER.
 * The function accepts following parameters:
 *  1. INTEGER_ARRAY h1
 *  2. INTEGER_ARRAY h2
 *  3. INTEGER_ARRAY h3
 */

function equalStacks($h1, $h2, $h3) {
    // Write your code here

}

$fptr = fopen(getenv("OUTPUT_PATH"), "w");

$first_multiple_input = explode(' ', rtrim(fgets(STDIN)));

$n1 = intval($first_multiple_input[0]);

$n2 = intval($first_multiple_input[1]);

$n3 = intval($first_multiple_input[2]);

$h1_temp = rtrim(fgets(STDIN));

$h1 = array_map('intval', preg_split('/ /', $h1_temp, -1, PREG_SPLIT_NO_EMPTY));

$h2_temp = rtrim(fgets(STDIN));

$h2 = array_map('intval', preg_split('/ /', $h2_temp, -1, PREG_SPLIT_NO_EMPTY));

$h3_temp = rtrim(fgets(STDIN));

$h3 = array_map('intval', preg_split('/ /', $h3_temp, -1, PREG_SPLIT_NO_EMPTY));

$result = equalStacks($h1, $h2, $h3);

fwrite($fptr, $result . "\n");

fclose($fptr);
