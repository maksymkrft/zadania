<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Zadanie 8.4</title>
</head>
<body>
<form action="" method="post">
    <label for="text_input">Wprowadź ciąg znaków:</label><br>
    <input type="text" id="text_input" name="text_input" size="50"><br><br>
    <button type="submit">Policz samogłoski</button>
</form>
<hr>
<?php
if (isset($_POST['text_input'])) {
    $text = strtolower($_POST['text_input']);
    $vowels = ['a', 'e', 'i', 'o', 'u'];
    $vowelCount = 0;

    for ($i = 0; $i < strlen($text); $i++) {
        if (in_array($text[$i], $vowels)) {
            $vowelCount++;
        }
    }

    echo "Wprowadzony tekst: " . htmlspecialchars($_POST['text_input']) . "<br>";
    echo "Ilość samogłosek (a, e, i, o, u): " . $vowelCount;
}
?>
</body>
</html>