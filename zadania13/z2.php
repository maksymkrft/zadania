<?php
interface Employee {
    public function getSalary(): float;
    public function setSalary(float $salary): void;
    public function getRole(): string;
}

class Manager implements Employee {
    private $salary;
    private $employees = [];

    public function getSalary(): float { return $this->salary; }
    public function setSalary(float $salary): void { $this->salary = $salary; }
    public function getRole(): string { return get_class($this); }
    public function addEmployee(Employee $employee) { $this->employees[] = $employee; }
    public function getEmployees(): array { return $this->employees; }
}

class Developer implements Employee {
    private $salary;
    private $programmingLanguage;

    public function getSalary(): float { return $this->salary; }
    public function setSalary(float $salary): void { $this->salary = $salary; }
    public function getRole(): string { return get_class($this); }
    public function setProgrammingLanguage(string $lang) { $this->programmingLanguage = $lang; }
    public function getProgrammingLanguage(): string { return $this->programmingLanguage; }
}

class Designer implements Employee {
    private $salary;
    private $designingTool;

    public function getSalary(): float { return $this->salary; }
    public function setSalary(float $salary): void { $this->salary = $salary; }
    public function getRole(): string { return get_class($this); }
    public function setDesigningTool(string $tool) { $this->designingTool = $tool; }
    public function getDesigningTool(): string { return $this->designingTool; }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head><meta charset="UTF-8"><title>Zadanie 13.2</title></head>
<body>
<h1>System pracowników</h1>
<?php
$dev = new Developer();
$dev->setSalary(10000);
$dev->setProgrammingLanguage("PHP");

$designer = new Designer();
$designer->setSalary(8000);
$designer->setDesigningTool("Figma");

$manager = new Manager();
$manager->setSalary(15000);
$manager->addEmployee($dev);
$manager->addEmployee($designer);

echo "Manager's Role: " . $manager->getRole() . ", Salary: " . $manager->getSalary() . "<br>";
echo "Manager's Subordinates: <br>";
echo "<ul>";
foreach ($manager->getEmployees() as $employee) {
    echo "<li>Role: " . $employee->getRole() . ", Salary: " . $employee->getSalary();
    if ($employee instanceof Developer) {
        echo ", Language: " . $employee->getProgrammingLanguage();
    }
    if ($employee instanceof Designer) {
        echo ", Tool: " . $employee->getDesigningTool();
    }
    echo "</li>";
}
echo "</ul>";
?>
</body>
</html>