<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController{
    public static function index(Router $router){ //Obtenemos La Referencia (Instancia) Que Viene Del Router
        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();
        //Muestra Mensaje Condicional
        $resultado = $_GET['resultado'] ?? null; //Si el valor 'resultado' no existe le asigna null

        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'resultado' => $resultado,
            'vendedores' => $vendedores
        ]);
    }

    public static function crear(Router $router){
        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();
        //Arreglos con mensajes de error
        $errores = Propiedad::getErrores();

        //Metodo POST Para Crear
        if($_SERVER['REQUEST_METHOD'] === 'POST'){ //Nos detalla la información de tipo POST pedida en nuestro formulario
            /**CREAR NUEVA INSTANCIA */
            $propiedad = new Propiedad($_POST['propiedad']); //Cuando Se Envia El Formulario Se Obtiene los Datos Y Se Guardan En El Objeto
            /**SUBIDA DE ARCHIVOS */
        
            //Generar nombre único a cada imágen
            $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg"; //md5 toma una entrada y la convierte
                                                                //Con el resto de funciones lo volvemos más único
            /**SETEAR IMAGEN */
                //Realizar resize a la imagen con Intervention
                //Fit mezcla un resize y un cut para la imagen (800 = Ancho, 600 = Largo)
                if($_FILES['propiedad']['tmp_name']['imagen']){
                    $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                    $propiedad->setImagen($nombreImagen);
                }
        
            //Validar
            $errores = $propiedad->validar();
        
            //Revisar Que El Arreglo De errores Esté Vacio
            if(empty($errores)){
        
            //Crear Carpeta Imagenes
            $carpetaImagenes = '../../imagenes/';
            if(!is_dir(CARPETA_IMAGENES)){ //El is_dir nos retorna si una carpera existe o no existe
                mkdir(CARPETA_IMAGENES); //Creamos un directorio
            } 
        
            //Guardar La Imagen En El Servidor, Save() Nos Permite Guardar En El Servidor
            $image->save(CARPETA_IMAGENES . $nombreImagen); 
        
            //Guardar En La Base De Datos
            $propiedad->guardar();
            }
        
            }
        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router){
        $id = validarORedireccionar('/admin');
        $propiedad = Propiedad::find($id);
        $errores = Propiedad::getErrores();
        $vendedores = Vendedor::all();

        //Metodo POST Para Actualizar
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //Asignar Los Atributos
            $args = $_POST['propiedad'];
        
            $propiedad->sincronizar($args);
            //Validacion
            $errores = $propiedad->validar();
        
            //SUBIDA DE ARCHIVOS
            $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";
            if($_FILES['propiedad']['tmp_name']['imagen']){
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                $propiedad->setImagen($nombreImagen);
            }
        
            //Revisar Que El Arreglo De errores Esté Vacio
            if(empty($errores)){
                if($_FILES['propiedad']['tmp_name']['imagen']){
                //Guardar Imagen
                $image->save(CARPETA_IMAGENES . $nombreImagen);
                }
                //Actualizar En La Base De Datos
                $propiedad->guardar();
            }
            }


        $router->render('/propiedades/actualizar', [
            'propiedad' => $propiedad,
            'errores' => $errores,
            'vendedores' => $vendedores
        ]);

    }
    
    public static function eliminar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){ 
            //La Variable Id Solo Se Creara Cuando Se Le De Eliminar,                
            //Asi Evitamos Error De Que Salga Undefined
    
            //Validamos ID
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT); //Verificamos Que Sea Un Entero
    
            //Si Tenemos Un Id (Se trae del botón eliminar) Entonces
            if($id){ 
    
                $tipo = $_POST['tipo'];
                if(validarTipoContenido($tipo)){
                    //Comparamos Lo Que Vamos A Eliminar
                    if($tipo === 'vendedor'){
                        //Consulta Para Obtener Los Datos De Los Vendedores
                        $vendedores = Vendedor::find($id);
                        $vendedores->eliminar();
                    }elseif ($tipo === 'propiedad'){
                        //Consulta Para Obtener Los Datos De Las Propiedades
                        $propiedad = Propiedad::find($id);
                        $propiedad->eliminar();
                    }
                }
            }
        }
    }
}