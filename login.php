<?php

$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];

$dsn = "mysql:host=localhost;dbname=burgers;charset=utf8";
$pdo = new PDO($dsn, 'root', '');
$prepare = $pdo->prepare('SELECT * FROM users where mail = :uslovie1');
$prepare->execute(['uslovie1' => $email]);;
$data = $prepare->fetch(PDO::FETCH_OBJ);

if ($data) {
    echo json_encode($data);
} else {
    $users = $pdo->prepare("INSERT INTO users (name, mail, tel) VALUES (:name, :mail, :phone)");
    $users->execute(['name' => $name, 'mail' => $email, 'phone' => $phone]);
}
