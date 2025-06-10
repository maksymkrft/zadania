<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test_db";
$tableName = "Student";
$message = "";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->query("CREATE DATABASE IF NOT EXISTS $dbname");
$conn->select_db($dbname);

if (isset($_POST['delete_table'])) {
    $sql = "DROP TABLE IF EXISTS $tableName";
    if ($conn->query($sql) === TRUE) {
        $message = "Tabela $tableName została pomyślnie usunięta.";
    } else {
        $message = "Błąd podczas usuwania tabeli: " . $conn->error;
    }
} else {
    $sql = "CREATE TABLE $tableName (
        StudentID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        Firstname VARCHAR(255) NOT NULL,
        Secondname VARCHAR(255) NOT NULL,
        Salary INT(10),
        DateOfBirth DATE
    )";

    if ($conn->query($sql) === TRUE) {
        $message = "Tabela $tableName została pomyślnie utworzona.";
    } else {
        $error_info = $conn->error;
        if (strpos($error_info, "already exists") !== false) {
            $message = "Tabela $tableName już istnieje.";
        } else {
            $message = "Błąd podczas tworzenia tabeli: " . $error_info;
        }
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Zadanie 12.1</title>
    <style>
        body { font-family: Arial, sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f0f0f0; }
        .container { text-align: center; padding: 40px; border: 1px solid #ccc; background-color: #fff; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h1 { margin-bottom: 20px; }
        p { margin-bottom: 20px; font-size: 1.1em; }
        .delete-btn { background-color: #28a745; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-size: 1em; }
        .delete-btn:hover { background-color: #218838; }
    </style>
</head>
<body>
<div class="container">
    <h1>Manage MySQL Table</h1>
    <p><?php echo $message; ?></p>
    <form method="post" action="">
        <button type="submit" name="delete_table" class="delete-btn">Delete Table</button>
    </form>
</div>
</body>
</html>