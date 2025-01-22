<?php

namespace MVC;

class Router{

    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn){
        $this->rutasGET[$url] = $fn; 
    }

    public function post($url, $fn){
        $this->rutasPOST[$url] = $fn; 
    }

    public function comprobarRutas(){
        session_start();
        $auth = $_SESSION['login'] ?? null;
        //Arreglo De Ruta Protegidas
        $rutas_protegidas = ['/admin', '/propiedades/crear', '/propiedades/actualizar', '/propiedades/eliminar',
        '/vendedores/crear', '/vendedores/actualizar', '/vendedores/eliminar'];

        $urlActual = strtok($_SERVER['REQUEST_URI'], '?') ?? '/'; //Con Esto Filtro El Arreglo
        $metodo = $_SERVER['REQUEST_METHOD'];

        if($metodo === 'GET'){
            $fn = $this->rutasGET[$urlActual] ?? null;
        }else{
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }
        //Proteger Las Rutas
        if(in_array($urlActual, $rutas_protegidas) && !$auth){ //Nos Devuelve Un Bool Dependiendo Si Encuentra La Url Actual En El Arreglo De Rutas Protegidas
            header('Location: /');
        }

        if($fn){
            //La URL Existe Y Hay Una Función Asociada
            call_user_func($fn, $this); //Nos Permite Llamar Una Función Cuando No Sabemos Como Se Llama Esa Función
        }else{
            echo "PAGINA NO ENCONTRADA 404";
        }
    }

    //Muestra Una Vista
    public function render($view, $datos = [] ){

        //Este ForEach Genera Variables Con El Nombre De Los Keys Del Arreglo Asociativo
        foreach($datos as $key => $value){
            $$key = $value; //Utilzamos Variable De Variable ($$) Ya Que Vamos A Pasar Muchos Datos,
            //Por Lo Cual Asi Tengan Diferentes Nombres Este Siempre Estara En La Variable $key Y No Se Perdera Su Value
        }
        ob_start(); //Inicia Un Almacenamiento En Memoria O Sea (Justo Desde Aqui Vamos A Guardar Los Datos En Memoria)
        include __DIR__ . "/views/$view.php";
        //Toda La Vista Se Guardara En La Variable Contenido
        $contenido = ob_get_clean(); //Limpiamos O Liberamos Memoria

        include __DIR__ . "/views/layout.php";
    }
}