<?php
//En Este Archivo Se Llamaran Todas Las Funciones Y Clases
//Lo Usaremos Para Mandar A Llamar Estas Funciones Y Clases
use Model\ActiveRecord;
require __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

require 'funciones.php';
require 'config/database.php';
//Conexion Con La Base De Datos
$db = conectarDB();

//No Requiere Instancia Por Que Es Estático Por Lo Cual Las Credencial Se Mantendran.
ActiveRecord::setDB($db);