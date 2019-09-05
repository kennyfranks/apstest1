<?php
require_once 'core/init.php';
?>

<!doctype HTML>
<HTML lang='en'>
<head>
	<meta charset="utf-8">
	
	<title>Test 1 | Ken Johnson </title>
	<meta name="description" content="Ken Johnson's test 1 for Associated Personnel Services">
	<meta name="author" content="Ken Johnson">
	
	<link rel="stylesheet" type="text/css" href="css/site.css">
	
	<script src="js/scripts.js"></script>
	
</head>
<body>
		<h1>Colors</h1>
		<div id="instructions">
			Click on the Color Name to see the votes for that color. <br>
			When you do click on Total, the sum of all above numbers will be shown.
		</div>
		<div id="totals-table">
			<table id="table-wrapper">
				<thead>
				<tr id="table-headings">
					<th id="colors">Colors</th>
					<th id="votes">Votes</th>
				</tr>
				</thead>
				<tbody>
					<?php //print out the table with Colors from Colors TABLE
						if( $colors = DB::getInstance()->get('Color', 'Colors', array('1', '=',  '1'))) {
							foreach($colors->results() as $color) {
								echo '<tr class="row-totals"><td class="color-name"><a href="Javascript:void(0)" onclick="showColorTotal(document.getElementById(\''
									. $color->Color
									.'\').innerHTML)" id="' 
									. $color->Color 
									. '">'
									. $color->Color 
									. '</a></td><td class="color-total" id="' 
									. $color->Color 
									. '-value"></td></tr>';
							}
						}				
					?>
				
				<tr>
					<td><a id="total" href="Javascript:void(0)" 
					<!-- Calculate and display the total for each color that was clicked -->
					onclick="showClickedGrandTotal()">Total</td>
					<td id="clicked-total"></td>
				</tr>	
				</tbody>				
			</table> <!-- "totals-table" -->
		</div> <!-- "table-wrapper" -->

</body>
</HTML>
