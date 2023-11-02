<?php
include "final.php";

$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$correo = $_POST["correo"];
$usuario = $_POST["usuario"];
$clave = $_POST["clave"];
$telefono = $_POST["telefono"];


$hash = password_hash($clave, PASSWORD_DEFAULT);

$insertar="INSERT INTO usuario (nombre, apellido, email, numerodocumento,contraseña, telefono, idrol, fecha ) VALUES('$nombre','$apellido', '$correo', '$usuario', '$hash', '$telefono', '1', CURRENT_TIMESTAMP) ";

$verificar_usuario = mysqli_query($conexion, "SELECT * from usuario where numerodocumento ='$usuario'");

if(mysqli_num_rows($verificar_usuario) > 0){
    echo '<script>
    alert("el número de identificación ya está registrado");
    window.history.go(-1);
    </script>';

    exit;
}


$verificar_correo = mysqli_query($conexion, "SELECT * from usuario where email ='$correo'");

if(mysqli_num_rows($verificar_correo) > 0){
    echo '<script>
    alert("el correo ya está registrado");
    window.history.go(-1);
    </script>';

    exit;
}


$resultado=mysqli_query($conexion, $insertar);

if(!$resultado){
    echo '<script>
    alert("Registro incorrecto");
    window.history.go(-1);
    </script>';
}else{
    echo '<script>
    alert("Registro Exitoso");
    window.location.href = "login.php";
    </script>';
}

mysqli_close($conexion);



?>