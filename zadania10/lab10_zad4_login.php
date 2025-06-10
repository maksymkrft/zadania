<?php
session_start();
$usersFile = 'users.txt';
$message = '';

if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_unset();
    session_destroy();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: lab10_zad4_panel.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $loggedIn = false;

    if (file_exists($usersFile)) {
        $users = file($usersFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($users as $user) {
            $userData = json_decode($user, true);
            if ($userData['email'] === $email && password_verify($password, $userData['password'])) {
                $_SESSION['loggedin'] = true;
                $_SESSION['email'] = $userData['email'];
                $_SESSION['firstname'] = $userData['firstname'];
                $loggedIn = true;
                break;
            }
        }
    }

    if ($loggedIn) {
        header("Location: lab10_zad4_panel.php");
        exit();
    } else {
        $message = 'Nieprawidłowy email lub hasło.';
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Logowanie</title>
</head>
<body>
<h1>Formularz logowania</h1>
<?php if ($message) echo "<p style='color:red;'>$message</p>"; ?>
<form action="" method="post">
    Email: <input type="email" name="email" required><br><br>
    Hasło: <input type="password" name="password" required><br><br>
    <button type="submit">Zaloguj</button>
</form>
<hr>
<a href="lab10_zad4_register.php">Nie masz konta? Zarejestruj się</a>
</body>
</html>