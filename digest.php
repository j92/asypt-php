<?php

require_once __DIR__ . '/src/Md5Digester.php';

$password = $argv[1];
$salt = $argv[2];

$digester = new Md5Digester();
echo $digester->digest($salt, $password);

