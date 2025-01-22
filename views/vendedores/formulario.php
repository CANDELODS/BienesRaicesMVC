<fieldset>
    <legend>Información General</legend>
    <!--Con Value obtenemos el valor y lo guardamos-->
    <label for="nombre">Nombre:</label>
    <input type="text" placeholder="Nombre Vendedor(a)" id="nombre" name="vendedor[nombre]" value="<?php echo s( $vendedor->nombre ); ?>">

    <label for="apellido">Apellido:</label>
    <input type="text" placeholder="Apellido Vendedor(a)" id="apellido" name="vendedor[apellido]" value="<?php echo s( $vendedor->apellido ); ?>">

</fieldset>

<fieldset>
    <legend>Información Extra</legend>
    <label for="telefono">Telefono:</label>
    <input type="text" placeholder="Telefono Vendedor(a)" id="telefono" name="vendedor[telefono]" value="<?php echo s( $vendedor->telefono ); ?>">
</fieldset>