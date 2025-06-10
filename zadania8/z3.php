<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Zadanie 8.3</title>
    <link rel="stylesheet" href="lab8_zad3.css">
</head>
<body>
<div class="container">
    <h1>Operacje na ciągach znaków</h1>
    <form action="" method="post">
        <input type="text" name="input_string" placeholder="Wprowadź tekst" value="<?php echo isset($_POST['input_string']) ? htmlspecialchars($_POST['input_string']) : ''; ?>">
        <select name="operation">
            <option value="reverse">Odwrócenie ciągu znaków</option>
            <option value="upper">Zamiana na wielkie litery</option>
            <option value="lower">Zamiana na małe litery</option>
            <option value="length">Liczenie liczby znaków</option>
            <option value="trim">Usuwanie białych znaków</option>
        </select>
        <button type="submit">Wykonaj</button>
    </form>

    <div class="result">
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $inputString = $_POST['input_string'];
            $operation = $_POST['operation'];
            $result = '';

            if (empty($inputString)) {
                echo "<p class='error'>Błąd: Pole tekstowe nie może być puste.</p>";
            } else {
                switch ($operation) {
                    case 'reverse':
                        $result = strrev($inputString);
                        break;
                    case 'upper':
                        $result = strtoupper($inputString);
                        break;
                    case 'lower':
                        $result = strtolower($inputString);
                        break;
                    case 'length':
                        $result = strlen($inputString);
                        break;
                    case 'trim':
                        $result = trim($inputString);
                        break;
                    default:
                        $result = 'Nieznana operacja.';
                }
                echo "<h2>Wynik:</h2><p>" . htmlspecialchars($result) . "</p>";
            }
        }
        ?>
    </div>
</div>
</body>
</html>