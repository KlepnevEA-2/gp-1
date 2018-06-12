<?php

require_once './login.php';
$connection = new mysqli($db_hostname, $db_username, $db_password, $db_database);
if ($connection>connect_error) die($connection->connect_error);
$query = "SELECT * FROM users"; $result = $connection>query($query);
if(!$result) die($connection>error);
for($i = 0, $length = $result>num_rows; $i < $length;
    $i++){ $result>data_seek($i);
    $row = $result>fetch_assoc();
    echo $row['name'].'<br />';
} $result>close();