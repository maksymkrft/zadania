<?php
interface Animal {
    public function makeSound(): string;
    public function eat(): string;
}

class Dog implements Animal {
    public function makeSound(): string {
        return "Woof!";
    }

    public function eat(): string {
        return "The dog is eating.";
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head><meta charset="UTF-8"><title>Zadanie 13.5</title></head>
<body>
<h1>Test interfejsu Animal</h1>
<?php
$dog = new Dog();
echo "Dog says: " . $dog->makeSound() . "<br>";
echo "Dog does: " . $dog->eat() . "<br>";
?>
</body>
</html>