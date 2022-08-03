<h1 class="nombre-pagina">Cambiar Contraseña</h1>

<p class="descripcion-pagina">Ingresa una nueva contraseña</p>

<div class="contenedor-form">

    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

    <?php if($error) return null; ?>

    <form method="POST" class="formulario">
        <fieldset>
            <legend>Tus nuevos datos</legend>

            <div class="campo">
                <label for="password">Password</label>
                <input id="password" placeholder="Tu nuevo password" type="password" name="password" />
            </div>

            <div>
                <input type="submit" value="Cambiar password" class="boton" />
            </div>
        </fieldset>
    </form>

    <div class="acciones">
        <a href="/">Iniciar Sesion</a>
        <a href="/crear-cuenta">Crear Cuenta</a>
    </div>
</div>