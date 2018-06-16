<?php

// подключаем настройки базы данных
$config = include (__DIR__ . DIRECTORY_SEPARATOR . 'config.php');

//
$pdoConfig = (object)$config["db"];

$dsn = "mysql:host=$pdoConfig->host;dbname=$pdoConfig->dbname;charset=utf8";
$pdo = new PDO($dsn, $pdoConfig->username, $pdoConfig->password);
