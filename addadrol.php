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
		$firstname = $_POST['firstname'];

		if(isset($_GET['b'])){
			$b=$_GET['b'];
		}
		try{
			// hacer uso de una declaración preparada para evitar la inyección de sql
		/* 	insert into permisorol (idrol,idpermiso) values ($b,$firstname); */
/* 		$stmt = $db->prepare("INSERT INTO members (firstname, lastname, address) VALUES (:firstname, :lastname, :address)"); */
			$sql ="INSERT INTO permisorol (idrol, idpermiso) VALUES ($b, $firstname)";
			// declaración if-else en la ejecución de nuestra declaración preparada
			$_SESSION['message'] = ( $db->exec($sql) ) ? 'Los datos se actualizaron' : 'Ocurrio un error. No se pudo actualizar';

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

 	header('location: adminrol.php');

/*  echo "b es igual a ";
 echo $b;
 echo "-------------";

 echo "-----------";
 echo "firstanem es igual a ";
 echo $firstname;
 */
 


	
?>
