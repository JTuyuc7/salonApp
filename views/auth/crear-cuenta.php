
<h1 class="nombre-pagina">Crear Cuenta</h1>

<p class="descripcion-pagina">Empieza creando tu cuenta</p>

<div class="contenedor-form">

    <?php 
        include_once __DIR__ . '/../templates/alertas.php';
    ?>

    <form method="POST" action="/crear-cuenta" class="formulario">
        <fieldset>
            <legend>Tus datos</legend>

            <div class="campo">
                <label for="nombre">Nombre</label>
                <input id="nombre" placeholder="Tu Nombre" type="text" name="nombre" value="<?php echo s($usuario->nombre) ?>" />
            </div>
            <div class="campo">
                <label for="apellido">Apellido</label>
                <input id="apellido" placeholder="Tu Apellido" type="text" name="apellido" value="<?php echo s($usuario->apellido) ?>" />
            </div>
            <div class="campo">
                <label for="telefono">Telefono</label>
                <input id="telefono" placeholder="Tu Telefono" type="tel" name="telefono" value="<?php echo s($usuario->telefono) ?>" />
            </div>
            <div class="campo">
                <label for="email">Email</label>
                <input id="email" placeholder="Tu email" type="email" name="email" value="<?php echo s($usuario->email) ?>" />
            </div>
            <div class="campo">
                <label for="password">Password</label>
                <input id="password" placeholder="Tu password" type="password" name="password" />
            </div>

            <div>
                <input type="submit" value="Crear Cuenta" class="boton" />
            </div>
        </fieldset>
    </form>

    <div class="acciones">
        <a href="/">Inicia Sesion</a>
        <a href="/olvide">Olvide mi contraseña</a>
    </div>
</div>