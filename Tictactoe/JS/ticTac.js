var contClicks = 0;

function writethings(id_iden) {
	var check1 = id_iden
	if(check1 != null) {
		if(contClicks%2 == 0){
		document.getElementById(id_iden).innerHTML = 'X';
		} 
		else {
			document.getElementById(id_iden).innerHTML = 'O';
		}
		contClicks++;
	}
	if(check1 == id_iden){
		contClicks--;
	}
}