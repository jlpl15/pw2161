<?php 
//funciones
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";// ? y : son como if y else
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
function validaEntrada()
{
	$usuario = GetSQLValueString($_POST["usuario"],"text");
	$clave   = GetSQLValueString(md5($_POST["clave"]),"text");
	$respuesta = false;
	//conecto al servidor de BD
	$conexion = mysql_connect("localhost","root","");//servidor,usuario y clave
	//seleccionar base de datos
	mysql_select_db("cursopw");
	$validar = sprintf("select usuario,clave from usuarios where usuario=%s and clave=%s limit 1",$usuario,$clave);
	//para que te encuentre el primero y deje de buscar
	//sprintf es
	$resultado = mysql_query($validar);
	//preguntamos si se trajo un registro
	if(mysql_num_rows($resultado) >0 )
		$respuesta = true;
	$salidaJson = array('respuesta' => $respuesta );
	//devolvemos el resultado al JS
	print json_encode($salidaJson);
}
$accion = $_POST["accion"]
//menu principal
switch ($accion) {
	case 'validaEntrada':
		validaEntrada();
		break;
	
	default:
		# code...
		break;
}
 ?>