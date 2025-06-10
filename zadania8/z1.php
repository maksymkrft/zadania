<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Zadanie 8.1</title>
</head>
<body>
<form action="" method="post">
    <label for="text_input">Wprowadź ciąg znaków:</label><br>
    <input type="text" id="text_input" name="text_input" size="50"><br><br>
    <button type="submit">Przetwórz</button>
</form>
<hr>
<?php
if (isset($_POST['text_input'])) {
    $text = $_POST['text_input'];

    echo "Oryginalny ciąg: " . htmlspecialchars($text) . "<br>";
    echo "Ciąg dużymi literami: " . htmlspecialchars(strtoupper($text)) . "<br>";
    echo "Ciąg małymi literami: " . htmlspecialchars(strtolower($text)) . "<br>";
    echo "Pierwsza litera ciągu dużą literą: " . htmlspecialchars(ucfirst(strtolower($text))) . "<br>";
    echo "Wszystkie pierwsze litery każdego ze słów dużą literą: " . htmlspecialchars(ucwords(strtolower($text))) . "<br>";
}
?>
</body>
</html>