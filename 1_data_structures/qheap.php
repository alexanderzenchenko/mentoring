<?php

class MinHeap extends SplMinHeap
{
    private $deleted = [];

    public function delete($value)
    {
        $this->deleted[$value] = $value;
    }

    public function min()
    {
        $min = $this->top();
        while (array_key_exists($min, $this->deleted)) {
            $this->extract();
            $min = $this->top();
        }
        return $min;
    }

    public function insert($value)
    {
        if (array_key_exists($value, $this->deleted)) {
            unset($this->deleted[$value]);
        }
        parent::insert($value);
    }
}

$_fp = fopen("php://stdin", "r");
$_out = fopen(getenv("OUTPUT_PATH"), "w");

fscanf($_fp, "%d\n", $t);

$minHeap = new MinHeap();

for ($t_itr = 0; $t_itr < $t; $t_itr++) {
    fscanf($_fp, "%[^\n]", $row);
    if (strlen($row) > 1) {
        list($query, $number) = explode(" ", $row);
    } else {
        $query = (int)$row[0];
    }
    switch ($query) {
        case 1:
            $minHeap->insert($number);
            break;
        case 2:
            $minHeap->delete($number);
            break;
        case 3:
            fwrite($_out, $minHeap->min() . "\n");
            break;
    }
}

fclose($_fp);
fclose($_out);
