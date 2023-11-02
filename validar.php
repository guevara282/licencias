<?php
include "final.php";

session_start();

$usuario=$_POST['correo'];


$clave=$_POST['clave'];


$consulta="SELECT * from usuario WHERE email = '$usuario'  ";

$resultado=mysqli_query($conexion, $consulta);


$filas=mysqli_num_rows($resultado);

if  ($filas>0){
    $datos=mysqli_fetch_array($resultado);

    if (password_verify($clave, "$datos[contraseña]")){
        $_SESSION['usuario'] ="$datos[nombre] $datos[apellido]";
        $_SESSION['numerodocumento']="$datos[numerodocumento]";
        $_SESSION['rol'] = "$datos[idrol]";
        $_SESSION['tiempo']=time();
        $_SESSION['direccion']="$datos[direccion]";
        $_SESSION['telefono']="$datos[telefono]";
        $_SESSION['celular']="$datos[celular]";
        $_SESSION['email']="$datos[email]";
        $_SESSION['contraseña']="$datos[contraseña]";
       

        header("location:menuu.php");
        
        
        }else {
            
            echo '<script>
            alert(" clave invalido");
            window.history.go(-1);
            </script>';

        }

}else{
   
    echo '<script>
    alert("Correo invalido");
    window.history.go(-1);
    </script>';

    exit;

}

mysqli_free_result($consulta);
mysqli_close($conexion);

?>