<?php 

	class User{

		public $id;
		public $username;
		public $password;
		public $first_name;
		public $last_name;
		
		function __construct(){
			# code...
		}

		public static function find_all_users(){
			return self::find_this_query("SELECT * FROM users");
		}

		public static function find_user_by_id($id){
			global $database;
			$result_array = self::find_this_query("SELECT * FROM users WHERE id=$id LIMIT 1");

			return !empty($result_array) ? array_shift($result_array) :  false;

			// if (!empty($result_array)) {
			// 	$first_item = array_shift($result_array);
			// 	return $first_item;
			// }


			// return $found_user;
		}

		public static function find_this_query($sql){
			global $database;
			$result_set = $database->query($sql);
			$obj_array = array();
			while ($row = $result_set->fetch_array()) {
				$obj_array[]=self::instantiate($row);
			}
			return $obj_array;
		}
		
		public static function instantiate($user_record){
			$obj = new self;
			// $obj->id = $found_user["id"];
			// $obj->username = $found_user["username"];
			// $obj->password = $found_user["password"];
			// $obj->first_name = $found_user["first_name"];
			// $obj->last_name = $found_user["last_name"];

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

		public static function verify_user($username,$password){
			global $database;
			$username = $database->escape_string($username);
			$password = $database->escape_string($password);

			$sql= "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
			$result_array = self::find_this_query($sql);

			return !empty($result_array) ? array_shift($result_array) :  false;
		}



	}

























 ?>