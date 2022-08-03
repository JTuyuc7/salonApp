<h1 class="nombre-pagina">Actualizar Servicios</h1>

<p class="descripcion-pagina">Actualiza informacion del servicio seleccionado</p>

<?php
    include_once __DIR__ . '/../templates/barra.php';
?>

<div class="contenedor-form">
    <fieldset>
        <legend>Datos</legend>
        <form method="POST">
            <?php 
                include_once __DIR__ . '/formulario.php';
            ?>

            <div>
                <input type="submit" value="Actualizar" class="boton" />
            </div>
        </form>
    </fieldset>
</div>