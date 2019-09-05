<?php



//Define GLOBAL variables

//- DB, see classes/DB.php

$GLOBALS['config'] = array (

	'mysql' => array(

		'host' => "/*HOST NAME ADDRESS HERE*/",

		'dbname' => "/*DB NAME HERE*/",

		'username' => "/*DB USERNAME HERE*/",

		'password' => "/*DB PASSWORD HERE*/",

		'port' => 21098

		)

);

	

// require in Classes only as needed when called

// as each file is run 	

spl_autoload_register(function($class) {

	require_once $_SERVER['DOCUMENT_ROOT'] . '/APStest/classes/' . $class . '.php';

});

		

		
