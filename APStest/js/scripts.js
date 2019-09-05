//USE: retrieve from DB the votes for the corresponding total
//input: string, as color
//output: integer, as total votes for a color
function showColorTotal(color) {
			//Create XHR Object
			var xhttp= new XMLHttpRequest();
			//OPEN - type, url, async
			xhttp.open('GET', "ajax/getcolortotal.php?color="+color, true);
			// AJAX request to get color total
			xhttp.onload = function(){
				if(this.status == 200){
					console.log(xhttp.responseText);
					document.getElementById(color + '-value').innerHTML = xhttp.responseText;
				} else {
					//report error on ajax request 
					console.log("NOT WORKING");
				}
			}
			//Send the request
			xhttp.send();
}

//USE: Calculate the total of all clicked Color totals
//input: array of class td
//output: integer total
function showClickedGrandTotal() {
			//get array of all color totals
			var totals = document.getElementsByClassName('color-total');
			//loop oer array to calculate all color totals 
			var grandTotal = 0;
			for (i = 0; i < totals.length; i++) {
				if(isNaN(totals[i].innerHTML) || totals[i].innerHTML == ""){ //guard against non-numeric totals
					grandTotal += 0;
					continue;
				}
				grandTotal += parseInt(totals[i].innerHTML, 10); //convert total to base10 numeric
			}
			//update clicked-total with latest calculated total
			document.getElementById("clicked-total").innerHTML = grandTotal;
}