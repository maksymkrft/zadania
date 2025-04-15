<?php
function numbers($value) {
    if (!is_numeric($value)) {
        echo "Nieprawidłowy parametr.\n";
        return;
    }

    $value = abs((int)$value);

    while ($value >= 10) {
        $digits = str_split((string)$value);
        $value = array_sum($digits);
    }

    echo "Wynik: $value\n";
}

numbers(5210);
numbers(-5210);
numbers(5210.5);
numbers("numbers");
?>
