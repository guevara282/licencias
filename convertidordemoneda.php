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
                     

if(isset($_POST['moneda'])){
  
  $moneda=$_POST['moneda'];

  if($moneda==0){

    $url="https://api.cambio.today/v1/full/USD/json?key=4897|NTJ8poFsHi2Tn5wTcOWofMPFUFtAjcuN";
    $json=file_get_contents($url);
    $datos =json_decode($json,true);
    
    $conv= $datos["result"];
    $convDos = $conv["conversion"][30]["rate"];
  }if($moneda==1){
    $url="https://api.cambio.today/v1/full/COP/json?key=4897|NTJ8poFsHi2Tn5wTcOWofMPFUFtAjcuN";
    $json=file_get_contents($url);
    $datos =json_decode($json,true);
    
    $conv= $datos["result"];
    $convDos = $conv["conversion"][135]["rate"];


  }

  if($moneda==2){
    $url="https://api.cambio.today/v1/full/EUR/json?key=4897|NTJ8poFsHi2Tn5wTcOWofMPFUFtAjcuN";
    $json=file_get_contents($url);
    $datos =json_decode($json,true);
    
    $conv= $datos["result"];
    $convDos = $conv["conversion"][30]["rate"];


  }

  if($moneda==3){
    $url="https://api.cambio.today/v1/full/EUR/json?key=4897|NTJ8poFsHi2Tn5wTcOWofMPFUFtAjcuN";
    $json=file_get_contents($url);
    $datos =json_decode($json,true);
    
    $conv= $datos["result"];
    $convDos = $conv["conversion"][42]["rate"];


  }
  
  }

  if(isset($_POST['can'])){
  
    $can=$_POST['can'];
    
    }

  



$total=$convDos*$can;




?>


<html>
<head lang="es">
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="eh.css">
	<link rel="stylesheet" type="text/css" href="est.css">
  <link rel="stylesheet" type="text/css" href="estilo.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/font-awesome.css">
</head>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

<header>
<center>
  <div id="nav" style="color: #fff; font-style: italic" title="<?php echo ['nombre'];?>">
  <input type="checkbox" id="btn-menu">
            <label for="btn-menu"><img src="imagen.png" alt=""></label>
            <nav class="menu">
                <ul>
                <li>
                 <p style="color:#ffffff; font-size:13pt; text-align:center; font-family:monospace">
               <?php 
                   
                   $cons="SELECT rol.nombre from rol where idrol=$rol";
                   $res=mysqli_query($conexion, $cons);
                    $c=mysqli_fetch_array($res);
                     echo $c['nombre'];
               ?>
              </p>
            <p style="color:#ffffff; font-size:11pt; text-align:center; font-family:monospace">
                   Bienvenido, <?php echo $f['nombre'] . " ". $f['apellido']?>
            </p>
            <p style="color:#ffffff; font-size:7pt; text-align:center; font-family:monospace">
            <?php echo "$nombre[nombre]"?>
            </p>
         </li>
		 <li><form action="menuu.php" method="POST">
      <button class="s" style="color:#ffffff; font-size:11pt; text-align:center; font-family:monospace" ><h2>Volver al inicio</h2></button>
  </form></li>
            </ul>
            </nav>
  </div>
  </center>
</header>


<div class="contain">
  <br><br><br>
      <form action="convertidordemoneda.php" method="post">
      <h2>Convertidor de moneda </h2>
      <br><br>
        <form action="">    
                 
<p>
          <label for="">Seleccione la moneda</label>
            <br>
            <select name="moneda" id="moneda" class="form-control"  required>
            <option>Seleccione:</option>
            
            <option value="0">USD A COP </option> 
       <option value="1"> COP A USD </option> 
       <option value="2"> EUR A COP </option> 
       <option value="3"> COP A EUR </option> 
            </select>
          </p> 

          

          <p>
            <label for="">Digite la cantidad</label>
            <br>
            <input class="form-control" type="text"  name="can"   placeholder="Digite la cantidad" required>
          </p>
          <p class="full-width">
          <h2><?php if(isset($moneda) && $moneda==0 ){echo $can." USD son ".$total." COP";} if(isset($moneda) && $moneda==1 ) { echo $can." COP son ".$total." USD"; } if(isset($moneda) && $moneda==2 ) { echo $can." EUR son ".$total." COP"; } if(isset($moneda) && $moneda==3 ) { echo $can." COP son ".$total." EUR"; }?></h2>

         <!-- <center> <h1><?php if(isset($moneda) && $moneda==0 ){echo /* "Total:".$total. "cop" */ $can."USD son".$total."COP";}?></h1></center> -->
          </p>
          <p class="full-width">
     
          <br><br>
            <button>Convertir</button>
            <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>  
          </p>
        </form>
      </div>
    </div>
  </div>



 


  </html>
  