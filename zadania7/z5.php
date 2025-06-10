<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Kalkulator</title>
    <link rel="stylesheet" href="lab7_zad5.css">
</head>
<body>
<div class="calculator-container">
    <h1>Kalkulator</h1>

    <div class="calculator-section">
        <h2>Prosty</h2>
        <form method="post" action="">
            <input type="text" name="num1" pattern="[0-9.-]*" required>
            <select name="op_simple">
                <option value="add">Dodawanie</option>
                <option value="subtract">Odejmowanie</option>
                <option value="multiply">Mnożenie</option>
                <option value="divide">Dzielenie</option>
            </select>
            <input type="text" name="num2" pattern="[0-9.-]*" required>
            <button type="submit" name="calc_simple">Oblicz</button>
        </form>
    </div>

    <div class="calculator-section">
        <h2>Zaawansowany</h2>
        <form method="post" action="">
            <input type="text" name="num_adv" required>
            <select name="op_advanced">
                <option value="cos">Cosinus</option>
                <option value="sin">Sinus</option>
                <option value="tan">Tangens</option>
                <option value="bin2dec">Binarne na dziesiętne</option>
                <option value="dec2bin">Dziesiętne na binarne</option>
                <option value="dec2hex">Dziesiętne na szesnastkowe</option>
                <option value="hex2dec">Szesnastkowe na dziesiętne</option>
            </select>
            <button type="submit" name="calc_advanced">Oblicz</button>
        </form>
    </div>

    <div class="result-section">
        <h3>Wynik:</h3>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $result = '';
            if (isset($_POST['calc_simple'])) {
                $num1 = filter_input(INPUT_POST, 'num1', FILTER_VALIDATE_FLOAT);
                $num2 = filter_input(INPUT_POST, 'num2', FILTER_VALIDATE_FLOAT);
                $op = $_POST['op_simple'];

                if ($num1 !== false && $num2 !== false) {
                    switch ($op) {
                        case 'add': $result = $num1 + $num2; break;
                        case 'subtract': $result = $num1 - $num2; break;
                        case 'multiply': $result = $num1 * $num2; break;
                        case 'divide':
                            if ($num2 != 0) {
                                $result = $num1 / $num2;
                            } else {
                                $result = "Błąd: Dzielenie przez zero!";
                            }
                            break;
                    }
                } else {
                    $result = "Błąd: Nieprawidłowe dane wejściowe.";
                }
            }

            if (isset($_POST['calc_advanced'])) {
                $num_adv = $_POST['num_adv'];
                $op_adv = $_POST['op_advanced'];

                switch ($op_adv) {
                    case 'cos': $result = cos(deg2rad(floatval($num_adv))); break;
                    case 'sin': $result = sin(deg2rad(floatval($num_adv))); break;
                    case 'tan': $result = tan(deg2rad(floatval($num_adv))); break;
                    case 'bin2dec':
                        if (preg_match('/^[01]+$/', $num_adv)) {
                            $result = bindec($num_adv);
                        } else {
                            $result = "Błąd: Nieprawidłowa liczba binarna.";
                        }
                        break;
                    case 'dec2bin':
                        if (filter_var($num_adv, FILTER_VALIDATE_INT) !== false) {
                            $result = decbin(intval($num_adv));
                        } else {
                            $result = "Błąd: Nieprawidłowa liczba dziesiętna.";
                        }
                        break;
                    case 'dec2hex':
                        if (filter_var($num_adv, FILTER_VALIDATE_INT) !== false) {
                            $result = dechex(intval($num_adv));
                        } else {
                            $result = "Błąd: Nieprawidłowa liczba dziesiętna.";
                        }
                        break;
                    case 'hex2dec':
                        if (ctype_xdigit($num_adv)) {
                            $result = hexdec($num_adv);
                        } else {
                            $result = "Błąd: Nieprawidłowa liczba szesnastkowa.";
                        }
                        break;
                }
            }
            echo "<p>" . htmlspecialchars($result) . "</p>";
        }
        ?>
    </div>
</div>
</body>
</html>