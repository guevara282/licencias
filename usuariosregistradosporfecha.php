<?php
include "final.php";
error_reporting(0);
session_start();





$consu="SELECT * from usuario where numerodocumento=11111";
$r=mysqli_query($conexion, $consu);
$f=mysqli_fetch_array($r);

$consulta="SELECT * from empresa";
$resultado=mysqli_query($conexion, $consulta);
$nombre=mysqli_fetch_array($resultado);


$rol=$_SESSION['rol'];
$con="select * from permiso where idpermiso in (select idpermiso from permisorol where idrol='1' and estado='1') order by cast(idpermiso as decimal);";
$resul=mysqli_query($conexion,$con);

$cons="SELECT rol.nombre from rol where idrol=1";
$res=mysqli_query($conexion, $cons);
$c=mysqli_fetch_array($res);
                     



?>


<html>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="bootstrap/css/font-awesome.css">
<link rel="stylesheet" type="text/css" href="eh.css">
<link rel="stylesheet" type="text/css" href="est.css">
<link rel="stylesheet" type="text/css" href="estilo.css">
<header>
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
</header>
<div class="contain">
             <br><br><br>
      <form action="rusuariosregistradosporfecha.php" method="post">
      <h2>Reporte cantidad de usuarios que se han registrado en un rango de fecha</h2>
      <br><br>
        <form action="">

        <p>
            <label for="" class="form-control">Fecha inicio</label>
            <input class="form-control" type="date" name="nombre" required >
          </p>
          <p>
            <label for="" class="form-control">Fecha fin</label>
            <input class="form-control" type="date" name="nombre2" required>
          </p>
          <p class="full-width">
          <br><br>
            <button>Generar</button>
          </p>
        </form>
      </div>
    </div>
  </div>
  </html>
  