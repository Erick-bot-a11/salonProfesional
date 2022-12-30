<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina"> Inicia Sesión de tus Datos</p>

<?php include_once __DIR__."/../templates/alertas.php";?>

<form class="formulario" action="/" method="POST">
    <div class="campo">
        <label for="email">Ingresa tu E-mail</label>
        <input type="email" name="email" placeholder="Tu correo" id="email">
    </div>
    <div class="campo">
        <label for="password">Ingresa tu contraseña</label>
        <input type="password" name="password" placeholder="Tu password" id="password">
    </div>
    <input type="submit" value="Iniciar Sesión" class="boton">
</form>

<div class="opciones">
    <a href="/crear-cuenta">Crea una cuenta</a>
    <a href="/olvide">¿Olvidaste tu contraseña?</a>
</div>