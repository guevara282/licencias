
<?php
include "final.php";
$consulta="SELECT * from empresa";

$resultado=mysqli_query($conexion, $consulta);

$nombre=mysqli_fetch_array($resultado);

?>

<!DOCTYPE html>

<html lang ="es">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="e.css">

</head>
<body>

<form action="validar.php" method="post" class="form-login">
<h2 class="form__titulo"> Iniciar sesión</h2>

<div class="contenedor-input">

<input type="text" name = "correo" placeholder ="Correo" class="input-100">
<input type="password" name = "clave" placeholder ="Clave" class="input-100">
<input type="submit" value="Entrar" name = "entrar" class="btn-enviar">

<p class="form__link">¿No tienes una cuenta?<a href="registro.php" class="form__link">Ingresa aqui</a></p>

<p class="form__link"><?php echo "$nombre[nombre]" ?></p>
<p class="form__link">Celular: <?php echo "$nombre[telefono]" ?></p>
<p class="form__link">Dirección: <?php echo "$nombre[direccion]" ?></p>




</div>
</form>"

</body>



</html>



