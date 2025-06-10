<?php
interface Volume {
    public function increaseVolume();
    public function decreaseVolume();
}

interface Playable {
    public function play();
    public function stop();
}

class MusicPlayer implements Volume, Playable {
    private $volume = 5;
    private $isPlaying = false;

    public function increaseVolume() {
        if ($this->volume < 10) {
            $this->volume++;
        }
    }

    public function decreaseVolume() {
        if ($this->volume > 0) {
            $this->volume--;
        }
    }

    public function play() {
        $this->isPlaying = true;
    }

    public function stop() {
        $this->isPlaying = false;
    }

    public function getVolume(): int {
        return $this->volume;
    }

    public function getStatus(): string {
        return $this->isPlaying ? 'Playing' : 'Stopped';
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Zadanie 13.1</title>
</head>
<body>
<h1>Test odtwarzacza muzyki</h1>
<?php
$player = new MusicPlayer();
echo "Initial Status: " . $player->getStatus() . ", Volume: " . $player->getVolume() . "<br>";
$player->play();
$player->increaseVolume();
$player->increaseVolume();
echo "After Play and Volume Up: " . $player->getStatus() . ", Volume: " . $player->getVolume() . "<br>";
$player->stop();
$player->decreaseVolume();
echo "After Stop and Volume Down: " . $player->getStatus() . ", Volume: " . $player->getVolume() . "<br>";
?>
</body>
</html>