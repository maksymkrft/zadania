<?php
class Product {
    private $name;
    private $price;
    private $quantity;

    public function __construct(string $name, float $price, int $quantity) {
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
    }

    public function getName(): string { return $this->name; }
    public function getPrice(): float { return $this->price; }
    public function getQuantity(): int { return $this->quantity; }

    public function setName(string $name): void { $this->name = $name; }
    public function setPrice(float $price): void { $this->price = $price; }
    public function setQuantity(int $quantity): void { $this->quantity = $quantity; }

    public function __toString(): string {
        return "Product: " . $this->name . ", Price: " . $this->price . ", Quantity: " . $this->quantity;
    }
}

class Cart {
    private $products;

    public function __construct() {
        $this->products = [];
    }

    public function addProduct(Product $product): void {
        $this->products[] = $product;
    }

    public function removeProduct(Product $productToRemove): void {
        foreach ($this->products as $key => $product) {
            if ($product->getName() === $productToRemove->getName()) {
                unset($this->products[$key]);
                $this->products = array_values($this->products);
                return;
            }
        }
    }

    public function getTotal(): float {
        $total = 0;
        foreach ($this->products as $product) {
            $total += $product->getPrice() * $product->getQuantity();
        }
        return $total;
    }

    public function __toString(): string {
        if (empty($this->products)) {
            return "Koszyk jest pusty.";
        }

        $output = "Products in cart:<br>";
        foreach ($this->products as $product) {
            $output .= $product . "<br>";
        }
        $output .= "<b>Total price: " . $this->getTotal() . "</b>";
        return $output;
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Zadanie 11.2</title>
    <style>body { font-family: sans-serif; line-height: 1.6; } .cart { border: 1px solid #ccc; padding: 10px; margin-top: 20px;} </style>
</head>
<body>
<h1>Sklep internetowy</h1>
<?php
$product1 = new Product("Laptop", 3500, 1);
$product2 = new Product("Mysz", 150, 2);
$product3 = new Product("Klawiatura", 300, 1);

$cart = new Cart();
$cart->addProduct($product1);
$cart->addProduct($product2);
$cart->addProduct($product3);

echo "<div class='cart'><h2>Zawartość koszyka:</h2>" . $cart . "</div>";

$cart->removeProduct($product2);

echo "<div class='cart'><h2>Zawartość koszyka po usunięciu myszy:</h2>" . $cart . "</div>";
?>
</body>
</html>