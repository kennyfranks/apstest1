<?php

//Define GLOBAL variables
//- DB, see classes/DB.php
$GLOBALS['config'] = array (
	'mysql' => array(
		'host' => "premium45.web-hosting.com",
		'dbname' => "hotdmgtl_apstest",
		'username' => "hotdmgtl_apsdev",
		'password' => "!_vw!3EswX],091nT9",
		'port' => 21098
		)
);
	
// require in Classes only as needed when called
// as each file is run 	
spl_autoload_register(function($class) {
	require_once $_SERVER['DOCUMENT_ROOT'] . '/APStest/classes/' . $class . '.php';
});
		
		