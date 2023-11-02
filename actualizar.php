<?php
include "final.php";
error_reporting(0);
session_start();

$varse = $_SESSION['numerodocumento'];
$varsesion = $_SESSION ['usuario'];
$var=$_SESSION['tiempo'];

$consu="SELECT * from usuario where numerodocumento=$varse";
$r=mysqli_query($conexion, $consu);
$f=mysqli_fetch_array($r);


if($varsesion==null || $varsesion = ''){
  echo '<script>
  alert("Por favor, inicie sesión para ingresar");
  window.location.href = "login.php";
    </script>';
    die();
}


$consulta="SELECT * from empresa";
$resultado=mysqli_query($conexion, $consulta);
$nombre=mysqli_fetch_array($resultado);


$rol=$_SESSION['rol'];
$con="select * from permiso where idpermiso in (select idpermiso from permisorol where idrol='$rol' and estado='1') order by cast(idpermiso as decimal)";
$resul=mysqli_query($conexion,$con);



 if (time() - $var >10000) {  
  echo '<script>
    alert("Ha estado inactivo");
    window.location.href="login.php";
      </script>';
    session_destroy();

  die();  
}
$_SESSION['tiempo']=time(); 

$nombre=$_POST['nombre'];
$nombre2=$_POST['nombre2'];
$apellido=$_POST['apellido'];
$apellido2=$_POST['apellido2'];
$telefono=$_POST['telefono'];
$celular=$_POST['celular'];
$email=$_POST['email'];
$tiposangre=$_POST['idtiposangre'];
$direccion=$_POST['direccion'];
$tipo=$_POST['t'];
$rh=$_POST['idrh'];
$genero=$_POST['sexo'];

$cb="SELECT * from usuario where numerodocumento=$varse";
$resultadoo=mysqli_query($conexion, $cb);
$gh=mysqli_fetch_array($resultadoo);

if($tipo==0){
  $tipo=$gh['idtipodocumento'];
}else{
  $tipo=$_POST['t'];
}

if($tiposangre==0){
  $tiposangre=$gh['idtiposangre'];
}else{
  $tiposangre=$_POST['idtiposangre'];
}

if($rh==0){
  $rh=$gh['idrh'];
}else{
  $rh=$_POST['idrh'];
}

if($genero==0){
  $genero=$gh['idgenero'];
}else{
  $genero=$_POST['sexo'];
}

if(empty($tiposangre)) { $tiposangre=$gh['idtiposangre']; } 
if(empty($nombre)) {$nombre=$gh['nombre']; } 
if(empty($nombre2)) {$nombre2=$gh['nombre2']; } 
if(empty($apellido)) {$apellido=$gh['apellido']; } 
if(empty($apellido2)) {$apellido2=$gh['apellido2']; }
if(empty($telefono)) {$telefono=$gh['telefono']; } 
if(empty($celular)) {$celular=$gh['celular']; } 
if(empty($direccion)) {$direccion=$gh['direccion']; } 
if(empty($email)) {$email=$gh['email']; } 
if(empty($rh)) {$rh=$gh['idrh']; } 

$filas=mysqli_num_rows($resultadoo);
if($filas > 0){
$bb="update usuario set nombre='$nombre', nombre2='$nombre2', apellido='$apellido', apellido2='$apellido2', telefono= '$telefono', email='$email', celular='$celular', direccion='$direccion', idtipodocumento='$tipo', idtiposangre='$tiposangre', idrh='$rh', idgenero='$genero' where numerodocumento=$varse";
$resul=mysqli_query($conexion, $bb);

echo '<script>
alert("actualizacion exitosa");
</script>';

header("location:actualizarpersonal.php");

}

mysqli_free_result($consulta);
mysqli_free_result($con);
mysqli_free_result($cb);
mysqli_free_result($bb);
mysqli_close($conexion);
?>