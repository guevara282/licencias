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
<?php

	// incluye la conexión
	include_once('connection.php');

	$database = new Connection();
	$db = $database->open();
	
?>




<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>PHP CRUD usando PDO y Bootstrap/Modal</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="eh.css">
    <link rel="stylesheet" type="text/css" href="est.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/font-awesome.css">
</head>
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
<body>
    <div class="container">
        <br><br><br>
        <h1 class="page-header text-center">HORARIO</h1>
        <div class="row">
            <div class="col-sm-12">

                
        <table class="table table-bordered table-striped" style="margin-top:20px;">
            <thead>
                <th>Curso</th>
                <th>Categoria</th>
                <th>Tipo de vehiculo</th>
                <th>Lunes</th>
                <th>Martes</th>
                <th>Miercoles</th>
                <th>Jueves</th>
                <th>Viernes</th>
                <th>Sabado</th>
               
                


            </thead>
            <tbody>
                <?php
					
						try{
							
							
	                         $sql = "select * from curso where idcurso in (select idcurso from cursousuario where numerodocumento=$varse)";
                             
	                           
							
                                   

							

						    foreach ($db->query($sql) as $row) {
						    	?>
                <tr>

                    <td><?php echo $row['nombre']?></td>
                    <td><?php 
                    $ca=$row['idcurso'];
                    $pr=$row['idprofesor'];
                    $co="select * from categoria where idcategoria in (select idcategoria from curso where idcurso=$ca)";
                    
                    foreach($db->query($co) as $h){
                        echo $h['nombre'];
                    }
                    
                    ?></td>
                    <td><?php
									$ca= $row['idcategoria'];
									$qw="select * from tipovehiculo where idtipovehiculo in (select idtipovehiculo from categoria where idcategoria=$ca)";
									foreach($db->query($qw) as $catt){
										echo $catt['nombre'];
									   }
									?></td>
                    <td><?php 
                    $c="select * from usuario where numerodocumento in(select idprofesor from curso where idprofesor=$pr)";
                    $sa="select * from salon where idsalon in(select idsalon from curso where idcurso=$ca)";

                    foreach($db->query($c)as $l){
                        echo $row['horainicio']." - ".$row['horafin'];
                        echo "<br>";
                        foreach($db->query($sa) as $sal){
                                 echo $sal['nombre']."<br>";
                        }
                        echo $l['nombre']. " ". $l['nombre2']. "<br>". $l['apellido']. " ". $l['apellido2'];
                       
                    }
                    
                    ?>              
                    
                    </td>
                    <td><?php   
                    foreach($db->query($c)as $l){
                        echo $row['horainicio']." - ".$row['horafin'];
                        echo "<br>";
                        foreach($db->query($sa) as $sal){
                                 echo $sal['nombre']."<br>";
                        }
                        echo $l['nombre']. " ". $l['nombre2']. "<br>". $l['apellido']. " ". $l['apellido2'];
                       
                    }
                    ?></td>

<td><?php   foreach($db->query($c)as $l){
                        echo $row['horainicio']." - ".$row['horafin'];
                        echo "<br>";
                        foreach($db->query($sa) as $sal){
                                 echo $sal['nombre']."<br>";
                        }
                        echo $l['nombre']. " ". $l['nombre2']. "<br>". $l['apellido']. " ". $l['apellido2'];
                       
                    }                ?></td>

<td><?php   foreach($db->query($c)as $l){
                        echo $row['horainicio']." - ".$row['horafin'];
                        echo "<br>";
                        foreach($db->query($sa) as $sal){
                                 echo $sal['nombre']."<br>";
                        }
                        echo $l['nombre']. " ". $l['nombre2']. "<br>". $l['apellido']. " ". $l['apellido2'];
                       
                    }     ?></td>

<td><?php   foreach($db->query($c)as $l){
                        echo $row['horainicio']." - ".$row['horafin'];
                        echo "<br>";
                        foreach($db->query($sa) as $sal){
                                 echo $sal['nombre']."<br>";
                        }
                        echo $l['nombre']. " ". $l['nombre2']. "<br>". $l['apellido']. " ". $l['apellido2'];
                       
                    }   ?></td>

                    <td></td>
                
                
                  
                </tr>
                <?php 
						    }
						}
						catch(PDOException $e){
							echo "There is some problem in connection: " . $e->getMessage();
						}

						//cerrar conexión
						$database->close();

					?>
            </tbody>
        </table>
    </div>
    </div>
    </div>
   
    <script src="bootstrap/js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    <script src="bootstrap/js/custom.js"></script>
</body>

</html>
<?php 

  mysqli_free_result($consu);
  mysqli_free_result($consulta);
  mysqli_close($conexion);
  
  ?>