<?php
$cookie_name = "visit_counter";
$limit = 10;
$visits = 1;

if(isset($_POST['reset'])) {
    setcookie($cookie_name, "", time() - 3600);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

if(isset($_COOKIE[$cookie_name])) {
    $visits = $_COOKIE[$cookie_name] + 1;
}

setcookie($cookie_name, $visits, time() + (86400 * 30));
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Zadanie 10.1</title>
</head>
<body>
<h1>Licznik odwiedzin (Cookies)</h1>
<p>Liczba odwiedzin: <strong><?php echo $visits; ?></strong></p>
<?php
if ($visits >= $limit) {
    echo "<p><strong>Gratulacje! Osiągnąłeś limit " . $limit . " odwiedzin!</strong></p>";
}
?>
<form action="" method="post">
    <button type="submit" name="reset">Resetuj licznik</button>
</form>
</body>
</html>