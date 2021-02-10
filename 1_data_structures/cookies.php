<?php

/*
 * Complete the cookies function below.
 */
function cookies($k, $A) {
    $minHeap = new SplMinHeap();
    foreach ($A as $item) {
        $minHeap->insert($item);
    }
    try {
        $count = 0;
        while ($minHeap->top() < $k) {
            $cookie1 = $minHeap->extract();
            $cookie2 = $minHeap->extract();
            $newCookie = $cookie1 + 2 * $cookie2;
            $minHeap->insert($newCookie);
            $count++;
        }
        return $count;
    } catch (Exception $e) {
        return -1;
    }
}

$fptr = fopen(getenv("OUTPUT_PATH"), "w");

$stdin = fopen("php://stdin", "r");

fscanf($stdin, "%[^\n]", $nk_temp);
$nk = explode(' ', $nk_temp);

$n = intval($nk[0]);

$k = intval($nk[1]);

fscanf($stdin, "%[^\n]", $A_temp);

$A = array_map('intval', preg_split('/ /', $A_temp, -1, PREG_SPLIT_NO_EMPTY));

$result = cookies($k, $A);

fwrite($fptr, $result . "\n");

fclose($stdin);
fclose($fptr);
