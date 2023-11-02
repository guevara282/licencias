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
<!-- Editar -->
<div class="modal fade" id="edit_<?php echo $row['idcurso']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            	 <center><h4 class="modal-title" id="myModalLabel">Editar curso</h4></center>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
			<div class="container-fluid">
			<form method="POST" action="editcu.php?id=<?php echo $row['idcurso']; ?>">
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Nombre:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="firstname" value="<?php echo $row['nombre']; ?>">
					</div>
				</div>


			

				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;" require>Salón:</label>
					</div>
					<div class="col-sm-10">
					<select name="salon" class="form-control">
					<option><?php 
					$sa=$row['idsalon'];
					$salon="select * from salon where idsalon in(select idsalon from curso where idsalon=$sa and estado ='1')";
					foreach($db->query($salon) as $sal){
						echo $sal['nombre'];
					   }
					
					
					?></option>
            <?php 
            $sql="SELECT * FROM salon";
        
            foreach ($db->query($sql) as $valores) { ?>
            <option value="<?php echo $valores['idsalon']; ?>"><?php echo $valores['nombre']; ?> </option> 
            <?php }
            ?>
            </select>
					</div>
				</div>

				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">fecha inicio:</label>
					</div>
					<div class="col-sm-10">

					<input type="date" class="form-control" name="fechainicio" value="<?php echo $row['fechainicio']; ?>" required>
					</div>
				</div>

				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">fecha fin:</label>
					</div>
					<div class="col-sm-10">

					<input type="date" class="form-control" name="fechafin" value="<?php echo $row['fechafin']; ?>"  required>
					</div>
				</div>

						<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Hora inicio:</label>
					</div>
					<div class="col-sm-10">
					<input type="time"  class="form-control" name="horainicio" value="<?php echo $row['horainicio']; ?>"  required>
					</div>
				</div>

				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Hora fin:</label>
					</div>
					<div class="col-sm-10">
					<input type="time"  class="form-control" name="horafin" value="<?php echo $row['horafin']; ?>" required>
					</div>
				</div>

				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Profesor:</label>
					</div>
					<div class="col-sm-10">
					<select name="prof" class="form-control">
					<!-- <option> --><?php 
					$p= $row['idprofesor'];
					$pro="select * from usuario where numerodocumento in (select idprofesor from curso where idprofesor=$p and estado ='1')";
					foreach($db->query($pro) as $profe){
						echo $profe['nombre']. " ". $profe['nombre2']. " ". $profe['apellido']. " ". $profe['apellido2'];
					   }
					
					
					?><!-- </option> -->
            <?php 
            $sql="SELECT * FROM usuario where idrol='2'";
        
            foreach ($db->query($sql) as $v) { ?>
            <option value="<?php echo $v['numerodocumento']; ?>"><?php echo $v['nombre']." ".  $v['apellido']; ?> </option> 
            <?php }
            ?>
            </select>
					</div>
				</div>


				
            </div> 
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"></span> Cancelar</button>
                <button type="submit" name="edit" class="btn btn-success"><span class="fa fa-check"></span> Actualizar</a>
			</form>
            </div>

        </div>
    </div>
</div>

<!-- Eliminar -->
<div class="modal fade" id="delete_<?php echo $row['idcurso']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            	<center><h4 class="modal-title" id="myModalLabel">Borrar curso</h4></center>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">	
            	<p class="text-center">¿Estas seguro en borrar los datos de?</p>
				<h2 class="text-center"><?php echo $row['nombre']?></h2>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"></span> Cancelar</button>
                <a href="deletecu.php?id=<?php echo $row['idcurso']; ?>" class="btn btn-danger"><span class="fa fa-trash"></span> Si</a>
            </div>

        </div>
    </div>
</div>



