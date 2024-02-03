<?php

$host = 'localhost';
$username = 'root';
$password = '';
$db = 'trackingsystem';

$connection = mysqli_connect($host, $username, $password, $db);

if (!$connection) {
    die('Connect Failed' . mysqli_connect_error());
} else {
    //echo 'connected';
}
