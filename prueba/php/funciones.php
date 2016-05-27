<?php 
//funciones
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

function guardarEncuesta()
//obtencion de los inputs
{
	$cla = GetSQLValueString($_POST["txtclave"],"long");
	$nombre = GetSQLValueString($_POST["txtnombreencuesta"],"text");
	$pregunta1 = GetSQLValueString($_POST["txtpregunta1"],"text");
	$respuesta1 = GetSQLValueString($_POST["txtrespuesta1"],"text");
	$pregunta2 = GetSQLValueString($_POST["txtpregunta2"],"text");
	$respuesta2 = GetSQLValueString($_POST["txtrespuesta2"],"text");
	$pregunta3 = GetSQLValueString($_POST["txtpregunta3"],"text");
	$respuesta3 = GetSQLValueString($_POST["txtrespuesta3"],"text");
	$fecha = GetSQLValueString($_POST["txtfechaencuesta"],"text");
	$semestre = GetSQLValueString($_POST["txtsemestre"],"long");
	$respuesta = false;
	$conexion = mysql_connect("localhost","root","");
	mysql_select_db("progweb");
	$guarda = sprintf("insert into encuestas values(%d,%s,%s,%s,%s,%s,%s,%s,%s,%d)",$cla,$nombre,$pregunta1,$respuesta1,$pregunta2,
																					$respuesta2,$pregunta3,$respuesta3,$fecha,$semestre);
	$resultado = mysql_query($guarda);
	if(mysql_affected_rows()>0)
		$respuesta = true;
	$salidaJSON =  array('respuesta' => $respuesta );
	print json_encode($salidaJSON);
}

function bajaEncuesta()
{
 	$clave = GetSQLValueString($_POST["txtclave"],"long");
 	$respuesta = false;
 	$conexion = mysql_connect("localhost","root","");
	mysql_select_db("progweb");
	$baja = sprintf("delete from encuestas where clave=%d limit 1",$clave);
	mysql_query($baja);
	if(mysql_affected_rows()>0)
		$respuesta=true;
	$salidaJSON = array('respuesta' => $respuesta);
	print json_encode($salidaJSON);
}

function cambiaEncuesta()
{

$conexion = mysql_connect("localhost","root","");
	mysql_select_db("progweb");
$consultaBusqueda = ("");
}
function consultas()
{
	$respuesta = false;
	mysql_connect("localhost","root","");
	mysql_select_db("progweb");
		$consulta = "select * from encuestas";
		$resultado = mysql_query($consulta);
		$tabla = "";
		if(mysql_num_rows($resultado) > 0)
		{
			$respuesta = true;
			$tabla.="<tr>";
			$tabla.="<th>Clave</th>";
			$tabla.="<th>Nombre Encuesta</th>";	
			$tabla.="<th>Pregunta 1</th>";	
			$tabla.="<th>Respuesta 1</th>";
			$tabla.="<th>Pregunta 2</th>";	
			$tabla.="<th>Respuesta 2</th>";
			$tabla.="<th>Pregunta 3</th>";	
			$tabla.="<th>Respuesta 3</th>";
			$tabla.="<th>Fecha</th>";	
			$tabla.="<th>Semestre</th>";
			$tabla.="</tr>";

			while ($registro = mysql_fetch_array($resultado)){
				$tabla.="<tr>";
				$tabla.="<td>".$registro["txtclave"]."</td>";
				$tabla.="<td>".$registro["txtnombreencuesta"]."</td>";
				$tabla.="<td>".$registro["txtpregunta1"]."</td>";
				$tabla.="<td>".$registro["txtrespuesta2"]."</td>";
				$tabla.="<td>".$registro["txtpregunta2"]."</td>";
				$tabla.="<td>".$registro["txtrespuesta2"]."</td>";
				$tabla.="<td>".$registro["txtpregunta3"]."</td>";
				$tabla.="<td>".$registro["txtrespuesta3"]."</td>";
				$tabla.="<td>".$registro["txtfechaencuesta"]."</td>";
				$tabla.="<td>".$registro["txtsemestre"]."</td>";
				$tabla.="</tr>";
			}
		}
		$salidaJSON = array('respuesta' => $respuesta, 				   'tabla'     =>$tabla);
		print json_encode($salidaJSON);
}

$accion = $_POST["accion"];
//menu principal
switch ($accion) {
	case 'guardarEncuesta':
		guardarEncuesta();
		break;
	case 'bajaEncuesta':
		bajaEncuesta();
		break;
	case 'cambiaEncuesta':
		cambiaEncuesta();
		break;
	case 'consultas':
		consultas();
		break;
	default:
		# code...
		break; 
	}
?>