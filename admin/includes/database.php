<?php 
// include 'config.php';

class Database{

	public $db;

	function __construct(){
		$this->open_db();
	}

	public function open_db(){
		$this->db= new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB);
		// $db = $this->db;
		if ($this->db->connect_errno) {
			die("Database connection failed".$this->db->connect_error);
		}
	}

	public function query($sql){
		$result = $this->db->query($sql);
		
		return $result;
	}

	private function confirm_query(){
		if (!$result) {
			die("Query failed".$this->db->connect_error);
		}
	}

	public function escape_string($string){
		$escape_string = $this->db->real_escape_string($string);
		return $escape_string;
	}

}

$database = new Database();
// $database->open_db();




 ?>