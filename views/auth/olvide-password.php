<h1 class="nombre-pagina">Recupera tu contraseña</h1>
<p class="descripcion-pagina">Ingresa tu E-mail y recibe instrucciones para recuperar tu contraseña</p>
<?php include_once __DIR__."/../templates/alertas.php";?>
<form action="/olvide" class="formulario" method="POST">
    <div class="campo">
        <label for="email">E-mail</label>
        <input type="email" placeholder="Tu E-mail" name="email" id="e-mail">
    </div>
    <input type="submit" value="Recibir Instrucciones" class="boton">
</form>

<div class="opciones">
    <a href="/">¿Ya tienes una cuenta? Inicia Sesión</a>
    <a href="/crear-cuenta">¿Aún no tienes una cuenta? Crea una</a>
</div>