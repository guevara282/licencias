<?php

require('fpdf/fpdf.php');
/* require('final.php'); */

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

$coni="SELECT * from empresa";
$resultado=mysqli_query($conexion, $coni);
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

$name=$nombre['nombre'];
$nit=$nombre['nit'];
$dir=$nombre['direccion'];
$nn=$f['nombre'];
$aa=$f['apellido'];
$nom=$c['nombre'];


 if (time() - $var >10000) {  
  echo '<script>
    alert("Ha estado inactivo");
    window.location.href="login.php";
      </script>';
    session_destroy();

  die();  
}
$_SESSION['tiempo']=time(); 

if(isset($_POST['id_departamento'])){
    $tv=$_POST['id_departamento'];
}else{
    $tv=18;
}

if(isset($_POST['municipio'])){
    $mn=$_POST['municipio'];
}else{
    $mn=18;
}

class PDF extends FPDF
{

function Header()
{
    $this->Image('imagen.jpg',8,2,35,40,'JPG');
    $this->SetFont('Times','B',14);
    $this->Cell(20);
    $this->Cell(90,10, $GLOBALS['name'],0,0,'C');
    $this->Cell(30);
    date_default_timezone_set('America/Bogota');
    $this->Cell(25, 10, 'Fecha: '.date('d-m-Y').'', 0);
    $this->Ln(5);
    $this->Cell(15, 8, '', 0);
    $this->Cell(70,10, 'Nit:  '.$GLOBALS['nit'],0,0,'C');
    $this->Ln(5);
    $this->Cell(30, 8, '', 0);
    $this->Cell(70,10, 'Direccion:  '.$GLOBALS['dir'],0,0,'C');
    $this->Cell(40, 8, '', 0);
    $this->Cell(800, 6,'Hora:  '.date('g:i:s a').'',0);
    $this->Ln(20);
}

function Footer()
{
    $this->SetY(-15);
    $this->SetFont('Arial','I',10);
    $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
}
}

/* $consulta="select idcategoria as id, nombre as NombreCategoria, (select count(*) from curso where idcategoria=id) as CantidadCursos from categoria where idcategoria=$mn"; */					

$consulta="select curso.nombre as nombre,curso.fechainicio as fechai, curso.fechafin as fechaf, curso.horainicio as horainicio, curso.horafin as horafin, concat(usuario.nombre,' ', usuario.apellido) as instructor  from categoria inner join curso on categoria.idcategoria=curso.idcategoria inner join usuario on curso.idprofesor=usuario.numerodocumento inner join tipovehiculo on categoria.idtipovehiculo = tipovehiculo.idtipovehiculo where categoria.idcategoria=18";
$resultado=mysqli_query($conexion, $consulta);


$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf -> Ln(20);
$pdf -> SetFont('Arial', 'B', 15);
$pdf -> Cell(40, 8, '', 0);
$pdf -> Cell(50, 15, utf8_decode('CANTIDAD DE CURSOS POR CATEGORÍA'), 0);
$pdf -> Ln(8);
$pdf -> Ln(15);
$pdf -> SetFont('Arial', 'B', '12');
$pdf -> Cell(11, 8, 'No.', 0, 0, 'C', 0);
$pdf -> Cell(30, 8, 'Nombre curso', 0, 0, 'C', 0);
$pdf -> Cell(35, 8, 'Fecha inicio', 0, 0, 'C', 0);
$pdf -> Cell(20, 8, 'Fecha fin', 0, 0, 'C', 0);
$pdf -> Cell(30, 8, 'Hora inicio', 0, 0, 'C', 0);
$pdf -> Cell(30, 8, 'Hora final', 0, 0, 'C', 0);
$pdf -> Cell(30, 8, 'Instructor', 0, 0, 'C', 0);
$pdf -> Ln(8);
$pdf -> SetFont('Arial', '', 8);

$item=0;
while($row=mysqli_fetch_array($resultado)){
    $item=$item+1;
    /* $totalap=$totalap+$row['CantidadCursos']; */
    $pdf -> SetFont('Arial', '', 10);
    $pdf -> Cell(11, 8, $item, 0, 0, 'C', 0);
    $pdf -> Cell(30, 8, $row['nombre'], 0, 0, 'C', 0);
    $pdf -> Cell(35, 8, $row['fechai'], 0, 0, 'C', 0);
    $pdf -> Cell(20, 8, $row['fechaf'], 0, 0, 'C', 0);
    $pdf -> Cell(30, 8, $row['horainicio'],0, 0, 'C', 0);
    $pdf -> Cell(30, 8, $row['horafin'],0, 0, 'C', 0);
    $pdf -> Cell(30, 8, $row['instructor'],0, 0, 'C', 0);
    $pdf -> Ln(8);
}
$pdf -> Ln(10);
$pdf -> SetFont('Arial', 'B', 12);
$pdf -> Cell('133', 8, '', 0 );
$pdf -> Cell(160, 8, 'Total cursos:        '.$item, 0);
$pdf -> Ln(30);
$pdf -> Cell(85, 8, '', 0 );
$pdf -> Cell(85, 8, 'Generado por: '.$GLOBALS['nn'].' '.$GLOBALS['aa']. ' '.'('.$GLOBALS['nom'].')', 0 );
$pdf->Output();

echo 'Holaaaa';

?>