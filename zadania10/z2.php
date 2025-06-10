<?php
$cookie_name = "poll_voted";
$voted = isset($_COOKIE[$cookie_name]);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$voted) {
    if (isset($_POST['vote'])) {
        setcookie($cookie_name, "yes", time() + (86400 * 365));
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Zadanie 10.2</title>
</head>
<body>
<h1>Sonda internetowa</h1>
<?php if ($voted): ?>
    <p><strong>Dziękujemy, już zagłosowałeś w tej sondzie!</strong></p>
<?php else: ?>
    <form action="" method="post">
        <p>Jaki jest Twój ulubiony język programowania?</p>
        <input type="radio" id="php" name="vote" value="php" required>
        <label for="php">PHP</label><br>
        <input type="radio" id="python" name="vote" value="python">
        <label for="python">Python</label><br>
        <input type="radio" id="javascript" name="vote" value="javascript">
        <label for="javascript">JavaScript</label><br><br>
        <button type="submit">Głosuj</button>
    </form>
<?php endif; ?>
</body>
</html>