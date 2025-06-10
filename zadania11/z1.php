<?php
class NoweAuto {
    protected $model;
    protected $cenaEuro;
    protected $kursEuroPLN;

    public function __construct(string $model, float $cenaEuro, float $kursEuroPLN) {
        $this->model = $model;
        $this->cenaEuro = $cenaEuro;
        $this->kursEuroPLN = $kursEuroPLN;
    }

    public function ObliczCene(): float {
        return $this->cenaEuro * $this->kursEuroPLN;
    }

    public function getInfo() {
        return "Model: $this->model, Cena w PLN: " . $this->ObliczCene();
    }
}

class AutoZDodatkami extends NoweAuto {
    private $alarm;
    private $radio;
    private $klimatyzacja;

    public function __construct(string $model, float $cenaEuro, float $kursEuroPLN, float $alarm, float $radio, float $klimatyzacja) {
        parent::__construct($model, $cenaEuro, $kursEuroPLN);
        $this->alarm = $alarm;
        $this->radio = $radio;
        $this->klimatyzacja = $klimatyzacja;
    }

    public function ObliczCene(): float {
        $cenaBazowaPLN = parent::ObliczCene();
        $cenaDodatkow = $this->alarm + $this->radio + $this->klimatyzacja;
        return $cenaBazowaPLN + $cenaDodatkow;
    }
}

class Ubezpieczenie extends AutoZDodatkami {
    private $procentUbezpieczenia;
    private $lataPosiadania;

    public function __construct(string $model, float $cenaEuro, float $kursEuroPLN, float $alarm, float $radio, float $klimatyzacja, float $procentUbezpieczenia, int $lataPosiadania) {
        parent::__construct($model, $cenaEuro, $kursEuroPLN, $alarm, $radio, $klimatyzacja);
        $this->procentUbezpieczenia = $procentUbezpieczenia;
        $this->lataPosiadania = $lataPosiadania;
    }

    public function ObliczCene(): float {
        $wartoscSamochoduZDodatkami = parent::ObliczCene();
        $znizka = (100 - $this->lataPosiadania) / 100;
        return ($this->procentUbezpieczenia / 100) * ($wartoscSamochoduZDodatkami * $znizka);
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Zadanie 11.1</title>
    <style>body { font-family: sans-serif; line-height: 1.6; }</style>
</head>
<body>
<h1>System sprzedaży aut</h1>
<?php
$auto = new NoweAuto("Fiat Panda", 10000, 4.30);
echo "<b>Nowe Auto:</b><br>" . $auto->getInfo() . "<br><br>";

$autoDodatki = new AutoZDodatkami("Toyota Corolla", 20000, 4.30, 500, 300, 1200);
echo "<b>Auto z dodatkami:</b><br>Cena całkowita w PLN: " . $autoDodatki->ObliczCene() . "<br><br>";

$ubezpieczenie = new Ubezpieczenie("Audi A4", 30000, 4.30, 1000, 500, 2000, 5, 3);
echo "<b>Ubezpieczenie auta:</b><br>Koszt ubezpieczenia w PLN: " . $ubezpieczenie->ObliczCene() . "<br><br>";
?>
</body>
</html>