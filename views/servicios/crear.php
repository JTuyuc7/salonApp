<h1 class="nombre-pagina">Nuevo Servicio</h1>

<p class="descripcion-pagina">Crea nuevos servicios acontinuacion</p>

<?php
    include_once __DIR__ . '/../templates/barra.php';
    include_once __DIR__ . '/../templates/alertas.php';
?>

<div class="contenedor-form">
    <fieldset>
        <legend>Datos</legend>
        <form action="/servicios/crear" method="POST">
            
            <?php 
                include_once __DIR__ . '/formulario.php';
            ?>

            <div>
                <input type="submit" value="Crear Servicio" class="boton" />
            </div>
        </form>
    </fieldset>
</div>