<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Zadanie 8.2</title>
</head>
<body>
<form action="" method="post">
    <label for="text_input">Wprowadź ciąg liczb z niepożądanymi znakami:</label><br>
    <input type="text" id="text_input" name="text_input" size="50"><br><br>
    <button type="submit">Oczyść</button>
</form>
<hr>
<?php
if (isset($_POST['text_input'])) {
    $text = $_POST['text_input'];
    $unwanted_chars = ['\\', '/', ':', '*', '?', '"', '<', '>', '|', ' ', '+', '-', '.'];

    $cleaned_text = str_replace($unwanted_chars, '', $text);

    echo "Oryginalny ciąg: " . htmlspecialchars($text) . "<br>";
    echo "Oczyszczony ciąg: " . htmlspecialchars($cleaned_text) . "<br>";
}
?>
</body>
</html>