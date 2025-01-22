<main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesión</h1>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>

        <?php endforeach; ?>

        <form method="POST" class="formulario" action="/login">

        <fieldset>
                <legend>Email Y Contraseña</legend>
                <!--Required No Permite Enviar El Formulario Vacio-->
                <label for="email">Correo Electronico O E-Mail</label>
                <input type="email" name="email" placeholder="Tu Correo" id="email">

                <label for="password">Contraseña</label>
                <input type="password" name="password" placeholder="Tu Contraseña" id="password">

            </fieldset>

            <input type="submit" value="Iniciar Sesión" class="boton boton-verde">

        </form>
    </main>