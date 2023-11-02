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
/*
| -----------------------------------------------------
| PROYECTO: 		PHP CRUD usando PDO y Bootstrap
| -----------------------------------------------------
| AUTOR:			AnthonCode
| -----------------------------------------------------
| FACEBOOK:			FACEBOOK.COM/ANTHONCODE
| -----------------------------------------------------
| COPYRIGHT:		AnthonCode
| -----------------------------------------------------
| WEBSITE:			http://4avisos.com - anthoncode.blogspot.com
| -----------------------------------------------------
*/
	session_start();
	include_once('connection.php');

	if(isset($_POST['edit'])){
		$database = new Connection();
		$db = $database->open();
		try{
			$id = $_GET['id'];
			$firstname = $_POST['firstname'];
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
			
		
			/* $sql = "UPDATE evaluacion SET nombre = '$firstname', pregunta1 ='$pregunta1' WHERE idevaluacion = '$id'"; */
			$sql = "UPDATE evaluacion SET nombre = '$firstname', pregunta1 ='$pregunta1', pregunta2 ='$pregunta2', pregunta3 ='$pregunta3', pregunta4 ='$pregunta4', pregunta5 ='$pregunta5', pregunta6 ='$pregunta6' , pregunta7 ='$pregunta7' , pregunta8 ='$pregunta8', pregunta9 ='$pregunta9', pregunta10 ='$pregunta10'      WHERE idevaluacion = '$id'";
			// declaración if-else en la ejecución de nuestra consulta
			$_SESSION['message'] = ( $db->exec($sql) ) ? 'Los datos se actualizaron' : 'Ocurrio un error. No se pudo actualizar';

		}
		catch(PDOException $e){
			$_SESSION['message'] = $e->getMessage();
		}

		//cerrar conexión 
		$database->close();
	}
	else{
		$_SESSION['message'] = 'Primero debe llenar el form';
	}

	header('location: evaluacion.php');

?>