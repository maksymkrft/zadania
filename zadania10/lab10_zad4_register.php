<?php
session_start();
$usersFile = 'users.txt';
$message = '';

function isEmailUnique($email, $file) {
    if (!file_exists($file)) {
        return true;
    }
    $users = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($users as $user) {
        $userData = json_decode($user, true);
        if ($userData['email'] === $email) {
            return false;
        }
    }
    return true;
}

function validatePassword($password) {
    if (strlen($password) < 6) return false;
    if (!preg_match('/[A-Z]/', $password)) return false;
    if (!preg_match('/[0-9]/', $password)) return false;
    if (!preg_match('/[\W_]/', $password)) return false;
    return true;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = $_POST['firstname'] ?? '';
    $lastname = $_POST['lastname'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Nieprawidłowy format email.';
    } elseif (!validatePassword($password)) {
        $message = 'Hasło musi mieć min. 6 znaków, 1 wielką literę, 1 cyfrę i 1 znak specjalny.';
    } elseif (!isEmailUnique($email, $usersFile)) {
        $message = 'Ten adres email jest już zarejestrowany.';
    } else {
        $userData = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ];
        file_put_contents($usersFile, json_encode($userData) . PHP_EOL, FILE_APPEND);
        $message = 'Rejestracja zakończona sukcesem! Możesz się teraz zalogować.';
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Rejestracja</title>
</head>
<body>
<h1>Formularz rejestracyjny</h1>
<?php if ($message) echo "<p><strong>$message</strong></p>"; ?>
<form action="" method="post">
    Imię: <input type="text" name="firstname" required><br><br>
    Nazwisko: <input type="text" name="lastname" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Hasło: <input type="password" name="password" required><br><br>
    <button type="submit">Zarejestruj</button>
</form>
<hr>
<a href="lab10_zad4_login.php">Przejdź do logowania</a>
</body>
</html>