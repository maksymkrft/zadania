<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Zadanie 7.3</title>
</head>
<body>
<?php
function createArrayWithRanges(int $a, int $b, int $c, int $d)
{
    if (($b - $a) !== ($d - $c)) {
        echo "Error: The length of the key range must match the length of the value range.";
        return;
    }

    $keys = range($a, $b);
    $values = range($c, $d);
    $resultArray = array_combine($keys, $values);

    echo "<pre>";
    print_r($resultArray);
    echo "</pre>";
}

createArrayWithRanges(5, 10, 20, 25);
?>
</body>
</html>