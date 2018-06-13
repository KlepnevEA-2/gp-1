<?php

$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];

$street = $_POST['street'];
$home = $_POST['home'];
$part = $_POST['part'];
$appt = $_POST['appt'];
$floor = $_POST['floor'];
$comment = $_POST['comment'];


$dsn = "mysql:host=localhost;dbname=burgers2;charset=utf8";
$pdo = new PDO($dsn, 'root', '');
$prepare = $pdo->prepare('SELECT * FROM users2 where email = :uslovie1');
$prepare->execute(['uslovie1' => $email]);
$data = $prepare->fetch(PDO::FETCH_ASSOC);

if ($data) {
    $usersCount = $pdo->prepare("INSERT INTO users2 where email = $email (count) VALUES (:count)");
    $usersCount->execute(['count' => $count]);
    echo json_encode($data);
} else {
    $users = $pdo->prepare("INSERT INTO users2 (name, email, tel, count) VALUES (:name, :mail, :phone)");
    $users->execute(['name' => $name, 'mail' => $email, 'phone' => $phone]);
    echo json_encode('Клиент зарегестрирован');
}


$orders = $pdo->prepare("INSERT INTO orders2 (street, home, part, appt, floor, comment) VALUES (:street, :home, :part, :appt, :floor, :comment)");
$orders->execute(['street' => $street, 'home' => $home, 'part' => $part, 'appt' => $appt, 'floor' => $floor, 'comment' => $comment]);


$prepareOrder = $pdo->prepare('SELECT * FROM orders2');
$prepareOrder->execute(['uslovie1' => $street]);
$dataOrder = $prepareOrder->fetch(PDO::FETCH_OBJ);


$mail_message = '
    <html>
    <head>
        <title>Заказ №</title>
    </head>
        <h1>Заказ №</h1>
        <p>“Ваш заказ будет доставлен по адресу: ' . $street . ', дом ' . $home . ', корпус '. $part .', квартира ' . $appt . ', этаж ' . $floor . '  </p>
        <p>Заказ: DarkBeefBurger за 500 рублей, 1 шт</p>
        <p>Спасибо! Это уже 555 заказ</p>
    </html>';

$headers = "From: Администратор сайта <klepnev-ea@yandex.ru>\r\n".
    "MIME-Version: 1.0" . "\r\n" .
    "Content-type: text/html; charset=UTF-8" . "\r\n";

$mail = mail('klepnev-ea@yandex.ru', 'Заказ', $mail_message, $headers);