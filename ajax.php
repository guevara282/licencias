<?php

	include("final.php");
	$id_departamento=intval($_REQUEST['id_deparatamento']);
	$municipios = $conexion->prepare("SELECT * FROM categoria WHERE idtipovehiculo = '$id_departamento'") or die(mysqli_error());
		echo '<option value = "">Seleccione una categoria de conducción  </option>';
	if($municipios->execute()){
		$a_result = $municipios->get_result();
	}
		while($row = $a_result->fetch_array()){
			echo '<option value = "'.$row['idcategoria'].'">'.utf8_encode( $row['nombre']).'</option>';
			
		}

	
?>