<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Zadanie 9.4</title>
</head>
<body>
<h1>Lista odnośników</h1>
<ul>
    <?php
    $linksFile = 'links.txt';
    if (file_exists($linksFile)) {
        $lines = file($linksFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            $parts = explode(';', $line, 2);
            if (count($parts) === 2) {
                $url = trim($parts[0]);
                $description = trim($parts[1]);
                echo '<li><a href="' . htmlspecialchars($url) . '">' . htmlspecialchars($description) . '</a></li>';
            }
        }
    } else {
        echo "<p>Plik z linkami (links.txt) nie istnieje.</p>";
        // Tworzenie przykładowego pliku
        $exampleContent = "http://www.google.com;Wyszukiwarka Google\nhttp://www.wikipedia.org;Wikipedia";
        file_put_contents($linksFile, $exampleContent);
        echo "<p>Utworzono przykładowy plik links.txt. Odśwież stronę.</p>";
    }
    ?>
</ul>
</body>
</html>