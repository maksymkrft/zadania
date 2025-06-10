<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Strona Specjalna</title>
    <style>body { background-color: lightblue; }</style>
</head>
<body>
<h1>Witaj, użytkowniku specjalny!</h1>
<p>Twoje IP (<?php echo htmlspecialchars($_SERVER['REMOTE_ADDR']); ?>) znajduje się na liście specjalnej.</p>
</body>
</html>