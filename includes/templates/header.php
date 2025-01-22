<?php
//Arrancamos la sesión para poder ingresar a la superglobal session
if(!isset($_SESSION)){ //Si no existe o no está definida
    session_start();
} 

$autenticacion = $_SESSION['login'] ?? false; //Si el usuario no está autenticado le damos el valor false
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="/build/css/app.css">
</head>
<body>

    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">

        <div class="contenedor contenido-header">

            <div class="barra">
                <a href="/index.php">
                <img src="/build/img/logo.svg" alt="Logotipo Bienes Raices">
                </a>

                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="Icono Menú Responsive">
                </div>


                <div class="derecha">
                    <img class="dark-mode-boton" src="/build/img/dark-mode.svg">
                    <nav class="navegacion">
                        <a href="/nosotros.php">Nosotros</a>
                        <a href="/anuncios.php">Anuncios</a>
                        <a href="/blog.php">Blog</a>
                        <a href="/contacto.php">Contacto</a>
                        <?php if($autenticacion): ?> <!--Si autenticacion es true entonces-->
                                <a href="/cerrar-sesion.php">Cerrar Sesión</a>
                        <?php endif ?>
                    </nav>
                </div>

            </div> <!--.Barra-->

            <?php if($inicio) { ?>
            <h1>Venta De Casas Y Departamentos Exclusivos De Lujo</h1>
            <?php } ?>
        </div> <!--.contenedor .contenido .header-->

    </header>