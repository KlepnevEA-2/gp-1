<?php

require "pdo.php";

$name = (isset($_POST['name'])) ? trim($_POST['name']) : null;
$phone = (isset($_POST['phone'])) ? trim($_POST['phone']) : null;
$email = (isset($_POST['email'])) ? trim($_POST['email']) : null;
$street = (isset($_POST['street'])) ? trim($_POST['street']) : null;
$part = (isset($_POST['part'])) ? trim($_POST['part']) : null;
$home = (isset($_POST['home'])) ? trim($_POST['home']) : null;
$appt = (isset($_POST['appt'])) ? trim($_POST['appt']) : null;
$floor = (isset($_POST['floor'])) ? trim($_POST['floor']) : null;
$comment = (isset($_POST['comment'])) ? trim($_POST['comment']) : null;


$dsn = "mysql:host=$pdoConfig->host;dbname=$pdoConfig->dbname;charset=utf8";
$pdo = new PDO($dsn, $pdoConfig->username, $pdoConfig->password);
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
    echo json_encode($pdoConfig->username);
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