<h1 class="nombre-pagina">Crear nuevo servicio</h1>
<p class="descripcion-pagina">Llena los campos para añadir un nuevo servicio</p>

<?php 
include __DIR__."/../templates/barra.php";
?>

<form action="/servicios/crear" method="POST" class="formulario">

    <?php
    include_once __DIR__."/formulario.php";
    include_once __DIR__."/../templates/alertas.php";
    ?>

    <input type="submit" class="boton" value="Guardar Servicio">
</form>