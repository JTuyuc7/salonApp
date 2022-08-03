<h1 class="nombre-pagina">Crear Nueva cita</h1>

<p class="descripcion-pagina">Selecciona tus servicios acontinuacion</p>

<?php
    include_once __DIR__ . '/../templates/barra.php';
?>

<div class="app">

    <nav class="tabs">
        <button type="button" class="actual" data-paso="1">Servicios</button>
        <button type="button" data-paso="2">Informacion</button>
        <button type="button" data-paso="3">Resumen</button>
    </nav>

    <div id="paso-1" class="seccion">
        <h2>Servicios</h2>
        <p class="text-center">Elije tus servicios</p>
        <div class="listado-servicios" id="servicios">

        </div>
    </div>

    <div id="paso-2" class="seccion">
        <h2>Tus datos y Cita</h2>
        <p class="text-center">Ingresa tus datos, y fecha de cita</p>

        <div class="contenedor-form">
            <form class="formulario">
                <fieldset>
                    <legend>Informacion</legend>
                        <div class="campo">
                            <label for="nombre">Nombre</label>
                            <input id="nombre" type="text" placeholder="Tu nombre" value="<?php echo $nombre ?>" disabled />
                        </div>
                        <div class="campo">
                            <label for="fecha">Fecha</label>
                            <input id="fecha" type="date" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" />
                        </div>
                        <div class="campo">
                            <label for="hora">Hora</label>
                            <input id="hora" type="time"/>
                            <input type="hidden" id="id" value="<?php echo $id; ?>" />
                        </div>
                </fieldset>
            </form>
        </div>
    </div>

    <div id="paso-3" class="seccion contenido-resumen">
        <!-- <h2>Resumen</h2>
        <p class="text-center">Verifica tu informaion y cita</p> -->
    </div>

    <div class="paginacion">
        <button id="anterior" class="boton">&laquo; Anterior</button>
        <button id="siguiente" class="boton">Siguiente &raquo;</button>
    </div>
</div>

<?php 
    $script = "
        <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script src='build/js/app.js'></script>
    ";
?>