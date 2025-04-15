<?php
function sequences_n($start, $step, $count) {
    if (!is_numeric($start) || !is_numeric($step) || !is_numeric($count) || $count < 1) {
        echo "Nieprawidłowe dane wejściowe.\n";
        return;
    }

    $start = floatval($start);
    $step = floatval($step);
    $count = intval($count);

    echo "Ciąg arytmetyczny:<br>";
    for ($i = 0; $i < $count; $i++) {
        $element = $start + $i * $step;
        echo $element . " ";
    }
    echo "<br>";

    // Ciąg geometryczny
    echo "Ciąg geometryczny:<br>";
    for ($i = 0; $i < $count; $i++) {
        $element = $start * pow($step, $i);
        echo $element . " ";
    }
    echo "<br>";
}

sequences_n(5, 2, 10);
sequences_n(5, -2, 10);
sequences_n(-5, 2, 10);
sequences_n(5, 2.5, 10);
sequences_n(5, 2.5, -10);
sequences_n("start", 2, 10);
?>
