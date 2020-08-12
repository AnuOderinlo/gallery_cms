<?php 
 include("includes/header.php"); 

if ($session->is_signed_in()) {
	redirect("index.php");
}

if (isset($_POST['submit'])) {

	$username= trim($_POST["username"]);
	$password = trim($_POST["password"]);


	$user_found = User::verify_user($username, $password);


	if ($user_found) {
		$session->login($user_found);
		redirect("index.php");
	}else{
		$the_message =  "username and password is incorrect";

	}


}else{
	$username= "";
	$password = "";
	$the_message="";
}

?>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<h4 class="bg-danger"><?php echo $the_message; ?></h4>
			<form id="login-id" action="" method="post">
				<div class="form-group">
					<label for="username" class="text-white">Username</label>
					<input type="text" class="form-control" name="username" value="<?php echo htmlentities($username); ?>" >

				</div>

				<div class="form-group">
					<label for="password" class="text-white">Password</label>
					<input type="password" class="form-control" name="password" value="<?php echo htmlentities($password); ?>">
					
				</div>

				<div class="form-group">
					<input type="submit" name="submit" value="Submit" class="btn btn-primary">
				</div>
			</form>
		</div>
	</div>
</div>
 
