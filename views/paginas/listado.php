<div class="contenedor-anuncios">

    <?php foreach($propiedades as $propiedad) { ?>
<div class="anuncio">

        <img src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="Anuncio" loading="lazy">


    <div class="contenido-anuncio">
        <h3><?php echo $propiedad->titulo; ?></h3>
        <p><?php echo $propiedad->descripcion; ?></p>
        <p class="precio"><?php echo number_format($propiedad->precio) . " COP"; ?></p>

        <ul class="iconos-caracteristicas">

            <li>
                <img class="icono" src="/build/img/icono_wc.svg" alt="Icono_Wc" loading="lazy">
                <p><?php echo $propiedad->inodoros; ?></p>
            </li>

            <li>
                <img class="icono" src="/build/img/icono_estacionamiento.svg" alt="Icono_estacionamiento" loading="lazy">
                <p><?php echo $propiedad->estacionamiento; ?></p>
            </li>

            <li>
                <img class="icono" src="/build/img/icono_dormitorio.svg" alt="Icono_dormitorios" loading="lazy">
                <p><?php echo $propiedad->habitaciones; ?></p>
            </li>

        </ul>

        <a href="/propiedad?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Ver Propiedad</a>

    </div> <!--.contenido-anuncio-->
</div> <!--.anuncios-->
<?php } ?>
</div> <!--.contenedor-anuncios-->