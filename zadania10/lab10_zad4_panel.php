<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: lab10_zad4_login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Panel użytkownika</title>
</head>
<body>
<h1>Witaj, <?php echo htmlspecialchars($_SESSION['firstname']); ?>!</h1>
<p>Zalogowano pomyślnie.</p>
<a href="lab10_zad4_login.php?action=logout">Wyloguj</a>
</body>
</html>