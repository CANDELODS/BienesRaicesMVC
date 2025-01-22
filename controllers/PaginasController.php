<?php
namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController{

    public static function index(Router $router){
        $propiedades = Propiedad::get(2);
        $inicio = true;
        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio
        ]);
    }

    public static function nosotros(Router $router){
        $router->render('/paginas/nosotros');
    }

    public static function propiedades(Router $router){
        $propiedades = Propiedad::all();
        $router->render('/paginas/propiedades', [
            'propiedades' => $propiedades
        ]);
    }

    public static function propiedad(Router $router){
        $id = validarORedireccionar('/propiedades');
        //Buscar La Propiedad Con Su Id
        $propiedad = Propiedad::find($id);
        $router->render('/paginas/propiedad', [
            'propiedad' => $propiedad
        ]);
    }

    public static function blog(Router $router){
        $router->render('/paginas/blog');
    }

    public static function entrada(Router $router){
        $router->render('/paginas/entrada');
    }

    public static function contacto(Router $router){
        $mensaje = null;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $respuestas = $_POST['contacto'];

            //Crear Instancia De PHP Mailer
            $mail = new PHPMailer();
            //Configurar SMTP (Protocolo De Envio De Emails)
            $mail->isSMTP();
            $mail->Host = $_ENV['EMAIL_HOST'];
            $mail->SMTPAuth = true;
            $mail->Port = $_ENV['EMAIL_PORT'];
            $mail->Username = $_ENV['EMAIL_USER'];
            $mail->Password = $_ENV['EMAIL_PASS'];
            $mail->SMTPSecure = 'tls'; //Para Que Los Email Vayan Por Un Tunel Seguro (Transport Layer Security)
            //Configurar El Contenido Del Email
            $mail->setFrom('admin@bienesraices.com'); //Emisor Del Email
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com'); //Receptor Del Email
            $mail->Subject = 'Tienes Un Nuevo Mensaje'; //Mensaje
            //Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            //Definir El Contenido
            $contenido = '<html>';
            $contenido .= '<p>Tienes Un Nuevo Mensaje</p>';
            $contenido .= '<p>Nombre: ' . $respuestas['nombre'] . ' </p>';
            //Enviar De Forma Condicional Algunos Campos De Email O Telefono
            if($respuestas['contacto'] === 'telefono'){
                $contenido .= '<p> Eligio Ser Contactado Por Telefono </p>';
                $contenido .= '<p>Telefono: ' . $respuestas['telefono'] . ' </p>';
                $contenido .= '<p>Fecha De Contacto: ' . $respuestas['fecha'] . ' </p>';
                $contenido .= '<p>Hora: ' . $respuestas['hora'] . ' </p>';
            }else{
                //Agregamos El Campo Email
                $contenido .= '<p> Eligio Ser Contactado Por Email </p>';
                $contenido .= '<p>Email: ' . $respuestas['email'] . ' </p>';
            }

            $contenido .= '<p>Mensaje: ' . $respuestas['mensaje'] . ' </p>';
            $contenido .= '<p>Vende O Compra?: ' . $respuestas['tipo'] . ' </p>';
            $contenido .= '<p>Precio O Presupuesto: $' . $respuestas['precio'] . ' </p>';
            $contenido .= '</html>';
            $mail->Body = $contenido;
            $mail->AltBody = 'Esto Es Texto Alternativo Sin HTML'; //Contenido Cuando El Lector De Emails No Soporta HTML
            //Enviar El Email
           if($mail->send()){
                $mensaje = "Mensaje Enviado Correctamente";
           }else{
            $mensaje = "El Mensaje No Se Pudo Enviar";
           }
        }

        $router->render('/paginas/contacto', [
            'mensaje' => $mensaje
        ]);
    }

}