<?php
session_start();
ob_start();
if (!isset($_SESSION['sesion_cedula'])){
	header("location:error1.php");
	return;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>LivitaSport::Estadisticas</title>
<LINK REL="SHORTCUT ICON" HREF="http://localhost/reserv/images/favicon.ico">

<style type="text/css">

<!--

/* Gradient 2 */
.tb7 {
	width: 221px;
	background: transparent url('images/bg.jpg') no-repeat;
	color : #747862;
	height:20px;
	border:0;
	padding:4px 8px;
	margin-bottom:0px;
}
.fb7 {
    background: #EBE3CD no-repeat 5px center;
    vertical-align:middle; 
    border: 1px solid #969184;
}
.Estilo7 {color: #FFFFFF; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }




body {
	background-color: #D6EDF2;
	background-image: url(images/atomos_web_ok.png);
}
.Estilo11 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }
.Estilo12 {font-size: 12px}
.Estilo13 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
.Estilo14 {color: #FFFFFF}
-->
</style>

</head>


<body>

<p>&nbsp;</p>
<table width="934" border="0" align="center" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
  
  <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
    <td width="687" bordercolor="#FFFFFF" bgcolor="#FFFFFF">&nbsp;</td>
    <td width="429" height="21">&nbsp;</td>
  </tr>
  <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
    <td colspan="2"><table width="908" border="0" align="center">
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2"><?php
// archivos incluidos. Librer&iacute;as PHP para poder graficar.
include "FusionCharts.php";
include "Functions.php";
// Gr&aacute;fico de Barras. 4 Variables, 4 barras.
// Estas variables ser&aacute;n usadas para representar los valores de cada unas de las 4 barras.
// Inicializo las variables a utilizar.

require_once('dbconnect.php');
	
	$conn = new MySQLConn();
	$conn->connect();
	
	/*$anoss = $_REQUEST['ano'];
	$mess = $_REQUEST['mes'];
	$mes1 = $anoss."/".$mess;
	
	$anoss1 = $_REQUEST['ano1'];
	$mess1 = $_REQUEST['mes1'];
	$mes2 = $anoss1."/".$mess1;

	
	$fechaproy1=$anoss."/".$mess."/"."1";
	$fechaproy2=$anoss."/".$mess."/"."2";
	
	$fechaproy1ini=$anoss1."/".$mess1."/"."1";
	$fechaproy1fin=$anoss1."/".$mess1."/"."31";		

	$fechaproy2ini=$anoss."/".$mess."/"."1";
	$fechaproy2fin=$anoss."/".$mess."/"."31";*/

	
	$sql="SELECT COUNT(provinciab) FROM bibliotecario WHERE provinciab = 'Imbabura';";
	$conn->sqlQuery($sql);
	$filas1 = $conn->rows[0];
	
	$sql1="SELECT COUNT(provinciab) FROM bibliotecario WHERE provinciab = 'Pichincha';";
	$conn->sqlQuery($sql1);
	$filas2 = $conn->rows[0];
	
	$sql2="SELECT COUNT(provinciab) FROM bibliotecario WHERE provinciab = 'Carchi';";
	$conn->sqlQuery($sql2);
	$filas3 = $conn->rows[0];
	
	$intTotalAnio1 = $filas1;
	$intTotalAnio2 = $filas2;
	$intTotalAnio3 = $filas3;
// $strXML: Para concatenar los par&aacute;metros finales para el gr&aacute;fico.
$strXML = "";
// Armo los par&aacute;metros para el gr&aacute;fico. Todos estos datos se concatenan en una variable.
// Encabezado de la variable XML. Comienza con la etiqueta "Chart".
// caption: define el t&iacute;tulo del gr&aacute;fico.
// bgColor: define el color de fondo que tendr&aacute; el gr&aacute;fico.
// baseFontSize: Tama&ntilde;o de la fuente que se usar&aacute; en el gr&aacute;fico.
// showValues: = 1 indica que se mostrar&aacute;n los valores de cada barra. = 0 No mostrar&aacute; los valores en el gr&aacute;fico.
// xAxisName: define el texto que ir&aacute; sobre el eje X. Abajo del gr&aacute;fico. Tambi&eacute;n est&aacute; xAxisName.
$strXML = "<chart caption = 'Grafico Estadistico de los bibliotecarios por provincia' bgColor='#FFFFFF' baseFontSize='12' showValues='1' xAxisName='GENERO' >";
// Armado de cada barra.
// set label: asigno el nombre de cada barra.
// value: asigno el valor para cada barra.
// color: color que tendr&aacute; cada barra. Si no lo defino, tomar&aacute; colores por defecto.
$strXML .= "<set label = 'Imbabura' value ='".$intTotalAnio1."' color = 'FF66FF' />";
$strXML .= "<set label = 'Pichincha' value ='".$intTotalAnio2."' color = '0000FF' />";
$strXML .= "<set label = 'Carchi' value ='".$intTotalAnio3."' color = 'FDF207' />";
// Cerramos la etiqueta "chart".
$strXML .= "</chart>";
echo renderChartHTML("Column3D.swf", "",$strXML, "ejemplo", 600, 400, false);
?></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td width="136">&nbsp;</td>
        <td width="367">
          <p><span class="Estilo11 Estilo12"><span class="Estilo14">.........................................</span></span></p>          </td>
        <td width="286">&nbsp;</td>
        <td width="101">&nbsp;</td>
      </tr>
    </table>    </td>
  </tr>
  <tr>
    <td height="28" colspan="2"><div align="center"><span class="Estilo7">Copyright 2015 LivitaSport</span></div></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
