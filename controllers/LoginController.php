<?php

namespace Controllers;
use MVC\Router;
use Model\Admin;

class  LoginController{
    public static function login(Router $router){
        $errores = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new Admin($_POST); //Crea Una Nueva Instancia Con Lo Que Hay En Post
            $errores = $auth->validar();
            if(empty($errores)){
                //Verificar Si El Usuario Existe
                $resultado = $auth->existeUsuario();
                if(!$resultado){
                    //Verifica Si El Usuario Existe O No (Mensaje De Error)
                    $errores = Admin::getErrores();
                }else{
                    //Verificar El Password
                    $autenticado = $auth->comprobarPassword($resultado);
                    if($autenticado){
                     //Autenticar Al Usuario
                    $auth->autenticar();
                    }else{
                    //Password Incorrecto (Mensaje De Error)
                    $errores = Admin::getErrores();
                    }
                }

            }
        }
        $router->render('autenticacion/login', [
            'errores' => $errores
        ]);
    }

    public static function logout(){
        session_start();
        $_SESSION = [];
        header('Location: /');
        
    }
}