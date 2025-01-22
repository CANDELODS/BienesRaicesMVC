<main class="contenedor seccion contenido-centrado">
        <h1><?php echo $propiedad->titulo; ?></h1>
 
            <img class="imagen-anuncio" src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="Imagen De La Propiedad" loading="lazy">

        <div class="resumen-propiedad">
        <p class="precio"><?php echo number_format($propiedad->precio) . " COP"; ?></p>
            <ul class="iconos-caracteristicas">

                <li>
                    <img class="icono" src="build/img/icono_wc.svg" alt="Icono_Wc" loading="lazy">
                    <p><?php echo $propiedad->inodoros; ?></p>
                </li>

                <li>
                    <img class="icono" src="build/img/icono_estacionamiento.svg" alt="Icono_estacionamiento" loading="lazy">
                    <p><?php echo $propiedad->estacionamiento; ?></p>
                </li>

                <li>
                    <img class="icono" src="build/img/icono_dormitorio.svg" alt="Icono_dormitorios" loading="lazy">
                    <p><?php echo $propiedad->habitaciones; ?></p>
                </li>

            </ul>

            <?php echo $propiedad->descripcion; ?>
        </div>
    </main>