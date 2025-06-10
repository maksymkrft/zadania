<?php
$specialIpsFile = 'special_ips.txt';
$userIp = $_SERVER['REMOTE_ADDR'];
$isSpecialIp = false;

if (file_exists($specialIpsFile)) {
    $specialIps = file($specialIpsFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if (in_array($userIp, $specialIps)) {
        $isSpecialIp = true;
    }
} else {
    // Utworzenie przykładowego pliku. Zastąp '::1' i '127.0.0.1' swoimi adresami IP.
    file_put_contents($specialIpsFile, "::1\n127.0.0.1");
}

if ($isSpecialIp) {
    require 'special_page.php';
} else {
    require 'default_page.php';
}
?>