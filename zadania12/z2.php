<?php
$host = 'localhost';
$db   = 'cars_db';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$db`");
    $pdo->exec("USE `$db`");

    $pdo->exec("CREATE TABLE IF NOT EXISTS Person (
        Person_id INT AUTO_INCREMENT PRIMARY KEY,
        Person_firstname VARCHAR(255) NOT NULL,
        Person_secondname VARCHAR(255) NOT NULL
    ) ENGINE=InnoDB;");

    $pdo->exec("CREATE TABLE IF NOT EXISTS Cars (
        Cars_id INT AUTO_INCREMENT PRIMARY KEY,
        Cars_model VARCHAR(255) NOT NULL,
        Cars_price FLOAT NOT NULL,
        Cars_day_of_buy DATETIME NOT NULL,
        Person_id INT,
        FOREIGN KEY (Person_id) REFERENCES Person(Person_id) ON DELETE SET NULL
    ) ENGINE=InnoDB;");

} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_person'])) {
        $stmt = $pdo->prepare("INSERT INTO Person (Person_firstname, Person_secondname) VALUES (?, ?)");
        $stmt->execute([$_POST['firstname'], $_POST['lastname']]);
    }
    if (isset($_POST['add_car'])) {
        $stmt = $pdo->prepare("INSERT INTO Cars (Cars_model, Cars_price, Cars_day_of_buy, Person_id) VALUES (?, ?, ?, ?)");
        $stmt->execute([$_POST['model'], $_POST['price'], $_POST['day_of_buy'], $_POST['person_id']]);
    }
    if (isset($_POST['update_person'])) {
        $stmt = $pdo->prepare("UPDATE Person SET Person_firstname = ?, Person_secondname = ? WHERE Person_id = ?");
        $stmt->execute([$_POST['firstname'], $_POST['lastname'], $_POST['person_id']]);
    }
    if (isset($_POST['update_car'])) {
        $stmt = $pdo->prepare("UPDATE Cars SET Cars_model = ?, Cars_price = ?, Cars_day_of_buy = ?, Person_id = ? WHERE Cars_id = ?");
        $stmt->execute([$_POST['model'], $_POST['price'], $_POST['day_of_buy'], $_POST['person_id'], $_POST['car_id']]);
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

if (isset($_GET['delete_person'])) {
    $stmt = $pdo->prepare("DELETE FROM Person WHERE Person_id = ?");
    $stmt->execute([$_GET['delete_person']]);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
if (isset($_GET['delete_car'])) {
    $stmt = $pdo->prepare("DELETE FROM Cars WHERE Cars_id = ?");
    $stmt->execute([$_GET['delete_car']]);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

$persons = $pdo->query("SELECT * FROM Person")->fetchAll();
$cars = $pdo->query("SELECT Cars.*, Person.Person_firstname, Person.Person_secondname FROM Cars LEFT JOIN Person ON Cars.Person_id = Person.Person_id")->fetchAll();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Zadanie 12.2</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px; }
        .container { max-width: 1000px; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        form { margin-bottom: 20px; padding: 15px; border: 1px solid #ddd; border-radius: 5px; }
        input, select, button { padding: 8px; margin: 5px 0; width: calc(100% - 18px); }
        button { background-color: #28a745; color: white; border: none; cursor: pointer; }
        button.edit { background-color: #ffc107; }
        button.delete { background-color: #dc3545; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
    <script>
        function confirmDelete() {
            return confirm('Czy na pewno chcesz usunąć ten rekord?');
        }
    </script>
</head>
<body>
<div class="container">
    <h1>Zarządzanie bazą danych</h1>

    <?php if (isset($_GET['edit_person'])): $person_to_edit = $pdo->prepare("SELECT * FROM Person WHERE Person_id = ?"); $person_to_edit->execute([$_GET['edit_person']]); $person = $person_to_edit->fetch(); ?>
        <form method="post">
            <h2>Edytuj osobę</h2>
            <input type="hidden" name="person_id" value="<?= $person['Person_id'] ?>">
            Imię: <input type="text" name="firstname" value="<?= $person['Person_firstname'] ?>" required>
            Nazwisko: <input type="text" name="lastname" value="<?= $person['Person_secondname'] ?>" required>
            <button type="submit" name="update_person">Zaktualizuj osobę</button>
        </form>
    <?php else: ?>
        <form method="post">
            <h2>Dodaj osobę</h2>
            Imię: <input type="text" name="firstname" required>
            Nazwisko: <input type="text" name="lastname" required>
            <button type="submit" name="add_person">Dodaj osobę</button>
        </form>
    <?php endif; ?>

    <?php if (isset($_GET['edit_car'])): $car_to_edit = $pdo->prepare("SELECT * FROM Cars WHERE Cars_id = ?"); $car_to_edit->execute([$_GET['edit_car']]); $car = $car_to_edit->fetch(); ?>
        <form method="post">
            <h2>Edytuj samochód</h2>
            <input type="hidden" name="car_id" value="<?= $car['Cars_id'] ?>">
            Model: <input type="text" name="model" value="<?= $car['Cars_model'] ?>" required>
            Cena: <input type="number" step="0.01" name="price" value="<?= $car['Cars_price'] ?>" required>
            Data zakupu: <input type="datetime-local" name="day_of_buy" value="<?= date('Y-m-d\TH:i', strtotime($car['Cars_day_of_buy'])) ?>" required>
            Właściciel: <select name="person_id">
                <option value="">-- Brak --</option>
                <?php foreach($persons as $p): ?>
                    <option value="<?= $p['Person_id'] ?>" <?= $p['Person_id'] == $car['Person_id'] ? 'selected' : '' ?>><?= $p['Person_firstname'] . ' ' . $p['Person_secondname'] ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" name="update_car">Zaktualizuj samochód</button>
        </form>
    <?php else: ?>
        <form method="post">
            <h2>Dodaj samochód</h2>
            Model: <input type="text" name="model" required>
            Cena: <input type="number" step="0.01" name="price" required>
            Data zakupu: <input type="datetime-local" name="day_of_buy" required>
            Właściciel: <select name="person_id">
                <option value="">-- Brak --</option>
                <?php foreach($persons as $p): ?>
                    <option value="<?= $p['Person_id'] ?>"><?= $p['Person_firstname'] . ' ' . $p['Person_secondname'] ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" name="add_car">Dodaj samochód</button>
        </form>
    <?php endif; ?>

    <h2>Osoby</h2>
    <table>
        <tr><th>ID</th><th>Imię</th><th>Nazwisko</th><th>Akcja</th></tr>
        <?php foreach ($persons as $person): ?>
            <tr>
                <td><?= $person['Person_id'] ?></td>
                <td><?= $person['Person_firstname'] ?></td>
                <td><?= $person['Person_secondname'] ?></td>
                <td>
                    <a href="?edit_person=<?= $person['Person_id'] ?>"><button class="edit">Edytuj</button></a>
                    <a href="?delete_person=<?= $person['Person_id'] ?>" onclick="return confirmDelete()"><button class="delete">Usuń</button></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Samochody</h2>
    <table>
        <tr><th>ID</th><th>Model</th><th>Cena</th><th>Data zakupu</th><th>Właściciel</th><th>Akcja</th></tr>
        <?php foreach ($cars as $car): ?>
            <tr>
                <td><?= $car['Cars_id'] ?></td>
                <td><?= $car['Cars_model'] ?></td>
                <td><?= $car['Cars_price'] ?></td>
                <td><?= $car['Cars_day_of_buy'] ?></td>
                <td><?= $car['Person_firstname'] . ' ' . $car['Person_secondname'] ?></td>
                <td>
                    <a href="?edit_car=<?= $car['Cars_id'] ?>"><button class="edit">Edytuj</button></a>
                    <a href="?delete_car=<?= $car['Cars_id'] ?>" onclick="return confirmDelete()"><button class="delete">Usuń</button></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>
</html>