<?php
trait Speed {
    public $speed = 0;

    public function increaseSpeed(int $value) {
        $this->speed += $value;
    }

    public function decreaseSpeed(int $value) {
        $this->speed -= $value;
        if ($this->speed < 0) {
            $this->speed = 0;
        }
    }
}

class Car {
    use Speed;

    public function start() {
        $this->speed = 0;
        $this->increaseSpeed(10);
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head><meta charset="UTF-8"><title>Zadanie 13.4</title></head>
<body>
<h1>Test trait Speed</h1>
<?php
$car = new Car();
echo "Initial speed: " . $car->speed . " km/h<br>";
$car->start();
echo "Speed after start(): " . $car->speed . " km/h<br>";
$car->increaseSpeed(50);
echo "Speed after increaseSpeed(50): " . $car->speed . " km/h<br>";
$car->decreaseSpeed(20);
echo "Speed after decreaseSpeed(20): " . $car->speed . " km/h<br>";
?>
</body>
</html>