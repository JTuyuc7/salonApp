<h1 class="nombre-pagina">Olvide mi contraseña</h1>

<p class="descripcion-pagina">Ingresa tu email para recibir instrucciones</p>

<div class="contenedor-form">
    <?php 
        include_once __DIR__ . '/../templates/alertas.php';
    ?>
    <form method="POST" action="/olvide" class="formulario">
        <fieldset>
            <legend>Tus datos</legend>

            <div class="campo">
                <label for="email">Email</label>
                <input id="email" placeholder="Tu email" type="email" name="email"  />
            </div>
            <div>
                <input type="submit" value="Enviar Datos" class="boton" />
            </div>
        </fieldset>
    </form>

    <div class="acciones">
        <a href="/">Iniciar Sesion</a>
        <a href="/crear-cuenta">Crear Cuenta</a>
    </div>
</div>