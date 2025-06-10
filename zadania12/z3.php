<?php
$host = 'localhost';
$db   = 'registration_db';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

try {
    $pdo = new PDO("mysql:host=$host", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$db`");
    $pdo->exec("USE `$db`");

    $pdo->exec("CREATE TABLE IF NOT EXISTS Users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        firstname VARCHAR(100) NOT NULL,
        lastname VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        phone VARCHAR(20),
        registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB;");

} catch (\PDOException $e) {
    die("Błąd bazy danych: " . $e->getMessage());
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("INSERT INTO Users (firstname, lastname, email, password, phone) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$firstname, $lastname, $email, $hashed_password, $phone]);
        $message = "Rejestracja pomyślna!";
    } catch (\PDOException $e) {
        if ($e->errorInfo[1] == 1062) {
            $message = "Błąd: Email jest już zarejestrowany.";
        } else {
            $message = "Błąd rejestracji: " . $e->getMessage();
        }
    }
}

$userCount = $pdo->query("SELECT count(*) FROM Users")->fetchColumn();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Zadanie 12.3</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #e0f7fa; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        .form-container { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); width: 350px; }
        h2 { text-align: center; color: #00796b; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; }
        .form-group input { width: 100%; padding: 8px; border: 1px solid #b2dfdb; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background-color: #00796b; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; }
        button:hover { background-color: #004d40; }
        .message { text-align: center; margin-bottom: 15px; color: #d32f2f; }
        .user-count { text-align: center; margin-top: 20px; color: #555; }
    </style>
</head>
<body>
<div class="form-container">
    <h2>Registration Form</h2>
    <?php if($message): ?><p class="message"><?= $message ?></p><?php endif; ?>
    <form action="" method="post">
        <div class="form-group"><label for="fn">First Name:</label><input type="text" id="fn" name="firstname" required></div>
        <div class="form-group"><label for="ln">Last Name:</label><input type="text" id="ln" name="lastname" required></div>
        <div class="form-group"><label for="em">Email:</label><input type="email" id="em" name="email" required></div>
        <div class="form-group"><label for="ph">Phone:</label><input type="tel" id="ph" name="phone"></div>
        <div class="form-group"><label for="pw">Password:</label><input type="password" id="pw" name="password" required></div>
        <button type="submit">Register</button>
    </form>
    <p class="user-count">Zarejestrowanych użytkowników: <strong><?= $userCount ?></strong></p>
</div>
</body>
</html>