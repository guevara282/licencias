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
<!-- Agregar Nuevo -->
<div class="modal fade" id="addnew_<?php if(isset($b)){ echo $b;} ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            	<center><h4 class="modal-title" id="myModalLabel">Agregar miembro</h4></center>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
                
            </div>
            <div class="modal-body">
			<div class="container-fluid">
			<form method="POST" action="addadrol.php?b=<?php if(isset($b)){ echo $b;} ?>">
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Permisos Disponibles:</label>
					</div>
					<div class="col-sm-10">
						
					<select class="form-control mr-sm-2" name="firstname" >
		 

			<?php 
			$sql="SELECT * FROM permiso";
              foreach ($db->query($sql) as $valores) { ?>
            <option value="<?php echo $valores['idpermiso']; ?>"><?php echo $valores['nombre']; ?> </option> 
            <?php }
            ?>
            </select>
						
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
			
					</div>
					<div class="col-sm-10">
				
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						
					</div>
					<div class="col-sm-10">
					
					</div>
				</div>
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
