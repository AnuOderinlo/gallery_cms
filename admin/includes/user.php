<?php 


	// require 'db_object.php';


	class User extends Db_object{


		protected static $db_table = 'users';
		protected static $db_table_fields = array('username', 'password', 'first_name', 'last_name', 'user_image');
		public $id;
		public $username;
		public $password;
		public $first_name;
		public $last_name;
		public $user_image;
		public $upload_dir = "images";
		public $image_placeholder = "https://via.placeholder.com/80x80?text=image";

		public function img_path_and_placeholder(){
			return empty($this->user_image)? $this->image_placeholder : $this->upload_dir.DS.$this->user_image;
		}

		
		function __construct(){
			# code...
		}

		public function picture_path(){
			return $this->upload_dir.DS.$this->user_image;
		}

		public static function verify_user($username,$password){
			global $database;
			$username = $database->escape_string($username);

			$sql= "SELECT * FROM ".self::$db_table ." WHERE username='$username' AND password='$password' LIMIT 1";
			$result_array = self::find_this_query($sql);

			return !empty($result_array) ? array_shift($result_array) :  false;
		}

		public function delete_user_dp(){
			if ($this->delete()) {
				$target_path = SITE_ROOT.DS.'admin'.DS.$this->picture_path();
				return unlink($target_path)?true:false;
			}else{
				return false;
			}
		}


		public function set_file($file){

			if (empty($file) || !$file || !is_array($file)) {
				$this->custom_errors[] = 'There was no file uploaded here';
				return false;
			}elseif($file['error'] != 0 ){

				$this->custom_errors[] = $this->upload_errors[$file['error']];
				return false;
			}else{

				$this->user_image = basename($file['name']);
				$this->tmp_path = $file['tmp_name'];
				$this->type = $file['type'];
				$this->size = $file['size'];
			}

		}


		public function upload_image(){
			
				if (!empty($this->custom_errors)) {
					return false;
				}
				if (empty($this->user_image) || empty($this->tmp_path)) {
					$this->custom_errors[] = 'The file is not available';
					return false;
				}

				$target_path = SITE_ROOT.DS.'admin'.DS.$this->upload_dir.DS.$this->user_image;

				if (file_exists($target_path)) {
					$this->custom_errors[] = "The file {$file->user_image} already exists";
					return false;
				}
				if (move_uploaded_file($this->tmp_path, $target_path)) {
					unset($this->tmp_path);
					return true;
				}else{
					$this->custom_errors[] = "The file directory does not have permission";
					return false;
				}

				$this->create(); 

		}


		public function save_user_image($user_image, $user_id){
			global $database;

			$this->user_image= $database->escape_string($user_image);
			$this->id= $database->escape_string($user_id);

			$sql = "UPDATE ".self::$db_table." SET user_image = '{$this->user_image}' WHERE id = {$this->id}";

			$update_image = $database->query($sql);
			echo $this->img_path_and_placeholder();
		
			
		}

		

		



		

		



	}

























 ?>