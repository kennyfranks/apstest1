<?php

class DB {
	
	//For Singleton pattern, see getInstance() static class method below
	private static $_instance = null; //when set contains the DB connection
	
	//Private instance variables
	private $_pdo, 
		   $_query,
		   $_error = false,
		   $_results,
		   $_count = 0;
	
	//Create DB Connection when constructing a DB class instance
	private function __construct() {
		try {
			$this->_pdo = new PDO(
				'mysql:host=' . Config::get('mysql/host') . 
				';dbname=' . Config::get('mysql/dbname') ,
				Config::get('mysql/username') ,
				Config::get('mysql/password')				
				);
			//echo 'Connected to DB';
		}
		catch(PDOException $e) { 
			die($e->getMessage());
		}
		
	}
	
	//Singleton pattern, for use of DB only once per page 
	//use DB::getInstance() NOT $db = new DB;
	public static function getInstance() {
		if(!isset(self::$_instance)) {
			self::$_instance = new DB();
		}
		return self::$_instance;
	}
	
	//Generic DB query method
	//with, if present, binding the statement data as query parameters
	//USAGE: DB::getInstance->query("SELECT 'Votes.Votes` FROM `Votes` WHERE Color = ? OR ?, array('Blue', 'Red')) 
	//in this example, 'Blue' binds to ? #1, and 'Red' to ? #2
	public function query($sql, $params = array()) {
		
		$this->_error = false;
		
		if($this->_query = $this->_pdo->prepare($sql)) { //prepare is a PDO class method
			if(count($params)) {
				$count = 1; //at least one parameters exists if count($params) > 0
				foreach($params as $param) {
					$this->_query->bindValue($count, $param); //bindValue is a PDO class method
					$count++;
				}	
			}	
			//execute the query, regardless of the parameter count
			if($this->_query->execute()) { //execute is a PDO class method
				$this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
				$this->_count = $this->_query->rowCount();
			} else {
				$this->_error = true; //false by default in class variable definition above
			}
		}
		
		return $this; //
	}
	
	public function action($action, $columns, $table, $where = array()) {
		if(count($where) === 3) {
			$operators = array('=', '>', '<', '>=', '<=', '<=>');
			
			$field 	= $where[0];
			$operator 	= $where[1]; 
			$value 	= $where[2];
			
			if(in_array($operator, $operators)) {
				$sql = "{$action} {$columns} FROM {$table} WHERE {$field} {$operator} ?"; 
				if(!$this->query($sql, array($value))->error()) {
					return $this;
				}
			}
		}
		
		return false; // 
	}
	
	public function get($columns, $table, $where) {
		return $this->action('SELECT', $columns, $table, $where);
	}
	
	public function remove($columns, $table, $where) {
		return $this->action('DELETE', $columns, $table, $where);
	}
	
	public function results() {
		return $this->_results;
	}
	
	public function results_count() {
		return $this->_count;
	}
	
	public function error() {
		return $this->_error;
	}
	
	
} //end DB class 

