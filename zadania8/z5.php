<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Zadanie 8.5</title>
</head>
<body>
<form action="" method="post">
    <label for="float_input">Wprowadź liczbę zmiennoprzecinkową (użyj kropki jako separatora):</label><br>
    <input type="text" id="float_input" name="float_input"><br><br>
    <button type="submit">Oblicz</button>
</form>
<hr>
<?php
if (isset($_POST['float_input'])) {
    $input = $_POST['float_input'];

    if (filter_var($input, FILTER_VALIDATE_FLOAT) !== false) {
        $parts = explode('.', $input);
        $decimalPlaces = isset($parts[1]) ? strlen($parts[1]) : 0;
        echo "Liczba: " . htmlspecialchars($input) . "<br>";
        echo "Ilość cyfr po przecinku: " . $decimalPlaces;
    } else {
        echo "Błąd: Wprowadzono nieprawidłową liczbę.";
    }
}
?>
</body>
</html>