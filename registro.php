<?php
include "final.php";
$consulta="SELECT * from empresa";

$resultado=mysqli_query($conexion, $consulta);

$nombre=mysqli_fetch_array($resultado);

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="uft-8">
    <!-- <tittle>Formulario de registro1</tittle> -->
    <link rel="stylesheet" href="e.css">

    <script src="validar.js"></script>

</head>

<body>
    <!--  <h1>Formulario de registro</h1> -->
    <form action="registrar.php" method="post" class="form-register" onsubmit="return validar(this);">
        <h2 class="form__titulo">Crear una cuenta</h2>
        <div class="contenedor-inputs">
            <input type="text" id="nombre" name="nombre" placeholder="Nombre" class="input-48">
            <input type="text" id="apellido" name="apellido" placeholder="Apellido" class="input-48">
            <input type="email" id="correo" name="correo" placeholder="Correo" class="input-100">
            <input type="text" id="usuario" name="usuario" placeholder="Numero documento" class="input-48">
            <input type="password" id="clave" name="clave" placeholder="Clave" class="input-48">
            <input type="text" id="telefono" name="telefono" placeholder="telefono" class="input-100">
            <input type="submit" value="Registrar " class="btn-enviar">



            <p class="form__link">Ya tienes una cuenta?<a href="login.php" class="form__link">Ingresa aqui</a></p>
            <p class="form__link"><?php echo "$nombre[nombre]" ?></p>
<p class="form__link">Celular: <?php echo "$nombre[telefono]" ?></p>
<p class="form__link">Dirección: <?php echo "$nombre[direccion]" ?></p>



           </div>

    </form>
</body>

</html>