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
function guardaUsuario()
{
	$usuario = GetSQLValueString($_POST["txtNombreUsuario"],"text");
	$clave   = GetSQLValueString(md5($_POST["txtClaveUsuario"]),"text");
	$tipo    = GetSQLValueString($_POST["txtTipoUsuario"],"text");
	$departamento = GetSQLValueString($_POST["txtDepartamento"],"long");
	$respuesta = false;
	//conecto al servidor de BD
	$conexion = mysql_connect("localhost","root","");//servidor,usuario y clave
	//seleccionar base de datos
	mysql_select_db("cursopw");
	//se hace la consulta insert
	$guarda = sprintf("insert into usuarios values(%s,%d,%s,%s)",$clave,$departamento,$tipo,$usuario);
	//ejecutamos la consulta
	mysql_query($guarda);
	//cuantos registros fueron afectados
	if(mysql_affected_rows() > 0)
	{
		$respuesta = true;
	}
	$salidaJson = array('respuesta' => $respuesta);
	print json_encode($salidaJson);
}

function bajaUsuario()
{
	$usuario = GetSQLValueString($_POST["txtNombreUsuario"],"text");
	mysql_connect("localhost","root","");
	mysql_select_db("cursopw");
	$baja = sprintf("delete from usuarios where usuario where usuario=%s limit 1", $usuario);//eliminar el usuario
	//$baja = sprintf("update usuarios set tipousuario='baja' where usuario=%s",$usuario)
	mysql_query($baja);
	if(mysql_affected_rows() > 0)
	{
		$respuesta = true;
	}

	$salidaJson = array('respuesta' => $respuesta);
	print json_encode($salidaJson);

}

function consultas()
{
	$respuesta =  false;
	mysql_connect("localhost","root","");
	mysql_select_db("cursopw");
	$consulta = "select * from usuarios order by usuario";
	$resultado = mysql_query($consulta);
	$tabla = "";
	if(mysql_num_rows($resultado) > 0)
	{
		$respuesta = true;
		$tabla.= "<tr>";
		$tabla.= "<th>Usuario</th>";
		$tabla.= "<th>Tipo Usuario</th>";
		$tabla.= "<th>Departamento</th>";
		$tabla.= "</tr>";
		while ($registro = mysql_fetch_array($resultado))
		{
		$tabla.= "<tr>";
		$tabla.= "<td>".$registro["usuario"]."</td>";
		$tabla.= "<td>".$registro["tipousuario"]."</td>";
		$tabla.= "<td>".$registro["departamento"]."</td>";
		$tabla.= "</tr>";
		}
	}
	$salidaJson = array('respuesta' => $respuesta,
						 'tabla'    => $tabla );
}

$accion = $_POST["accion"];
//menu principal
switch ($accion) {
	case 'validarEntrada':
		validaEntrada();
		break;
	case 'guardaUsuario':
		guardaUsuario();
		break;
		case 'bajaUsuario':
			bajaUsuario();
			break;
			case 'consultas':
				consultas();
				break;
	
	default:
		# code...
		break;
}

 ?>