<?php
namespace Controllers;
use MVC\Router;
use Model\Vendedor;

class VendedorController{
    public static function crear(Router $router){
        $errores = Vendedor::getErrores();
        $vendedor = new Vendedor();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //Crear Nueva Instancia
            $vendedor = New Vendedor($_POST['vendedor']);
            
            //Validar Que No Haya Campos Vacios
            $errores = $vendedor->validar();
        
            //No Hay Errores
            if(empty($errores)){
                $vendedor->guardar();
            }
        }

        $router->render('/vendedores/crear', [
        'errores' => $errores,
        'vendedor' => $vendedor
        ]);
    }

    public static function actualizar(Router $router){
        $errores = Vendedor::getErrores();
        $id = validarORedireccionar('/admin');
        //Obtener Datos Del Vendedor A Actualizar
        $vendedor = Vendedor::find($id);

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //Asignar Los Valores
            $args = $_POST['vendedor'];
        
            //Sincronizar Objeto En Memoria Con Lo Que EL Usuario Escribió
            $vendedor->sincronizar($args);
        
            //Validación
            $errores = $vendedor->validar();
        
            if(empty($errores)){
                $vendedor->guardar();
            }
        }

       $router->render('/vendedores/actualizar', [
        'errores' => $errores,
        'vendedor' => $vendedor
       ]);
    }

    public static function eliminar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            //Validar ID
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if($id){
                //Valida El Tipo A Eliminar
                $tipo = $_POST['tipo'];
                if(validarTipoContenido($tipo)){
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar();
                }
            }
        }
    }
}