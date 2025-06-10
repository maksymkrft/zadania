<?php
session_start();

$valid_login = "admin";
$valid_password = "password123";

$error_message = "";

if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_unset();
    session_destroy();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login']) && isset($_POST['password'])) {
        if ($_POST['login'] === $valid_login && $_POST['password'] === $valid_password) {
            $_SESSION['loggedin'] = true;
            $_SESSION['login'] = $_POST['login'];
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            $error_message = "Błędny login lub hasło.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Zadanie 10.3</title>
</head>
<body>
<?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
    <h1>Witaj, <?php echo htmlspecialchars($_SESSION['login']); ?>!</h1>
    <p>Zostałeś poprawnie zalogowany.</p>
    <a href="?action=logout">Wyloguj</a>
<?php else: ?>
    <h1>Logowanie</h1>
    <form action="" method="post">
        <label for="login">Login:</label><br>
        <input type="text" id="login" name="login"><br><br>
        <label for="password">Hasło:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <button type="submit">Zaloguj</button>
    </form>
    <?php if (!empty($error_message)): ?>
        <p style="color:red;"><?php echo $error_message; ?></p>
        <a href="<?php echo $_SERVER['PHP_SELF']; ?>">Powrót do formularza</a>
    <?php endif; ?>
<?php endif; ?>
</body>
</html>