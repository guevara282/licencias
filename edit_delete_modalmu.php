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
<div class="modal fade" id="edit_<?php echo $row['numerodocumento']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            	 <center><h4 class="modal-title" id="myModalLabel">Matricular usuario</h4></center>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
			<div class="container-fluid">
			<form method="POST" action="editmu.php?id=<?php echo $row['numerodocumento']; ?>">
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:12px;">Curso</label>
					</div>
					<div class="col-sm-10">
					<select name="curso" class="form-control">
			<?php 
			$sql="SELECT * FROM curso where estado='1'";
            /* $q=mysqli_query($connection, "SELECT * FROM tiposangre"); */
            foreach ($db->query($sql) as $valores) { ?>
            <option value="<?php echo $valores['idcurso']; ?>"><?php echo $valores['nombre']; ?> </option> 
            <?php }
            ?>
            </select>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<!-- <label class="control-label" style="position:relative; top:7px;">Apellido:</label> -->
					</div>
					<div class="col-sm-10">
						
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<!-- <label class="control-label" style="position:relative; top:7px;">Dirección:</label> -->
					</div>
					<div class="col-sm-10">
						
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
<div class="modal fade" id="delete_<?php echo $row['numerodocumento']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            	<center><h4 class="modal-title" id="myModalLabel">Borrar miembro</h4></center>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">	
            	<p class="text-center">¿Estas seguro en borrar los datos de?</p>
				<h2 class="text-center"><?php echo $row['nombre'].' '.$row['apellido']; ?></h2>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"></span> Cancelar</button>
                <a href="delete.php?id=<?php echo $row['numerodocumento']; ?>" class="btn btn-danger"><span class="fa fa-trash"></span> Si</a>
            </div>

        </div>
    </div>
</div>
