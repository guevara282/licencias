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

<?php 
include("final.php");
?>
<!-- Agregar Nuevo -->
<div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            	<center><h4 class="modal-title" id="myModalLabel">Crear evaluación</h4></center>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
                
            </div>
            <div class="modal-body">
			<div class="container-fluid">
			<form method="POST" action="addevalua.php">
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Nombre:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="firstname" required="required">
					</div>
				</div>




				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Tipo de vehiculo:</label>
					</div>
					<div class="col-sm-10">
				
					<select id = "id_deparatamento" class = "form-control" name = "id_deparatamento" required = "required">
								<option value = "">Seleccione un tipo de vehiculo</option>
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


					</div>
				</div>

				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Categoria:</label>
					</div>
					<div class="col-sm-10">
					
					<select  id = "municipio" name = "municipio"  class = "form-control" disabled = "disabled" required = "required">



								<option value = "">Seleccione un categoria</option>
							</select>

					</div>
				</div>




				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Pregunta 1:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="pregunta1" required="required">
					</div>
				</div>

				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Pregunta 2:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="pregunta2" required="required">
					</div>
				</div>

				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Pregunta 3:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="pregunta3" required="required">
					</div>
				</div>

				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Pregunta 4:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="pregunta4" required="required">
					</div>
				</div>

				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Pregunta 5:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="pregunta5" required="required">
					</div>
				</div>

				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Pregunta 6:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="pregunta6" required="required">
					</div>
				</div>

				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Pregunta 7:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="pregunta7" required="required">
					</div>
				</div>

				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Pregunta 8:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="pregunta8" required="required">
					</div>
				</div>

				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Pregunta 9:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="pregunta9" required="required">
					</div>
				</div>

				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Pregunta 10:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="pregunta10" required="required">
					</div>
				</div>


				
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"></span> Cancelar</button>
                <button type="submit" name="add" class="btn btn-primary"><span class="fa fa-save"></span> Guardar</a>
			</form>
            </div>

        </div>
    </div>
</div>


<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<!-- <script src = "js/jquery-3.1.1.js"></script> -->
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