<?php

$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];

$dsn = "mysql:host=localhost;dbname=burgers;charset=utf8";
$pdo = new PDO($dsn, 'root', '');
$prepare = $pdo->prepare('SELECT * FROM users where mail = :uslovie1');
//$name = $_REQUEST['mail'];
$prepare->execute(['uslovie1' => $email]);
if(!$prepare) {

    $stmt = $pdo->prepare("INSERT INTO users (name, email, tel) VALUES (:name, :email, :phone)");
    $stmt->execute(['name' => $name, 'mail' => $mail, 'tel' => $phone]);
} else {
    $data = $prepare->fetch(PDO::FETCH_OBJ);
    echo json_encode($data);
}


//$mysqli = new mysqli("localhost", "root", "", "users");
//if (mysqli_connect_errno()) {
//    printf("Ошибка соединения: %s\n", mysqli_connect_error());
//    exit();
//}
////$name = 'user'.rand(0, 1000);
////$email = $name.'@mail.ru';
////1. Ничего не возвращает.
//$sql = "INSERT INTO users (name, email, tel) VALUES ('$name', '$email', '$phone')";
//$result = $mysqli->query($sql);
////2. Запрос который что-то возвращает.
//$sql = "select * from users LIMIT 3";
//$result = $mysqli->query($sql);
//if ($result->num_rows) {
//    $data=$result->fetch_all();
//    echo "<pre>";
//    print_r($data);
//    die();
//} else {
//    echo "Был запрос без данных";
//}
//echo json_encode($result);