<h1 class="nombre-pagina">Login</h1>

<p class="descripcion-pagina">Inicia sesion con tus datos</p>

<div class="contenedor-form">

    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

    <form method="POST" action="/" class="formulario">
        <fieldset>
            <legend>Tus datos</legend>

            <div class="campo">
                <label for="email">Email</label>
                <input id="email" placeholder="Tu email" type="email" name="email" value="<?php echo s($auth->email); ?>" />
            </div>
            <div class="campo">
                <label for="password">Password</label>
                <input id="password" placeholder="Tu password" type="password" name="password" />
            </div>

            <div>
                <input type="submit" value="Iniciar Sesion" class="boton" />
            </div>
        </fieldset>
    </form>

    <div class="acciones">
        <a href="/crear-cuenta">Crear Cuenta</a>
        <a href="/olvide">Olvide mi contraseña</a>
    </div>
</div>