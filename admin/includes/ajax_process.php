<?php 

	require 'init.php';

	$user = new User;



	if (isset($_POST['photo_id'])) {
	$photo = Photo::find_by_id($_POST['photo_id']);

	// print_r($photo);
		echo <<<START
			<div class="box-inner">
				<a role="checkbox"  href="#" class="thumbnail">
				  <img class="modal_thumbnails img-responsive" src="images/$photo->filename" >
				</a>
			  
			  <p class="text ">
			    Photo Id: <span class="data photo_id_box">$photo->id</span>
			  </p>
			  <p class="text">
			    Filename: <span class="data">$photo->filename</span>
			  </p>
			  <p class="text">
			    File Type: <span class="data">$photo->type</span>
			  </p>
			  <p class="text">
			    File Size: <span class="data">$photo->size</span>
			  </p>
			</div>
START;
		# code...
	}

	if (isset($_POST['img_name'])) {
		$user->save_user_image($_POST['img_name'], $_POST['user_id']);

		// echo $_POST['photo_id'];
	}



 ?>