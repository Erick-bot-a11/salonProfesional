<h1 class="nombre-pagina">Recuperar tu Contraseña</h1>
<p class="descripcion-pagina">A continuacion, ingresa el tu nueva contraseña</p>

<?php include_once __DIR__."/../templates/alertas.php";?>
<?php if($error) return?>
<form  class="formulario" method="POST">
    <div class="campo">
        <label for="password">Password:</label>
        <input type="password" placeholder="Tu nuevo Password" name="password" id="epassword">
    </div>
    <input type="submit" value="guardar nuevo password" class="boton">
</form>

<div class="opciones">
    <a href="/">¿Ya tienes una cuenta? Inicia Sesión</a>
    <a href="/crear-cuenta">¿Aún no tienes una cuenta? Crea una</a>
</div>