var iniciaApp = function()
{
	var mostrarAlta= function()
	{
		$("#altaEncuesta").show();
		$("#bajaEncuesta").hide();
		$("#cambioEncuesta").hide();
		$("#ConsultaEncuesta").hide();
	}
	var mostrarBaja = function()
	{
		$("#bajaEncuesta").show();
		$("#altaEncuesta").hide();
		$("#cambioEncuesta").hide();
		$("#ConsultaEncuesta").hide();
	}
	var mostrarCambio= function()
	{
		$("#cambioEncuesta").show();
		$("#bajaEncuesta").hide();
		$("#altaEncuesta").hide();
		$("#ConsultaEncuesta").hide();
	}
	var mostrarConsulta = function()
	{
		$("#ConsultaEncuesta").show();
		$("#cambioEncuesta").hide();
		$("#bajaEncuesta").hide();
		$("#altaEncuesta").hide();
	}
	var altaEncuesta = function()
	{
		event.preventDefault();
		var datos = $("#frmAlta").serialize();
		var parametros = "accion=guardarEncuesta&"+datos+
						 "&id"+Math.random();
		$.ajax({
			beforeSend:function(){
				console.log("validar la encuesta");
				},
				cache: false,
				type: "POST",
				dataType: "json",
				url:"php/funciones.php",
				data: parametros,
				success: function(response){
					if(response.respuesta == true)
					{
						alert("Encuesta registrada correctamente");
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
	var bajaEncuesta = function()
	{
		event.preventDefault();
		var datos = $("#bajaclave").val();
		var parametros = "accion=bajaEncuesta&"+"clave="+datos+
						 "&id"+Math.random();
		$.ajax({
			beforeSend:function(){
				console.log("validar la encuesta");
				},
				cache: false,
				type: "POST",
				dataType: "json",
				url:"php/funciones.php",
				data: parametros,
				success: function(response){
					if(response.respuesta == true)
					{
						alert("Encuesta dada de baja correctamente");
					}
					else
					{
						alert("No se pudo borrar la informacion");
					}
				},
				error: function(xhr,ajax,thrownError){
				}
		});
	}
	var cambios = function()
	{
			event.preventDefault();
		var datos = $("#frmAlta").serialize();
		var parametros = "accion=cambiaEncuesta&"+datos+
						 "&id"+Math.random();
		$.ajax({
			beforeSend:function(){
				console.log("validar la encuesta");
				},
				cache: false,
				type: "POST",
				dataType: "json",
				url:"php/funciones.php",
				data: parametros,
				success: function(response){
					if(response.respuesta == true)
					{
						alert("Encuesta registrada correctamente");
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
	var consultas = function()
	{
			var parametros = "accion=consultas&"+"&id="+Math.random();
	$.ajax({
		beforeSend:function(){
				console.log("Consultas de  encuestas");
				},
				cache: false,
				type: "POST",
				dataType: "json",
				url:"php/funciones.php",
				data: parametros,
				success: function(response){
					if(response.respuesta ==true)
					{
						$("#tablaConsultas").html(response.tabla);//limpiamos la tabla
					}
					else
					{
						alert("No se pudo eliminar la informacion");
					}
				},
				error:function(xhr,ajax,thrownError){
					console.log("Ha ocurrido un error");
			    }
	});
		}

	
	//para mostrar los formularios
	$("#btnAltas").on("click",mostrarAlta);
	$("#btnBajas").on("click",mostrarBaja);
	$("#btnCambios").on("click",mostrarCambio);
	$("#btnConsultas").on("click",mostrarConsulta);

	//para darle la funcion al boton dentro del formulario
	$("#frmAlta").on("submit",altaEncuesta);
	$("#frmBaja").on("submit",bajaEncuesta);
	$("#frmCambio").on("submit",cambioEncuesta);
	

	
}
$(document).on("ready",iniciaApp);
