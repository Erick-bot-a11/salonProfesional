<h1 class="nombre-pagina">Crea una Cita</h1>
<p class="descripcion-pagina">Selecciona los servicios y datos</p>

<?php
    include_once __DIR__."/../templates/barra.php";
?>
<div id="app">
    <nav class="tabs">
        <button type="button" data-paso="1">Servicios</button>
        <button type="button" data-paso="2">Informacion Cita</button>
        <button type="button" data-paso="3">Resumen</button>
    </nav>

    <div id="paso1" class="seccion">
        <h2>Servicios</h2>
        <p class="text-center">Selecciona tus servicios</p>
        <div id="servicios" class="listado-servicios"></div>
    </div>
    
    <div id="paso2" class="seccion">
        <h2>Tus datos y Cita</h2>
        <p class="text-center">Selecciona tus datos y fecha de tu cita</p>
        <form class="formulario">
            <div class="campo">
                <label for="nombre">Nombre:</label>
                <input 
                    id="nombre"
                    name="nombre"
                    type="text"
                    placeholder="Tu nombre"
                    value="<?php echo $nombre;?>"
                    disabled
                >
            </div>
            <div class="campo">
                <label for="fecha">Fecha:</label>
                <input 
                    id="fecha"
                    type="date"
                    min="<?php echo date("Y-m-d",strtotime("+1 days"));?>"
                >
            </div>
            <div class="campo">
                <label for="hora">Hora:</label>
                <input 
                    id="hora"
                    type="time"
                >
            </div>
            <input type="hidden" value="<?php echo $id;?>" id="id">
        </form>
    </div>
    <div id="paso3" class="seccion contenido-resumen">
        <h2>Resumen</h2>
        <p class="text-center">Verifica que la informacion sea correcta</p>
    </div>

    <div class="paginacion">
        <button
            id="anterior"
            class="boton"
        >&laquo;Anterior</button>
        <button
            id="siguiente"
            class="boton"
        >Suguiente&raquo;</button>
    </div>
</div>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
$script="<script src='build/js/app.js'></script>
        <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>";


?>