<h1 class="nombre-pagina">Actualizar Servicio</h1>
<p class="descripcion-pagina">Llena los campos para actualizar el servicio</p>

<?php 
include __DIR__."/../templates/barra.php";
?>

<form  method="POST" class="formulario">

    <?php
    include_once __DIR__."/formulario.php";
    include_once __DIR__."/../templates/alertas.php";
    ?>

    <input type="submit" class="boton" value="Actualizar">
</form>