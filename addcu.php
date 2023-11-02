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

	session_start();
	include_once('connection.php');

	if(isset($_POST['add'])){
		$database = new Connection();
		$db = $database->open();
		/* $ca=$_POST['municipio']; */
		try{
			// hacer uso de una declaración preparada para evitar la inyección de sql
			$stmt = $db->prepare("INSERT INTO curso (nombre, idcategoria, idsalon, fechainicio, fechafin, horainicio, horafin, idprofesor,estado) VALUES (:firstname, :municipio, :salon, :fechainicio, :fechafin, :horainicio, :horafin, :prof, '1')");
			// declaración if-else en la ejecución de nuestra declaración preparada
			$_SESSION['message'] = ( $stmt->execute(array(':firstname' => $_POST['firstname'] , ':municipio' => $_POST['municipio'], ':salon' => $_POST['salon'], ':fechainicio' => $_POST['fechainicio'], ':fechafin' => $_POST['fechafin'], ':horainicio' => $_POST['horainicio'], ':horafin' => $_POST['horafin'], ':prof' => $_POST['prof'])) ) ? 'Miembro agregado correctamente' : 'Something went wrong. Cannot add member';	
	    
		}
		catch(PDOException $e){
			$_SESSION['message'] = $e->getMessage();
		}

		//cerrar conexión
		$database->close();
	}

	else{
		$_SESSION['message'] = 'Fill up add form first';
	}

	header('location: agcurso.php');

	/* if(isset($_POST['municipio']))
	$ca=$_POST['municipio'];
	echo "hola"; */

?>
