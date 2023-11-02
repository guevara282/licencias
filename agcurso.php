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

$consulta="SELECT * from empresa";
$resultado=mysqli_query($conexion, $consulta);
$nombre=mysqli_fetch_array($resultado);


$rol=$_SESSION['rol'];
$con="select * from permiso where idpermiso in (select idpermiso from permisorol where idrol='$rol' and estado='1') order by cast(idpermiso as decimal);";
$resul=mysqli_query($conexion,$con);

if($varsesion==null || $varsesion = ''){
  echo '<script>
  alert("Por favor, inicie sesión para ingresar");
  window.location.href = "login.php";
    </script>';
    die();
}


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
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="bootstrap/css/font-awesome.css">
<link rel="stylesheet" type="text/css" href="eh.css">
<link rel="stylesheet" type="text/css" href="est.css">
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
<head>
	<meta charset="utf-8">
	<title>PHP CRUD usando PDO y Bootstrap/Modal</title>
</head>
<body>
<div class="container">
	<br><br><br>
	<h1 class="page-header text-center">ADMINISTRAR CURSOS</h1>
	<div class="row">
		<div class="col-sm-12">
			<a href="#addnew" class="btn btn-primary" data-toggle="modal"><span class="fa fa-plus"></span> Nuevo curso</a>
            <?php 
                session_start();
                if(isset($_SESSION['message'])){
                    ?>
                    <div class="alert alert-dismissible alert-success" style="margin-top:20px;">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <?php echo $_SESSION['message']; ?>
                    </div>
                    <?php

                    unset($_SESSION['message']);
                }
            ?>
			<table class="table table-bordered table-striped" style="margin-top:20px;">
				<thead>
					<th>ID</th>
					<th>Nombre</th>
					<th>Categoria</th>
					<th>Tipo vehiculo</th>
					<th>Salon</th>
					<th>Fecha inicio</th>
					<th>Fecha fin</th>
					<th>Hora inicio</th>
					<th>Hora fin</th>
					<th>Profesor</th>
					<th>Acción</th>
				</thead>
				<tbody>
					<?php
						// incluye la conexión
						include_once('connection.php');

						$database = new Connection();
    					$db = $database->open();
						try{	
						    $sql = 'SELECT * FROM curso';
						    foreach ($db->query($sql) as $row) {
						    	?>
						    	<tr>
						    		<td><?php echo $row['idcurso']; ?></td>
						    		<td><?php echo $row['nombre']; ?></td>

									<td><?php 
									$ca= $row['idcategoria'];
								$mn="select * from categoria where idcategoria in (select idcategoria from curso where idcategoria=$ca and estado ='1')";
									foreach($db->query($mn) as $cat){
                                     echo $cat['nombre'];
									}
									
									?></td>

									<td><?php
									$qw="select * from tipovehiculo where idtipovehiculo in (select idtipovehiculo from categoria where idcategoria=$ca)";
									foreach($db->query($qw) as $catt){
										echo $catt['nombre'];
									   }
									?></td>

									<td><?php 
									$sa=$row['idsalon'];
									$salon="select * from salon where idsalon in(select idsalon from curso where idsalon=$sa and estado ='1')";
									foreach($db->query($salon) as $sal){
										echo $sal['nombre'];
									   }
									
									
									?></td>

									<td><?php echo $row['fechainicio']; ?></td>
									<td><?php echo $row['fechafin']; ?></td>
									<td><?php echo $row['horainicio']; ?></td>
									<td><?php echo $row['horafin']; ?></td>

									<td><?php 
									$p= $row['idprofesor'];
									$pro="select * from usuario where numerodocumento in (select idprofesor from curso where idprofesor=$p and estado ='1')";
									foreach($db->query($pro) as $profe){
										echo $profe['nombre']. " ". $profe['nombre2']. " ". $profe['apellido']. " ". $profe['apellido2'];
									   }
									?></td>

						    		<td>
						    			<a href="#edit_<?php echo $row['idcurso']; ?>" class="btn btn-success btn-sm" data-toggle="modal"><span class="fa fa-edit"></span> Editar</a>
						    			<a href="#delete_<?php echo $row['idcurso']; ?>" class="btn btn-danger btn-sm" data-toggle="modal"><span class="fa fa-trash"></span> Eliminar</a>
						    		</td>
						    		<?php include('edit_delete_modalcu.php'); ?>
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
<?php include('add_modalcu.php'); ?>
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