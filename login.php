<?php

$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];

$dsn = "mysql:host=localhost;dbname=burgers;charset=utf8";
$pdo = new PDO($dsn, 'root', '');
$prepare = $pdo->prepare('SELECT * FROM users where mail = :uslovie1');
//$name = $_REQUEST['mail'];
$prepare->execute(['uslovie1' => $email]);
if($prepare == undefined) {
    $query = "INSERT INTO uses (name, tel, mail) VALUES ('".$_POST['name']."','".$_POST['phone']."','".$_POST['email']."')";
    $result = mysqli_query($query) or die ("<p>ошибка запроса</p>");
} else {
    $data = $prepare->fetch(PDO::FETCH_OBJ);
    echo json_encode($data);
}
