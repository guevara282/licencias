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
<div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            	<center><h4 class="modal-title" id="myModalLabel">Agregar archivo</h4></center>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
                
            </div>
            <div class="modal-body">
			<div class="container-fluid">
			<form method="POST" action="addarcfinan.php">
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Nombre archivo:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="firstname" required>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Categoria:</label>
					</div>
					<div class="col-sm-10">
					<select name="idarchivo" class="form-control" required>
            <?php 
            $sql="SELECT * FROM tipoarchivo where rol='3' or rol='0'";
            foreach ($db->query($sql) as $valores) { ?>
            <option value="<?php echo $valores['idtipoarchivo']; ?>"><?php echo $valores['nombre']; ?> </option> 
            <?php }
            ?>
            </select>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label" style="position:relative; top:7px;">Archivo:</label>
					</div>
					<div class="col-sm-10">
					<input type="file" class="form-control"  name="archivo" required>
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
