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

$cons="SELECT rol.nombre from rol where idrol=$rol";
$res=mysqli_query($conexion, $cons);
$c=mysqli_fetch_array($res);
                     
$ctido="SELECT * from tipodocumento where estado='1'";
$ctd=mysqli_query($conexion,$ctido);

$fgt="SELECT * from tipodocumento where estado='0'";
$dtr=mysqli_query($conexion,$fgt);


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


<html>
<!-- <link href="estilo.css" rel="stylesheet" type="text/css"> -->
<link href="estilo.css" rel="stylesheet" type="text/css">


<header>
<center> 
    <form action="menuu.php" >
     <button class="s"><h2>Volver al inicio</h2></button>
    </form>
    </center>
</header>


<div class="contain">

    <div class="wrapper">
      <div class="contacts">
        <h3><?php echo $nombre['nombre'] ?></h3>
  
        <ul>
        <li><?php echo $c['nombre']?></li>
          <li><?php echo $f['nombre'] . " ". $f['apellido']?></li>
          <li><?php echo $f['numerodocumento'] ?> </li>
        </ul>
      </div>
  
      <form action="actualizar.php" method="post">
      <h2>Actualizar información personal</h2>
      <br><br>
        <form action="">
          <p>
            <label for="">Nombre 1</label>
            <input class="form-control" type="text" name="nombre" placeholder= "<?php echo $f['nombre']?>" >
          </p>
          <p>
            <label for="">Nombre 2</label>
            <input class="form-control" type="text" name="nombre2"  placeholder="<?php if(is_null($f['nombre2']) || empty($f['nombre2'])): {echo "vacío";}else:{echo $f['nombre2'];} endif?>">
          </p>
          <p>
            <label for="">Apellido 1</label>
            <input class="form-control" type="text" name="email"  placeholder="<?php echo $f['apellido']?>">
          </p>
          <p>
            <label for="">Apellido 2</label>
            <input class="form-control" type="text " name="apellido2"  placeholder="<?php if(is_null($f['apellido2']) || empty($f['apellido2'])): {echo "vacío";}else:{echo $f['apellido2'];} endif?>">
          </p>
          <p>
            <label for="">Email</label>
            <input class="form-control" type="text" name="email"  placeholder="<?php echo $f['email']?>">
          </p>
          <p>
            <label for="">Celular</label>
            <input class="form-control" type="text" name="celular"  placeholder="<?php if(is_null($f['celular']) || empty($f['celular'])): {echo "vacío";}else:{echo $f['celular'];} endif?>">
          </p>
          <p>
            <label for="">Telefono</label>
            <input class="form-control" type="text" name="telefono"  placeholder="<?php echo $f['telefono']?>">
          </p>
          <p>
            <label for="">Direccion</label>
            <input type="text" name="direccion" class="form-control" placeholder="<?php if(is_null($f['direccion']) || empty($f['direccion'])): {echo "vacío";}else:{echo $f['direccion'];} endif?>">
          </p>

          <p>
          
            <label for="">Tipo de documento</label>        
         <br>
            <select name="t" class="form-control" require>
            <option><?php 
            if(is_null($f['idtipodocumento']))
            {echo "Seleccione:";}else
            { 
              $tipd="select * from tipodocumento where idtipodocumento in (select idtipodocumento from usuario where numerodocumento=$varse)";
              $tdo=mysqli_query($conexion,$tipd);
              while($val=mysqli_fetch_array($tdo)){echo $val['nombre'];}}
            ?></option>
            <?php
            $q=mysqli_query($conexion, "SELECT * FROM tipodocumento");
            while ($valores = mysqli_fetch_array($q)) { ?>
            <option value="<?php echo $valores['idtipodocumento']; ?>"><?php echo $valores['nombre']; ?> </option> 
            <?php }
            ?>
            </select>
         
            
          </p>
          <p>
          <label for="">Sexo</label>
            <br>
            <select name="sexo" class="form-control" require>
            <option><?php 
            if(is_null($f['idgenero']))
            {echo "Seleccione:";}else
            { 
              $gen="select * from genero where idgenero in (select idgenero from usuario where numerodocumento=$varse)";
              $gene=mysqli_query($conexion,$gen);
              while($v=mysqli_fetch_array($gene)){echo $v['nombre'];}}
            ?></option>
            <?php 
            $q=mysqli_query($conexion, "SELECT * FROM genero");
            while ($valores = mysqli_fetch_array($q)) { ?>
            <option value="<?php echo $valores['idgenero']; ?>"><?php echo $valores['nombre']; ?> </option> 
            <?php }
            ?>
            </select>
          </p>
          <p>
          <label for="">Tipo de sangre</label>
            <br>
            <select name="idtiposangre" class="form-control" require>
            <option><?php if(is_null($f['idtiposangre']))
            {echo "Seleccione:";}else
            { 
              $tipsa="select * from tiposangre where idtiposangre in (select idtiposangre from usuario where numerodocumento=$varse)";
              $tsa=mysqli_query($conexion,$tipsa);
              while($val=mysqli_fetch_array($tsa)){echo $val['nombre'];}}?></option>
            <?php 
            $q=mysqli_query($conexion, "SELECT * FROM tiposangre");
            while ($valores = mysqli_fetch_array($q)) { ?>
            <option value="<?php echo $valores['idtiposangre']; ?>"><?php echo $valores['nombre']; ?> </option> 
            <?php }
            ?>
            </select>
          </p>
          <p>
          <label for="">Tipo de rh</label>
            <br>
            <select name="idrh" class="form-control" require>
            <option><?php if(is_null($f['idrh']))
            {echo "Seleccione:";}else
            { 
              $tiprh="select * from rh where idrh in (select idrh from usuario where numerodocumento=$varse)";
              $trh=mysqli_query($conexion,$tiprh);
              while($val=mysqli_fetch_array($trh)){echo $val['nombre'];}}?></option>
            <?php 
            $q=mysqli_query($conexion, "SELECT * FROM rh");
            while ($valores = mysqli_fetch_array($q)) { ?>
            <option value="<?php echo $valores['idrh']; ?>"><?php echo $valores['nombre']; ?> </option> 
            <?php }
            ?>
            </select>
          </p>
        
          <p class="full-width">
          <br><br>
            <button>Actualizar</button>
          </p>
        </form>
      </div>
    </div>
  </div>
  </html>
  <?php 

  mysqli_free_result($consu);
  mysqli_free_result($consulta);
  mysqli_free_result($cons);
  mysqli_free_result($ctido);
  mysqli_free_result($fgt);
  mysqli_close($conexion);
  
  ?>