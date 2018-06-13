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
    $countOrder = $pdo->prepare('SELECT * FROM users2 WHERE id = :id');
    $countOrder->execute(['id' => $data['id']]);
    $dataCount = $countOrder->fetch(PDO::FETCH_ASSOC);
    $count = $dataCount['count'] + 1;

    $countVal = $pdo->prepare("UPDATE users2 set count = :count where id=:id");
    $countVal->bindParam(':id', $data['id']);
    $countVal->bindParam(':count', $count);
    $countVal->execute();

    echo json_encode($data);
} else {
    $users = $pdo->prepare("INSERT INTO users2 (name, email, tel, count) VALUES (:name, :mail, :phone, :count)");
    $users->execute(['name' => $name, 'mail' => $email, 'phone' => $phone, 'count' => 1]);
    echo json_encode('Клиент зарегестрирован');
}

$orders = $pdo->prepare("INSERT INTO orders2 (street, home, part, appt, floor, comment) VALUES (:street, :home, :part, :appt, :floor, :comment)");
$orders->execute(['street' => $street, 'home' => $home, 'part' => $part, 'appt' => $appt, 'floor' => $floor, 'comment' => $comment]);
$insertId=$pdo->lastInsertId();

$prepareOrder = $pdo->prepare('SELECT * FROM orders2 where id = :id');
$prepareOrder->execute(['id' => $insertId]);
$dataOrder = $prepareOrder->fetch(PDO::FETCH_ASSOC);

if($dataCount['count'] < 1) {
    $text = "Спасибо - это ваш первый заказ";
} else {
    $text = 'Спасибо! Это уже ' . $count . ' заказ';
}

$mail_message = '
    <html>
    <head>
        <title>Заказ № '.$dataOrder['id'].'</title>
    </head>
        <h1>Заказ №'.$dataOrder['id'].'</h1>
        <p>Ваш заказ будет доставлен по адресу: ' .$dataOrder['street']. ', дом ' . $dataOrder['home'] . ', корпус '. $dataOrder['part'] .', квартира ' . $dataOrder['appt'] . ', этаж ' . $dataOrder['floor'] . '  </p>
        <p>Коментарий: ' .$dataOrder['comment']. '</p>
        <p>Заказ: DarkBeefBurger за 500 рублей, 1 шт</p>
        <p>'. $text .'</p>
    </html>';

$headers = "From: Администратор сайта <klepnev-ea@yandex.ru>\r\n".
    "MIME-Version: 1.0" . "\r\n" .
    "Content-type: text/html; charset=UTF-8" . "\r\n";

$mail = mail('klepnev-ea@yandex.ru', 'Заказ', $mail_message, $headers);