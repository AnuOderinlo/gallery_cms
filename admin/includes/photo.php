<?php 																		


	class Photo extends Db_object{
		protected static $db_table = 'photos';
		protected static $db_table_fields = array('id','title','caption', 'description', 'filename', 'alternate_text', 'type', 'size');

		public $id;
		public $title;
		public $caption;
		public $description;
		public $filename;
		public $type;
		public $size;
		public $alternate_text;
		
		public $tmp_path;
		public $upload_dir = "images";




		// this is passing $_FILES['input_file_name'] as an argument $file
		public function set_file($file){

			if (empty($file) || !$file || !is_array($file)) {
				$this->custom_errors[] = 'There was no file uploaded here';
				return false;
			}elseif($file['error'] != 0 ){

				$this->custom_errors[] = $this->upload_errors[$file['error']];
				return false;
			}else{

				$this->filename = basename($file['name']);
				$this->tmp_path = $file['tmp_name'];
				$this->type = $file['type'];
				$this->size = $file['size'];
			}

		}

		public function picture_path(){
			return $this->upload_dir.DS.$this->filename;
		}


		public function save(){
			if ($this->id) {
				$this->update();
			}else{
				if (!empty($this->custom_errors)) {
					return false;
				}
				if (empty($this->filename) || empty($this->tmp_path)) {
					$this->custom_errors[] = 'The file is not available';
					return false;
				}

				$target_path = SITE_ROOT.DS.'admin'.DS.$this->upload_dir.DS.$this->filename;

				if (file_exists($target_path)) {
					$this->custom_errors[] = "The file {$file->filename} already exists";
					return false;
				}
				if (move_uploaded_file($this->tmp_path, $target_path)) {
					if ($this->create()) {
						unset($this->tmp_path);
						return true;
					}
				}else{
					$this->custom_errors[] = "The file directory does not have permission";
					return false;
				}

				$this->create(); 
			}

		}

		public function delete_photo(){
			if ($this->delete()) {
				$target_path = SITE_ROOT.DS.'admin'.DS.$this->picture_path();
				return unlink($target_path)?true:false;
			}else{
				return false;
			}
		}






	}





























 ?>