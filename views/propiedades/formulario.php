<fieldset>
                <legend>Información General</legend>
                                                                                        <!--Con Value obtenemos el valor y lo guardamos-->
                <label for="titulo">Título:</label>
                <input type="text" placeholder="Titulo Propiedad" id="titulo" name="propiedad[titulo]" value="<?php echo s( $propiedad->titulo ); ?>">

                <label for="precio">Precio:</label>
                <input type="number" placeholder="Precio Propiedad" id="precio" name= "propiedad[precio]" value="<?php echo s( $propiedad->precio ); ?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="propiedad[imagen]">

                <?php if($propiedad->imagen){?>
                    <img src="/imagenes/<?php echo $propiedad->imagen ?>" class="imagen-small">
                <?php } ?>

                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="propiedad[descripcion]"><?php echo s($propiedad->descripcion); ?></textarea> <!--En los textare
                                                                                                     se obtiene el valor desde dentro--> 
            </fieldset>

            <fieldset>
                <legend>Información Propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" name="propiedad[habitaciones]" placeholder="EJ: 3" min='1' max= '9' value="<?php echo s($propiedad->habitaciones); ?>">

                <label for="inodoros">Baños:</label>
                <input type="number" id="inodoros" name="propiedad[inodoros]" placeholder="EJ: 3" min='1' max= '9' value="<?php echo s($propiedad->inodoros); ?>">

                <label for="estacionamiento">Estacionamiento:</label>
                <input type="number" id="estacionamiento" name="propiedad[estacionamiento]" placeholder="EJ: 3" min='1' max= '9' value="<?php echo s($propiedad->estacionamiento); ?>">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <label for="vendedor">Vendedor</label>
                <select name="propiedad[vendedores_id]" id="vendedor">
                <option selected value="">-- Seleccione --</option>
                <!--Normalmente Una Consulta A Una BD Viene Como Arreglo (While) Pero En Active Record, Usamos
                Objetos En Memoria, Por Lo Cual La Consulta Sera Sobre Objetos Y Por Eso Usamos La Sintaxis (->) -->
                    <?php foreach ($vendedores as $vendedor) { ?>
                            <!--Si El Id Del Vendedor De La Clase Propiedad Es Igual Al Vendedor Id En El Cual Estamos Iterando Actualmente Entonces Agrega El Atributo Selected En Caso Contario No Pone Nada-->
                            <option 
                                <?php echo $propiedad->vendedores_id === $vendedor->id ? 'selected' : ''; ?>
                                value="<?php echo s($vendedor->id) ?>"> <?php echo s($vendedor->nombre) . " " . s($vendedor->apellido); ?>
                            </option>
                        <?php } ?>
                </select>
            </fieldset>
