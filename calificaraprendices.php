<?php
include "final.php";
error_reporting(0);
session_start();

$varse = $_SESSION['numerodocumento'];
$varsesion = $_SESSION ['usuario'];
$var=$_SESSION['tiempo'];



if($varsesion==null || $varsesion = ''){
  echo '<script>
  alert("Por favor, inicie sesión para ingresar");
  window.location.href = "login.php";
    </script>';
    die();
}

$consu="SELECT * from usuario where numerodocumento=$varse";
$r=mysqli_query($conexion, $consu);
$f=mysqli_fetch_array($r);

$consulta="SELECT * from empresa";
$resultado=mysqli_query($conexion, $consulta);
$nombre=mysqli_fetch_array($resultado);


$rol=$_SESSION['rol'];
$con="select * from permiso where idpermiso in (select idpermiso from permisorol where idrol='$rol' and estado='1') order by cast(idpermiso as decimal);";
$resul=mysqli_query($conexion,$con);

$cons="SELECT rol.nombre from rol where idrol=$rol";
$res=mysqli_query($conexion, $cons);
$c=mysqli_fetch_array($res);
                     


 if (time() - $var >10000) {  
  echo '<script>
    alert("Ha estado inactivo");
    window.location.href="login.php";
      </script>';
    session_destroy();

  die();  
}
$_SESSION['tiempo']=time(); 
?>
<link href="es.css" rel="stylesheet" type="text/css">

<header>
    
  <form action="menuu.php" method="POST">
      <button class="s"><h2>Volver al inicio</h2></button>
  </form>

</header>

<div class="contain">

    <div class="wrapper">
      <div class="contacts">
        <h3><?php echo $nombre['nombre'] ?></h3>
  
        <ul>
          <li> <?php echo $c['nombre']?></li>
          <li> <?php echo $f['nombre'] . " ". $f['apellido']?> </li>
          <li> <?php echo $f['numerodocumento'] ?> </li>
        </ul>
      </div>
  
      <div class="form">
        <h3>Ingresar nota aprendices</h3>
        <form action="">
          <p class ="full-height">
            <label for="">id del curso a evaluar </label>
            <input type="text">
          </p>
          <p class="full-width">
         
            <label for="">Nota final:</label>
            <br>
            <body>
              <table border="1">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>email</th>
                <th>nota</th>
                
              </tr>
            </thead>
            <tbody>
            
              <tr>
                 <td>1</td>
                <td>elver</td>
                <td>elver@gmail.com</td>
                <td> <input type="text" placeholder="nota"></td>
                
              </tr>
              <tr>
                <td>2</td>
               <td>juan</td>
               <td>juan@gmail.com</td>
               <td> <input type="text" placeholder="nota"></td>
               
             </tr>
           
            </tbody>
          </p>
         
        </table>
       
        
        </form>
      </div>
    </div>
  </div>
  

                 <?php 

                 mysqli_free_result($consu);
                 mysqli_free_result($consulta);
                 mysqli_free_result($cons);
                 mysqli_close($conexion);
                 
                 ?>