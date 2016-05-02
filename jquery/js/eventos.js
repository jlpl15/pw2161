/*jquery(etiquetas,clases,id)
$ alias(un sobrenombre)
$ == j
query*/

var inicio = function()
{
	var clicBoton = function()
	{
		console.log("Clic del botón");
		//$(".anuncioWeb").html("Clic del boton");
		$(".anuncioWeb").append("Clic del boton");
	}
	var clicBoton2 = function()
	{
		alert("botón 2");
	}
	var teclaInput = function(tecla)
	{
		if(tecla.which == 13)
		{
			//que se posicione en otroInput
			$("#otroInput").focus();
		}
	}
//preparar los eventos de tdos mis objetos
$("#miBoton").off("click",clicBoton);
$("#miBoton").on("click",clicBoton2);
$("#unInput").on("keypress",teclaInput);
}

//main
$(document).on("ready",inicio)//encender el evento 