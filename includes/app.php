<?php



require __DIR__ . '/../vendor/autoload.php';
$dotenv= Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad(); //Si el archivo no existe, nomarca error y sigue la ejecusion
require 'funciones.php';
require 'database.php';


// Conectarnos a la base de datos
use Model\ActiveRecord;
ActiveRecord::setDB($db);