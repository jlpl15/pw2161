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
		var parametros = "accion=validarEntrada"+
						 "&usuario="+usuario+
						 "&clave="+clave+
						 "&id="+Math.random();
		$.ajax({
			beforeSend:function(){
				console.log("validar el usuario");
				},
				cache: false,
				type: "POST",
				dataType: "json",
				url:"php/funciones.php",
				data: parametros,
				success: function(response){
					if(response.respuesta)
					{
						$("#datosUsuario").hide();
						$("nav").show("slow");
					}
					else
					{
						alert("usuario y/o contraseña incorrecto(s)");
					}

				},
				error: function(xhr,ajaxOptionx,thrownError){
					console.log("Algo salió mal");
				}
		});
		console.log("Se disparó el submit")
	}
	var Altas = function()
	{
		//mostramos el formulario
		$("#altaUsuarios").show("slow");
	}

	var AltaUsuario = function()
	{
		event.preventDefault();
		alert($("#frmAltaUsuarios").serialize());
		var datos = $("#frmAltaUsuarios").serialize();
		var parametros = "accion=guardaUsuario&"+datos+
						 "&id"+Math.random();
		$.ajax({
			beforeSend:function(){
				console.log("validar el usuario");
				},
				cache: false,
				type: "POST",
				dataType: "json",
				url:"php/funciones.php",
				data: parametros,
				success: function(response){
					if(response.respuesta ==true)
					{
						alert("Usuario registrado correctamente");
					}
					else
					{
						alert("No se pudo guardar la informacion");
					}
				},
				error: function(xhr,ajax,thrownError){
				}
		});
	}
	$("#frmValidaEntrada").on("submit",validarEntrada);
	$("#btnAltas").on("click",Altas)
	$("frmAltaUsuarios").on("submit",AltaUsuario);
}
$(document).on("ready",iniciaApp);
