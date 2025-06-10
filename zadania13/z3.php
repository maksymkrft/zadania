<?php
trait A {
    public function smallTalk() { echo 'a'; }
    public function bigTalk() { echo 'A'; }
}

trait B {
    public function smallTalk() { echo 'b'; }
    public function bigTalk() { echo 'B'; }
}

class Talker {
    use A, B {
        B::smallTalk insteadof A;
        A::bigTalk insteadof B;
        B::bigTalk as bigTalkB;
        A::smallTalk as smallTalkA;
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head><meta charset="UTF-8"><title>Zadanie 13.3</title></head>
<body>
<h1>Test traitów</h1>
<?php
$talker = new Talker();
echo "smallTalk(): ";
$talker->smallTalk();
echo "<br>bigTalk(): ";
$talker->bigTalk();
echo "<br>smallTalkA(): ";
$talker->smallTalkA();
echo "<br>bigTalkB(): ";
$talker->bigTalkB();
?>
</body>
</html>