<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<?php
function is_prime($n) {
    if ($n < 2) {
        return false;
    }
    if ($n == 2) {
        return true;
    }
    if ($n % 2 == 0) {
        return false;
    }
    for ($i = 3; $i <= sqrt($n); $i += 2) {
        if ($n % $i == 0) {
            return false;
        }
    }
    return true;
}
function print_primes($a, $b) {
    // Próba konwersji argumentów na liczby
    if (!is_numeric($a) || !is_numeric($b)) {
        echo "Podano niewłaściwy typ danych.<br>";
        return;
    }

    if($a&&$b<0){
        echo "liczby mniejsze od 0.<br>";
        return;
    }
    $start = min($a, $b);
    $end = max($a, $b);

    if ($start < 2) {
        $start = 2;
    }

    $primes = array();
    for ($num = $start; $num <= $end; $num++) {
        if (is_prime($num)) {
            $primes[] = $num;
        }
    }

    if (!empty($primes)) {
        echo "Liczby pierwsze w zakresie $start - $end: " . implode(" ", $primes) . "<br>";
    } else {
        echo "Brak liczb pierwszych w zadanym zakresie.<br>";
    }
}

// Przykładowe wywołania:
print_primes(5, 10);
print_primes(10, 5);
print_primes(5.5, 10);
print_primes(-5, 10);
print_primes("prime", 10);
?>
</body>
</html>