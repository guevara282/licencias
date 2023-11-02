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
      <form action="rcursosporcategoria.php" method="post">
      <h2>Reporte cantidad de cursos por categoria</h2>
      <br><br>
        <form action="">
          <p>
          <label for="">Seleccione el tipo de vehiculo</label>
            <br>
            <select id = "id_deparatamento" class = "form-control" name = "id_deparatamento" required = "required">
								<option value = "">Selecciona un tipo de vehiculo</option>
								<?php
									$sql = $conexion->prepare("SELECT * FROM tipovehiculo");
									if($sql->execute()){
										$g_result = $sql->get_result();
									}
									while($row = $g_result->fetch_array()){
								?>
									<option value = "<?php echo $row['idtipovehiculo']?>"><?php echo utf8_encode($row['nombre'])?></option>
								<?php
								echo  $row['idtipovehiculo'];
								echo "hola"; 
										}
									$conexion->close();	
								?>
							</select>
          </p>
          <p>
          <label for="">Seleccione la categoria</label>
            <br>
           
							<select  id = "municipio" name = "municipio"  class = "form-control" disabled = "disabled" required = "required">



								<option value = "">Selecciona una categoria de conduccion</option>
							</select>
          </p>
        
          <p class="full-width">
          <br><br>
            <button>Generar</button>
            <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>  <br>  
          </p>
        </form>
      </div>
    </div>
  </div>



  <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

<script type = "text/javascript">
	$(document).ready(function(){
		$('#id_deparatamento').on('change', function(){
				if($('#id_deparatamento').val() == ""){
					$('#municipio').empty();
					$('<option value = "">Selecciona un municipiooooooooooo</option>').appendTo('#municipio');
					$('#municipio').attr('disabled', 'disabled');
				}else{
					$('#municipio').removeAttr('disabled', 'disabled');
					/* $('#municipio').load('municipio_get.php?id_deparatamento=' + $('#id_deparatamento').val());	 */
					$('#municipio').load('ajax.php?id_deparatamento=' + $('#id_deparatamento').val());	
					
									
				}	
				
		});	
			
	});	
	
</script>


  </html>
  