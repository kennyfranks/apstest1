<?php
//USAGE: Query the database for the total votes of any color
require_once '../core/init.php';

$colorRequested = $_GET['color'];

if ($colorVotes = DB::getInstance()->get('Votes', 'Votes', array('Color', '=' , $colorRequested))) {
	
	//Total up votes per color requested
	$colorTotal = 0;
	foreach($colorVotes->results() as $vote) {
		$colorTotal += $vote->Votes;
	}

	//AJAX response
	echo json_encode($colorTotal);
	return;	
	
} else {
	
	echo "ERROR querying DB";
	return;
}