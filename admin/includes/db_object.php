<?php





class Db_object{
	public $custom_errors = array();

	public $upload_errors = [
		0=>"There is no error",
		1=>"The uploaded file exceeds the upload_max_filesize directory",
		2=>"The uploaded file exceeds the MAX_FILE_SIZE directory",
		3=>"The uploaded file was only partially uploaded",
		4=>"No file was uploaded",
		6=>"Missing a temporary folder",
		7=>"Failed to write file to disk",
		8=>"A PHP extension stopped the file upload"

	];

	protected static $db_table = 'users';
	
	function __construct(){
		
	}


	public static function find_all(){
		return static::find_this_query("SELECT * FROM ".static::$db_table ." ");
	}

	public static function find_by_id($id){
		global $database;
		$result_array = static::find_this_query("SELECT * FROM ".static::$db_table ." WHERE id=$id LIMIT 1");

		return !empty($result_array) ? array_shift($result_array) :  false;

	}

	public static function find_this_query($sql){
		global $database;
		$result_set = $database->query($sql);
		$obj_array = array();
		while ($row = $result_set->fetch_array()) {
			$obj_array[]=static::instantiate($row);
		}
		return $obj_array;
	}
	
	public static function instantiate($user_record){
		$called_class = get_called_class();

		$obj =new $called_class;

		foreach ($user_record as $property => $value) {
			// this checks if $obj(i.e User class) has the property coming form the server declared
			if ($obj->has_property($property)) {
				$obj->$property = $value;
			}
		}

		return $obj;
	}

	public function has_property($property){
		$obj_properties = get_object_vars($this);
		return array_key_exists($property, $obj_properties);
	}


	//This method is used in extracting the object specific properties(The databse fields that are needed)  and it is an associative array
	protected function properties(){
		// global $database;
		$properties = array();

		foreach (static::$db_table_fields as $db_fields) {
			if (property_exists($this, $db_fields)) {
				$properties[$db_fields] = $this->$db_fields;
			}
		}

		return $properties;//associative array
	}

	

	protected function clean_properties(){
		global $database;

		$clean_properties = array();
		$properties = $this->properties();

		foreach ($properties as $key => $value) {
			$clean_properties[$key] = $database->escape_string($value);
		}
		return $clean_properties;

	}


	public function count_all(){
		global $database;
		$sql = "SELECT COUNT(*) FROM " .static::$db_table;
		$result_set = $database->query($sql);
		$row = $result_set->fetch_array();

		return array_shift($row);
	}

	/*****************************/
	/*****CRUD METHODS BELOW*****/
	/****************************/

	public function save(){
		return isset($this->id)? $this->update() : $this->create();
		
	} 

	// CREATE METHOD
	public  function create(){
		global $database;

		$properties = $this-> clean_properties();
		// $this->username = $database->escape_string($this->username);
		// $this->password = $database->escape_string($this->password);
		// $this->first_name = $database->escape_string($this->first_name);
		// $this->last_name = $database->escape_string($this->last_name);

		$sql = "INSERT INTO ".static::$db_table."(". implode(",", array_keys($properties)) .")".  "VALUES ('".implode("','", array_values($properties))."')";

		

		if ($database->query($sql)) {
			$this->id = $database->insert_id();
			return true;
		}else{
			return false;
		}

	}

	// UPDATE METHOD
	public function update(){
		global $database;
		$properties = $this->clean_properties();
		$properties_pairs = array();

		foreach ($properties as $key => $value) {
			$properties_pairs[]= "{$key}='{$value}'";
		}
	

		$sql = "UPDATE ".static::$db_table." SET ";
		$sql .= implode(", ", $properties_pairs);
		$sql .= " WHERE id= ". $database->escape_string($this->id);

		$database->query($sql);
		return ($database->db->affected_rows==1) ? true: false;

	}

	// DELETE METHOD
	public function delete(){
		global $database;
		$this->id = $database->escape_string($this->id);

		$sql = "DELETE FROM ".static::$db_table." WHERE id=$this->id LIMIT 1";
		$database->query($sql);
		return ($database->db->affected_rows==1) ? true: false;
	}









}



































 ?>