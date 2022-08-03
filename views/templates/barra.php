
<div class="barra">
    <p>Hola: <span> <?php echo $nombre ?? '' ?></span></p>
    <a class="boton" href="/logout">Cerrar Sesion</a>
</div>

<?php if(isset($_SESSION['admin'])) { ?>

    <div class="barra-servicios">
        <a href="/admin" class="boton">Ver Citas</a>
        <a href="/servicios" class="boton">Ver servicios</a>
        <a href="/servicios/crear" class="boton">Nuevo Servicio</a>
    </div>
<?php } ?>