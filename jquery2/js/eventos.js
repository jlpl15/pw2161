var iniciaApp = function()
{
	var validarEntrada = function()
	{
		//invalida los eventos que no corresponden a esta funcion
		event.preventDefault();
		var usuario = $("#txtUsuario").val();
		var clave   = $("#txtClave").val();
		//validaciones
		//1.- que no acete vacios
		if (usuario == "")
		{
			alert("El usuario no debe ser vacio");
			$("#txtUsuario").focus();
		}
		if(clave == "")
		{
			alert("La contraseña no debe ser vacia");
			$("#txtClave").focus();
		}
		//2.- Verificar usuario y contraseña
		if(usuario == "pw" && clave == "1234")
		{
			//Dar entrada al usuario
			$("#datosUsuario").hide(); //escondemos
			$("nav").show();
		}
		else
			alert("usuario y/o contraseña incorrecta");
		console.log("Se disparó el submit");
	}
	$("#frmValidaEntrada").on("submit",validarEntrada);
}
$(document).on("ready",iniciaApp);