<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Zadanie 7.2</title>
</head>
<body>
<?php
function insertIntoArray(array $numbers, int $n): array|string
{
    if ($n < 0 || $n > count($numbers)) {
        return "BŁĄD";
    }
    array_splice($numbers, $n, 0, '$');
    return $numbers;
}

$originalArray = [1, 2, 3, 4, 5];
$position = 2;
$result = insertIntoArray($originalArray, $position);

echo "Original array: <pre>" . print_r($originalArray, true) . "</pre>";
echo "Inserting '$' at position $position:<br>";

if (is_array($result)) {
    echo "<pre>" . print_r($result, true) . "</pre>";
} else {
    echo $result;
}

echo "<hr>";

$invalidPosition = 10;
$errorResult = insertIntoArray($originalArray, $invalidPosition);
echo "Inserting '$' at position $invalidPosition:<br>";
echo $errorResult;
?>
</body>
</html>