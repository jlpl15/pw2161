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
//preparar los eventos de tdos mis objetos
$("#miBoton").on("click",clicBoton);
}
//main
$(document).on("ready",inicio)//encender el evento 