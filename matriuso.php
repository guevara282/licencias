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
<!DOCTYPE html>
<html lang="es">
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="eh.css">
<link rel="stylesheet" type="text/css" href="est.css">
<link rel="stylesheet" type="text/css" href="bootstrap/css/font-awesome.css">
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
	<h1 class="page-header text-center">Matricular aprendiz</h1>
	<br><br><br>
	<div class="row">
		<div class="col-sm-12">
		<?php $a=0; ?>
			<!-- <a href="#addnew" class="btn btn-primary" data-toggle="modal"><span class="fa fa-plus"></span> Nuevo</a> -->
			<form action="matriuso.php" class="form-inline my-2 my-lg-0" method="POST" >
			<!-- <input type="text" name="prueba" placeholder= "" > -->
		      <input class="form-control mr-sm-2" type="text" name="prueba">
		      <button class="btn btn-secondary my-2 my-sm-0" type="submit">BUSCAR APRENDIZ</button>
		    </form>
			<?php 
			?>
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
					<th>Numero documento</th>
					<th>Primer nombre</th>
					<th>Segundo nombre</th>
					<th>Primer apellido</th>
					<th>Segundo apellido</th>
					<th>Email</th>
					<th>Telefono</th>
					<th>Celular</th>
					<th>Dirección</th>
					<th>Rol</th>
					<th>Acción</th>
				</thead>
				<tbody>
					<?php
						// incluye la conexión
						include_once('connection.php');
						/* $b=$_POST['prueba']; */
						$database = new Connection();
    					$db = $database->open();
						try{
							
							/* if(empty($nombre)) {$nombre=$gh['nombre']; }  */	
							/* $a=0; */
							if(isset($_POST['prueba'])){
								$b=$_POST['prueba'];
								if(empty($b)){
									$sql = "SELECT * FROM usuario where idrol=1 ";
								}else{
									$sql = "SELECT * FROM usuario where numerodocumento=$b and idrol=1";
								}

							}else{
								/* $sql = "SELECT * FROM members where id=$b"; */
								$sql = "SELECT * FROM usuario where idrol=1 ";
							}
						    foreach ($db->query($sql) as $row) {
						    	?>
						    	<tr>
						    		<td><?php echo $row['numerodocumento']; ?></td>
						    		<td><?php echo $row['nombre']; ?></td>
						    		<td><?php echo $row['nombre2']; ?></td>
						    		<td><?php echo $row['apellido']; ?></td>
									<td><?php echo $row['apellido2']; ?></td>
						    		<td><?php echo $row['email']; ?></td>
									<td><?php echo $row['telefono']; ?></td>
									<td><?php echo $row['celular']; ?></td>
									<td><?php echo $row['direccion']; ?></td>
									<td><?php 
									$n=$row['idrol'];
									$con="SELECT rol.nombre from rol where idrol=$n";
									foreach($db->query($con) as $f){
									echo $f['nombre'];}?></td>
						    		<td>
						    			<a href="#edit_<?php echo $row['numerodocumento']; ?>" class="btn btn-success btn-sm" data-toggle="modal"><span class="fa fa-edit"></span> Matricular</a>
						    			
						    		</td>
						    		<?php include('edit_delete_modalmu.php'); ?>
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