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

$consu="SELECT * from usuario where numerodocumento=$varse";
$r=mysqli_query($conexion, $consu);
$f=mysqli_fetch_array($r);

$consulta="SELECT * from empresa";
$resultado=mysqli_query($conexion, $consulta);
$nombre=mysqli_fetch_array($resultado);


$rol=$_SESSION['rol'];
$con="select * from permiso where idpermiso in (select idpermiso from permisorol where idrol='$rol' and estado='1') order by cast(idpermiso as decimal);";
$resul=mysqli_query($conexion,$con);



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

<DOCTYPE html>
    <html lang="es">

    <head>
        <title>Menu horizontal responsive</title>
        <meta chraset="UTF-8">
        <meta name="viewport"
            content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
        <link rel="stylesheet" href="est.css">
    </head>

    <body>
        <header>
            <input type="checkbox" id="btn-menu">
            <label for="btn-menu"><img src="imagen.png" alt=""></label>
            <nav class="menu">
                <ul>
                <li>
                 <p style="color:#ffffff; font-size:13pt; text-align:center; font-family:monospace">
               <?php 
                   
                   $cons="SELECT rol.nombre from rol where idrol=$rol";
                   $res=mysqli_query($conexion, $cons);
                    $c=mysqli_fetch_array($res);
                     echo $c['nombre'];
               ?>
              </p>
            <p style="color:#ffffff; font-size:11pt; text-align:center; font-family:monospace">
                   Bienvenido, <?php echo $f['nombre'] . " ". $f['apellido']?>
            </p>
            <p style="color:#ffffff; font-size:7pt; text-align:center; font-family:monospace">
            <?php echo "$nombre[nombre]"?>
            </p>
         </li>
                <?php
                while ($fila = mysqli_fetch_array($resul)){  ?>
                <li><a href=" <?php echo $fila['url'] ?> "> <?php echo $fila['nombre'] ?> </a>
                <ul>
                         <?php
                                $r=$fila['idpermiso'];
                                $n="SELECT * from permiso where fk_idpermiso='$r' and estado='1'";
                                $b=mysqli_query($conexion,$n);
                                    while ($submenu = mysqli_fetch_array($b)){ ?> 
                                       <li><a href="<?php echo $submenu['url'] ?>"><?php echo $submenu['nombre'] ?></a></li>
                                    <?php } ?>
                        </ul> 
                </li>
                <?php }
                  ?>
                </ul>
            </nav>
        </header>

        <main>
        <!-- <label for="btn-menu"><img src="imagen.jpg" alt=""></label> -->
        <center><a href="" > <img src ="i.png"> </a></center>
        </main>
    </body>

    </html>

    <?php 

    mysqli_free_result($consulta);
    mysqli_free_result($cons);
    mysqli_free_result($n);
    mysqli_close($conexion);

    ?>