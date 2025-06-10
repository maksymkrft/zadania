<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Strona Domyślna</title>
    <style>body { background-color: lightgreen; }</style>
</head>
<body>
<h1>Witaj na stronie domyślnej!</h1>
<p>Twoje IP to <?php echo htmlspecialchars($_SERVER['REMOTE_ADDR']); ?>.</p>
</body>
</html>