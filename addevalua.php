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
	/* 	$municipio =$_POST['municipio']; */
		$firstname =$_POST['firstname'];
		$municipio=$_POST['municipio'];
		$pregunta1=$_POST['pregunta1'];
		$pregunta2=$_POST['pregunta2'];
		$pregunta3=$_POST['pregunta3'];
		$pregunta4=$_POST['pregunta4'];
		$pregunta5=$_POST['pregunta5'];
		$pregunta6=$_POST['pregunta6'];
		$pregunta7=$_POST['pregunta7'];
		$pregunta8=$_POST['pregunta8'];
		$pregunta9=$_POST['pregunta9'];
		$pregunta10=$_POST['pregunta10'];
		try{
			// hacer uso de una declaración preparada para evitar la inyección de sql
			/* $stmt = $db->prepare("INSERT INTO rol (nombre) VALUES (:firstname)"); */
		 	/* $sql = "insert into evaluacion (nombre,pregunta1,pregunta2,pregunta3,pregunta4,pregunta5,pregunta6,pregunta7,pregunta8,pregunta9,pregunta10,categoria) values ('$firstname','$pregunta1','$pregunta2','$pregunta3','$pregunta4','$pregunta5','$pregunta6','$pregunta7','$pregunta8','$pregunta9','$pregunta10',$municipio)"; */
			 	// declaración if-else en la ejecución de nuestra consulta

	 $sql = "INSERT INTO evaluacion (nombre,pregunta1,pregunta2,pregunta3,pregunta4,pregunta5,pregunta6,pregunta7,pregunta8,pregunta9,pregunta10,categoria) values ('$firstname','$pregunta1','$pregunta2','$pregunta3','$pregunta4','$pregunta5','$pregunta6','$pregunta7','$pregunta8','$pregunta9','$pregunta10',$municipio)"; 

	 			$_SESSION['message'] = ( $db->exec($sql) ) ? 'Evaluacion agregada correctamente' : 'Ocurrió un error. No se pudo eliminar al miembro';
		
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

	header('location: evaluacion.php');
	
?>
