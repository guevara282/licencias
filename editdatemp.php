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
			$direccion = $_POST['direccion'];
			$telefono = $_POST['telefono'];
			$mision = $_POST['mision'];
			$vision = $_POST['vision'];
		
			$sql = "UPDATE empresa SET nombre = '$firstname', direccion='$direccion', telefono='$telefono',mision='$mision',vision='$vision' WHERE nit = '$id'";
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

	header('location: datosempresa.php');

?>