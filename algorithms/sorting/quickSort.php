<?php

// Time Complexity from O(n log(n)) to O(n^2)
// Space Complexity O(log(n))

function doSort(array &$items, int $fst, int $lst): array {
    if ($fst >= $lst) 
        return [];
    $i = $fst;
    $j = $lst;
    $x = $items[(int)(($fst + $lst)/2)];

    while ($i < $j) {
        while ($items[$i] < $x) $i++;
        while ($items[$j] > $x) $j--;
        if ($i <= $j) {
            $tmp = $items[$i];
            $items[$i] = $items[$j];
            $items[$j] = $tmp;
            $i++;
            $j--;
        }
    }
    doSort($items, $fst, $j);
    doSort($items, $i, $lst);
    return $items;
}

function quickSort(array $arr): array
{
    $len = count($arr);
    $items = doSort($arr, 0, $len - 1);
    return $items;
}

$items = [ 4, 1, 5, 3, 2 ];

$sortItems = quickSort($items);
// sortItems is {1, 2, 3, 4, 5}
print_r($sortItems);

// *** simplified speed test ***
$items = [];
for ($i = 0; $i < 200; $i++) {
    $items[$i] = $i;
}
$tmp = $items[5];
$items[5] = $items[6];
$items[6] = $tmp;         
$count = 10000;
$start = strtotime("now");

for ($i = 0; $i < $count; $i++)
    quickSort($items);

$seconds = strtotime("now") - $start;

echo $seconds;
// about 1 seconds
