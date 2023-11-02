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

if(isset($_POST['idtiposangre'])){
    $gene=$_POST['idtiposangre'];
}else{
    $gene=18;
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
    $this->Cell(40, 10, 'Fecha: '.date('d-m-Y').'', 0);
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

$consulta="SELECT concat(usuario.nombre,'', usuario.apellido) as APRENDIZ, usuario.fecha AS Fecharegistro, tipodocumento.nombre as Tipodocumento, genero.nombre, curso.nombre as CURSO, cursousuario.fechamatricula as FechaMatricula  from usuario inner join cursousuario on usuario.numerodocumento=cursousuario.numerodocumento inner join tipodocumento on usuario.idtipodocumento =tipodocumento.idtipodocumento inner join genero on usuario.idgenero = genero.idgenero inner join curso on cursousuario.idcurso = curso.idcurso where idrol=1 and usuario.idgenero=$gene";
$resultado=mysqli_query($conexion, $consulta);


$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf -> Ln(20);
$pdf -> SetFont('Arial', 'B', 15);
$pdf -> Cell(25, 8, '', 0);
$pdf -> Cell(40, 15, utf8_decode('APRENDICES MATRICULADOS EN CURSOS POR GENERO'), 0);
$pdf -> Ln(8);
$pdf -> Ln(15);
$pdf -> SetFont('Arial', 'B', '12');
$pdf -> Cell(16, 8, 'Aprendiz', 0, 0, 'C', 0);
$pdf -> Cell(35, 8, 'F. Registro', 0, 0, 'C', 0);
$pdf -> Cell(45, 8, 'Documento', 0, 0, 'C', 0);
$pdf -> Cell(35, 8, 'Genero', 0, 0, 'C', 0);
$pdf -> Cell(30, 8, 'Curso', 0, 0, 'C', 0);
$pdf -> Cell(30, 8, 'F. Matricula', 0, 0, 'C', 0);
$pdf -> Ln(8);
$pdf -> SetFont('Arial', '', 8);

$item=0;
while($row=mysqli_fetch_array($resultado)){
    $item=$item+1;
    /* $totalap=$totalap+$row['CantidadCursos']; */
    $pdf -> SetFont('Arial', '', 10);
    $pdf -> Cell(16, 8, $row['APRENDIZ'], 0, 0, 'C', 0);
    $pdf -> Cell(35, 8, $row['Fecharegistro'], 0, 0, 'C', 0);
    $pdf -> Cell(45, 8, $row['Tipodocumento'], 0, 0, 'C', 0);
    $pdf -> Cell(35, 8, $row['nombre'], 0, 0, 'C', 0);
    $pdf -> Cell(30, 8, $row['CURSO'],0, 0, 'C', 0);
    $pdf -> Cell(30, 8, $row['FechaMatricula'],0, 0, 'C', 0);
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