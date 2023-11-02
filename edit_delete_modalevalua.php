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
<div class="modal fade" id="edit_<?php echo $row['idevaluacion']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            	 <center><h4 class="modal-title" id="myModalLabel">Editar evaluación</h4></center>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
			<div class="container-fluid">
			<form method="POST" action="editevalua.php?id=<?php echo $row['idevaluacion']; ?>">
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
						<label class="control-label" style="position:relative; top:7px;">Pregunta 1:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="pregunta1" value="<?php echo $row['pregunta1']; ?>" >
					</div>
				</div>

				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Pregunta 2:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="pregunta2"   value="<?php echo $row['pregunta2']; ?>" >
					</div>
				</div>

				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Pregunta 3:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="pregunta3"   value="<?php echo $row['pregunta3']; ?>" >
					</div>
				</div>

				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Pregunta 4:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="pregunta4"  value="<?php echo $row['pregunta4']; ?>" >
					</div>
				</div>

				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Pregunta 5:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="pregunta5"  value="<?php echo $row['pregunta5']; ?>" >
					</div>
				</div>

				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Pregunta 6:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="pregunta6"  value="<?php echo $row['pregunta6']; ?>" >
					</div>
				</div>

				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Pregunta 7:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="pregunta7"  value="<?php echo $row['pregunta7']; ?>" >
					</div>
				</div>

				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Pregunta 8:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="pregunta8"  value="<?php echo $row['pregunta8']; ?>" >
					</div>
				</div>

				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Pregunta 9:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="pregunta9"  value="<?php echo $row['pregunta9']; ?>" >
					</div>
				</div>

				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Pregunta 10:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="pregunta10"  value="<?php echo $row['pregunta10']; ?>" >
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
<div class="modal fade" id="delete_<?php echo $row['idevaluacion']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            	<center><h4 class="modal-title" id="myModalLabel">Borrar evaluación</h4></center>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">	
            	<p class="text-center">¿Estas seguro en borrar los datos de?</p>
				<h2 class="text-center"><?php echo $row['nombre']; ?></h2>
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"></span> Cancelar</button>
                <a href="deleteevalua.php?id=<?php echo $row['idevaluacion']; ?>" class="btn btn-danger"><span class="fa fa-trash"></span> Si</a>
            </div>

        </div>
    </div>
</div>
