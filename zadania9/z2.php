<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Zadanie 9.2</title>
</head>
<body>
<h2>Zarządzanie katalogami</h2>
<form action="" method="post">
    <label for="path">Ścieżka (np. ./):</label><br>
    <input type="text" id="path" name="path" value="./temp/" required><br><br>

    <label for="dir_name">Nazwa katalogu:</label><br>
    <input type="text" id="dir_name" name="dir_name" required><br><br>

    <label for="operation">Operacja:</label><br>
    <select id="operation" name="operation">
        <option value="read">read</option>
        <option value="create">create</option>
        <option value="delete">delete</option>
    </select><br><br>

    <button type="submit">Wykonaj</button>
</form>
<hr>
<h3>Wynik:</h3>
<?php
function manageDirectory(string $path, string $dirName, string $operation = 'read'): string {
    if (substr($path, -1) !== '/') {
        $path .= '/';
    }
    $fullPath = $path . $dirName;

    switch ($operation) {
        case 'create':
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            if (file_exists($fullPath)) {
                return "Błąd: Katalog '$fullPath' już istnieje.";
            }
            if (mkdir($fullPath, 0777, true)) {
                return "Sukces: Stworzono katalog '$fullPath'.";
            } else {
                return "Błąd: Nie udało się stworzyć katalogu '$fullPath'.";
            }

        case 'delete':
            if (!is_dir($fullPath)) {
                return "Błąd: Katalog '$fullPath' nie istnieje.";
            }
            if (count(scandir($fullPath)) > 2) {
                return "Błąd: Katalog '$fullPath' nie jest pusty.";
            }
            if (rmdir($fullPath)) {
                return "Sukces: Usunięto katalog '$fullPath'.";
            } else {
                return "Błąd: Nie udało się usunąć katalogu '$fullPath'.";
            }

        case 'read':
            if (!is_dir($fullPath)) {
                return "Błąd: Katalog '$fullPath' nie istnieje.";
            }
            $files = array_diff(scandir($fullPath), ['.', '..']);
            if (empty($files)) {
                return "Katalog '$fullPath' jest pusty.";
            }
            return "Zawartość katalogu '$fullPath': <pre>" . print_r($files, true) . "</pre>";

        default:
            return "Błąd: Nieznana operacja.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $path = $_POST['path'];
    $dir_name = $_POST['dir_name'];
    $operation = $_POST['operation'];
    echo manageDirectory($path, $dir_name, $operation);
}
?>
</body>
</html>