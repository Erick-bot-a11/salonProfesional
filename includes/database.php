<?php

//$db = mysqli_connect('192.168.1.177', 'root2', 'Calamar2#', 'appsalon');//Asi hago una conexion a otra lap
$db = mysqli_connect(
    $_ENV['DB_HOST'], 
    $_ENV['DB_USER'],
    $_ENV['DB_PASS'] ?? "",
    $_ENV['DB_BD']);


if (!$db) {
    echo "Error: No se pudo conectar a MySQL.";
    echo "errno de depuración: " . mysqli_connect_errno();
    echo "error de depuración: " . mysqli_connect_error();
    exit;
}
