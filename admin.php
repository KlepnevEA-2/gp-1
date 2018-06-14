<?php

$dsn = "mysql:host=localhost;dbname=burgers2;charset=utf8";
$pdo = new PDO($dsn, 'root', '');
//$prepare = $pdo->prepare('SELECT * FROM users2');
//$prepare->execute();
//$data = $prepare->fetch(PDO::FETCH_ASSOC);


$stmt = $pdo->query("SELECT * FROM users2");
$results = $stmt->fetch(PDO::FETCH_ASSOC);

$info = "<h2>Данные о клиентах:</h2><br>";

$info = $info."<table><tr><td>id</td><td>Почта</td><td>Имя</td><td>Телефон</td><td>Заказы</td></tr>";


do {
    $info = $info."<tr><td>".$results['id']."</td><td>".$results['email']."</td><td>".$results['name']."</td><td>".$results['tel']."</td><td>".$results['count']."</td></tr>";
}while($results = $stmt->fetch(PDO::FETCH_ASSOC));

$info = $info."</table>";
echo $info;

echo '<hr>';

$stmt = $pdo->query("SELECT * FROM orders2");
$results = $stmt->fetch(PDO::FETCH_ASSOC);

$info = "<h2>Данные о заказах:</h2><br>";

$info = $info."<table><tr><td>id</td><td>улица</td><td>дом</td><td>корпус</td><td>квартира</td><td>этаж</td><td>комментарий</td></tr>";


do {
    $info = $info."<tr><td>".$results['id']."</td><td>".$results['street']."</td><td>".$results['home']."</td><td>".$results['part']."</td><td>".$results['appt']."</td><td>".$results['floor']."</td><td>".$results['comment']."</td></tr>";
}while($results = $stmt->fetch(PDO::FETCH_ASSOC));

$info = $info."</table>";
echo $info;
