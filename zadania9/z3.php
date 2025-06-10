<?php
$counterFile = 'licznik.txt';

if (!file_exists($counterFile)) {
    $visits = 1;
    file_put_contents($counterFile, $visits);
} else {
    $visits = (int)file_get_contents($counterFile);
    $visits++;
    file_put_contents($counterFile, $visits);
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Zadanie 9.3</title>
</head>
<body>
<h1>Licznik Odwiedzin</h1>
<p>Liczba odwiedzin tej strony: <strong><?php echo $visits; ?></strong></p>
</body>
</html>