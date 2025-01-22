<?php
//Obtenemos la ruta de los templates y las funciones, además les damos un nombre para poder llamarlas
//ya sea en funciones.php o en cualquier archivo.
define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/');
function incluirTemplate(string $nombre, bool $inicio = false){ //Si $inicio no esta presente entonces sera false

    include TEMPLATES_URL . "/${nombre}.php";
    
};

function estaAutenticado(){
    session_start();
 //Si Es True Es Por Que Está Autenticado
    if(!$_SESSION['login']){
        header('Location: /index.php');
    }
}

function debuguear($variable){
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

//Escapar / Sanitizar El HTML
function s($html) : string{
    $s = htmlspecialchars($html);
    return $s;
}


//Validar Tipo De Contenido
function validarTipoContenido($tipo){
    $tipos = ['vendedor', 'propiedad'];
    //Con return in_array buscamos un string o valor dentro de un arreglo y retornarlo, tiene 2 parametros
    //El primero Es Lo Que Vamos A Buscar, El Segundo Es Donde Lo Va A Buscar
    return in_array($tipo, $tipos); 
}

//Muestra Los Mensajes
function mostrarNotificacion($codigo){
    $mensaje = '';

    switch($codigo){
        case 1: 
            $mensaje = 'Creado Correctamente';
            break;
        case 2:
            $mensaje = 'Actualizado Correctamente';
            break;
        case 3:
            $mensaje = 'Eliminado Correctamente';
            break;
        default:
            $mensaje = false;
            break;
    }

    return $mensaje;
}

function validarORedireccionar(string $url){
        //Validar Que El ID Sea Un Número
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
    
        if(!$id){ //Si No Es Un Número Entonces Redirecciona Al Usuario
            header("location: ${url}");
        }

        return $id;
}