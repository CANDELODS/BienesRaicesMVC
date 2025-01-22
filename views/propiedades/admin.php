<main class="contenedor seccion">
        <h1>Administrador De Bienes Raices</h1>

        <?php
            if($resultado){
                            //Como El Resultado Lo Traemos De Una URL Debemos Convertirlo A Entero
            $mensaje = mostrarNotificacion( intval($resultado) );

            if($mensaje) { ?>
            <p class="alerta exito"> <?php echo s($mensaje) ?> </p>
            <?php } ?>
        <?php } ?>

        <a href="/propiedades/crear" class="boton boton-verde">Nueva Propiedad</a>
        <a href="/vendedores/crear" class="boton boton-amarillo">Nuevo(a) Vendedor(a)</a>

        <h2>Propiedades</h2>
        
        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody> <!--Mostrar Resultados De La Base De Datos-->

            <?php foreach($propiedades as $propiedad): ?> <!--Por Cada Una De Las Propiedades-->
                <tr>
                    <td><?php echo $propiedad->id; ?></td>
                    <td> <?php echo $propiedad->titulo; ?> </td>
                    <td><img src="../imagenes/<?php echo $propiedad->imagen; ?>" alt="Imagen Casa" class="imagen-tabla"></td>
                    <td>$ <?php echo $propiedad->precio; ?></td>
                    <td>
                        <!--Recordemos  Que Al No Tener Action El Formulario Se Envia A Este Mismo Archivo-->
                        <form method="POST" class="w-100" action="/propiedades/eliminar">
                        <!--Obtenemos El Id Sin Mostrar El Input Con La Propiedad Hideen-->
                        <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                        <input type="hidden" name="tipo" value="propiedad">
                        <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        
                        <!--Tomamos El Id De La Base De Datos Para Traer La Info De La Propiedad A Actualizar-->
                        <a href="/propiedades/actualizar?id=<?php echo $propiedad->id; ?>"
                         class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>

        <h2>Vendedores</h2>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Telefono</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody> <!--Mostrar Resultados De La Base De Datos-->

            <?php foreach($vendedores as $vendedor): ?> <!--Por Cada Una De Las Propiedades-->
                <tr>
                    <td><?php echo $vendedor->id; ?></td>
                    <td><?php echo $vendedor->nombre . " " . $vendedor->apellido; ?> </td>
                    <td><?php echo $vendedor->telefono; ?></td>
                    <td>
                        <!--Recordemos  Que Al No Tener Action El Formulario Se Envia A Este Mismo Archivo-->
                        <form method="POST" class="w-100" action="/vendedores/eliminar">
                        <!--Obtenemos El Id Sin Mostrar El Input Con La Propiedad Hideen-->
                        <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                        <input type="hidden" name="tipo" value="vendedor">
                        <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        
                        <!--Tomamos El Id De La Base De Datos Para Traer La Info De La Propiedad A Actualizar-->
                        <a href="/vendedores/actualizar?id=<?php echo $vendedor->id; ?>"
                         class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
</main>