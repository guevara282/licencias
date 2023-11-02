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
            	<center><h4 class="modal-title" id="myModalLabel">Agregar curso</h4></center>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
                
            </div>
            <div class="modal-body">
			<div class="container-fluid">
			<form method="POST" action="addcu.php">
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
						<label class="control-label" style="position:relative; top:7px;">Salón:</label>
					</div>
					<div class="col-sm-10">
					<select name="salon" class="form-control" required="required">
					<option value = "">Seleccione un salón</option>
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
			<input type="date" class="form-control" name="fechainicio" required="required">
					</div>
				</div>

				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">fecha fin:</label>
					</div>
					<div class="col-sm-10">

					<input type="date" class="form-control" name="fechafin" required="required">
					</div>
				</div>


				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Hora inicio:</label>
					</div>
					<div class="col-sm-10">
					<input type="time"  class="form-control" name="horainicio" required="required">
					</div>
				</div>
				
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Hora fin:</label>
					</div>
					<div class="col-sm-10">
					<input type="time"  class="form-control" name="horafin" required="required">
					</div>
				</div>

				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Profesor:</label>
					</div>
					<div class="col-sm-10">
					<select name="prof" class="form-control" required="required">
					<option value = "">Seleccione un instructor</option>
            <?php 
            $sql="SELECT * FROM usuario where idrol='2'";
        
            foreach ($db->query($sql) as $v) { ?>
            <option value="<?php echo $v['numerodocumento']; ?>"><?php echo $v['nombre']." ".  $v['apellido']; ?> </option> 
            <?php }
            ?>
            </select>
					</div>
				</div>

		<!-- 		<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Salon:</label>
					</div>
					<div class="col-sm-10">
					<input type="time"  class="form-control" name="horafin">
					</div>
				</div>
 -->
				

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
					$('#municipio').load('municipio_get.php?id_deparatamento=' + $('#id_deparatamento').val());	
					
									
				}	
				
		});	
			
	});	
	
</script>
