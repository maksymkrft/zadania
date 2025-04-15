<?php
function is_pangram($text) {
    $text = strtolower($text);
    $alphabet = range('a', 'z');

    foreach ($alphabet as $letter) {
        if (strpos($text, $letter) === false) {
            echo "false\n";
            return;
        }
    }

    echo "true\n";
}

is_pangram("The quick brown fox jumps over the lazy dog.");
is_pangram("To nie jest pangram.");
?>
