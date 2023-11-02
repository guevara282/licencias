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

$fechai=$_POST['fi'];
$fechaf=$_POST['ff'];

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
    $this->Cell(40, 10, 'Fecha: '.date('d-m-Y').'', 0);
    $this->Ln(5);
    $this->Cell(15, 8, '', 0);
    $this->Cell(70,10, 'Nit:  '.$GLOBALS['nit'],0,0,'C');
    $this->Ln(5);
    $this->Cell(30, 8, '', 0);
    $this->Cell(70,10, 'Direccion:  '.$GLOBALS['dir'],0,0,'C');
    $this->Ln(20);
}

function Footer()
{
    $this->SetY(-15);
    $this->SetFont('Arial','I',10);
    $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
}
}

$consulta="select (select count(*) as Aprobados from cursousuario where fechamatricula between CAST('$fechai' as date) and CAST('$fechaf' as date) and nota>=3) as Aprobados , (select count(*) as Aprobados from cursousuario where fechamatricula between CAST('$fechai' as date) and CAST('$fechaf' as date) and nota<3) as Reprobados;";						

$resultado=mysqli_query($conexion, $consulta);

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf -> Ln(20);
$pdf -> SetFont('Arial', 'B', 15);
$pdf -> Cell(4, 8, '', 0);
$pdf -> Cell(30, 15, utf8_decode('NO. APRENDICES APROBADOS Y REPROBADOS POR RANGO DE FECHA'), 0);
$pdf -> Ln(8);
$pdf -> Ln(25);
$pdf -> SetFont('Arial', 'B', '12');
/* $pdf -> Cell(80, 8, '', 0, 0, 'C', 0); */
$pdf -> Cell(120, 8, 'Aprobados', 0, 0, 'C', 0);
$pdf -> Cell(30, 8, 'Reprobados', 0, 0, 'C', 0);
/* $pdf -> Cell(265, 8, 'Total de aprendices', 0, 0, 'C', 0); */
$pdf -> Ln(15);
$pdf -> SetFont('Arial', '', 8);

$item=0;
$totalap=0;
$totalep=0;
while($row=mysqli_fetch_array($resultado)){

    $pdf -> SetFont('Arial', '', 10);
    $pdf -> Cell(120, 8, $row['Aprobados'], 0, 0, 'C', 0);
    $pdf -> Cell(30, 8, $row['Reprobados'], 0, 0, 'C', 0);
   /*  $pdf -> Cell(270, 8, $row['Total_Aprendices_Matriculados'], 0, 0, 'C', 0); */
    $pdf -> Ln(8);
}
$pdf -> Ln(30);
$pdf -> SetFont('Arial', 'B', 9);
$pdf -> Cell(60, 8, 'RANGO DE FECHA', 0, 0, 'C', 0);
$pdf -> Cell(80, 8, 'Desde:   '.$fechai, 0, 0, 'C', 0);
$pdf -> Cell(30, 8, 'Hasta:   '.$fechaf, 0, 0, 'C', 0);
$pdf -> Ln(30);
$pdf -> SetFont('Arial', 'B', 11);
$pdf -> Cell(85, 8, '', 0 );
$pdf -> Cell(85, 8, 'Generado por: '.$GLOBALS['nn'].' '.$GLOBALS['aa']. ' '.'('.$GLOBALS['nom'].')', 0 );
$pdf->Output();
?>