<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Zadanie 9.1</title>
</head>
<body>
<form action="" method="get">
    <label for="birthdate">Wybierz datę urodzenia:</label>
    <input type="date" id="birthdate" name="birthdate">
    <button type="submit">Sprawdź</button>
</form>
<hr>
<?php
function getBirthDayOfWeek(string $date): string {
    $dayOfWeek = date('l', strtotime($date));
    $polishDays = [
        'Monday' => 'Poniedziałek', 'Tuesday' => 'Wtorek', 'Wednesday' => 'Środa',
        'Thursday' => 'Czwartek', 'Friday' => 'Piątek', 'Saturday' => 'Sobota', 'Sunday' => 'Niedziela'
    ];
    return $polishDays[$dayOfWeek];
}

function getCompletedYears(string $date): int {
    $birthDate = new DateTime($date);
    $today = new DateTime('today');
    return $birthDate->diff($today)->y;
}

function getDaysToNextBirthday(string $date): int {
    $birthDate = new DateTime($date);
    $today = new DateTime('today');
    $nextBirthday = new DateTime(date('Y') . '-' . $birthDate->format('m-d'));
    if ($nextBirthday < $today) {
        $nextBirthday->modify('+1 year');
    }
    return $today->diff($nextBirthday)->days;
}

if (isset($_GET['birthdate']) && !empty($_GET['birthdate'])) {
    $birthdate = $_GET['birthdate'];
    echo "Data urodzenia: " . htmlspecialchars($birthdate) . "<br>";
    echo "Dzień tygodnia urodzenia: " . getBirthDayOfWeek($birthdate) . "<br>";
    echo "Ukończone lata: " . getCompletedYears($birthdate) . "<br>";
    echo "Dni do najbliższych urodzin: " . getDaysToNextBirthday($birthdate) . "<br>";
}
?>
</body>
</html>