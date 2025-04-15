<?php
function multiply_matrices($a, $b) {
    $rowsA = count($a);
    $colsA = count($a[0]);
    $rowsB = count($b);
    $colsB = count($b[0]);

    if ($colsA != $rowsB) {
        echo "Nieprawidłowe wymiary macierzy do mnożenia.\n";
        return;
    }

    $result = array();
    for ($i = 0; $i < $rowsA; $i++) {
        for ($j = 0; $j < $colsB; $j++) {
            $sum = 0;
            for ($k = 0; $k < $colsA; $k++) {
                $sum += $a[$i][$k] * $b[$k][$j];
            }
            $result[$i][$j] = $sum;
        }
    }

    echo "Wynik mnożenia macierzy:\n";
    foreach ($result as $row) {
        echo implode(" ", $row) . "\n";
    }
}

$a = [
    [1, 2, 3],
    [4, 5, 6]
];

$b = [
    [7, 8],
    [9, 10],
    [11, 12]
];

multiply_matrices($a, $b);
?>
