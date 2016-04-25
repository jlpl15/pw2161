var contClicks = 0;

function writethings(id_iden) {
	var check1 = document.getElementById(id_iden).innerHTML;
	if(check1 == "&nbsp;") {
		if(contClicks%2 == 0){
		document.getElementById(id_iden).innerHTML = 'X';
		} 
		else {
			document.getElementById(id_iden).innerHTML = 'O';
		}
		contClicks++;
	}
	else
	{

	}
	var td1 = document.getElementById('td1').innerHTML;
	var td2 = document.getElementById('td2').innerHTML;
	var td3 = document.getElementById('td3').innerHTML;
	var td4 = document.getElementById('td4').innerHTML;
	var td5 = document.getElementById('td5').innerHTML;
	var td6 = document.getElementById('td6').innerHTML;
	var td7 = document.getElementById('td7').innerHTML;
	var td8 = document.getElementById('td8').innerHTML;
	var td9 = document.getElementById('td9').innerHTML;

	if((td1 == td2) && (td2 == td3)){
		alert('You WIN!')
	}
	if((td4 == t5) && (td5 == td6)){
		alert('You WIN!')
	}
	if((td7 == td8) && (td8 == td9)){
		alert('You WIN!')
	}
	if((td1 == t4) && (td4 == td7)){
		alert('You WIN!')
	}
	if((td2 == td5) && (td5 == td8)){
		alert('You WIN!')
	}
	if((td3 == t6) && (td6 == td9)){
		alert('You WIN!')
	}
	if((td1 == td5) && (td5 == td9)){
		alert('You WIN!')
	}
	if((td3 == t5) && (td5 == td7)){
		alert('You WIN!')
	}
}