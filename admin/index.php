<?php include("includes/header.php"); ?>
<?php 
	if (!$session->is_signed_in()) {
	    redirect("login.php");
	}
 ?>

	<!-- Navigation -->
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<?php include 'includes/top-nav.php'; ?>
		<?php include 'includes/side-bar.php'; ?>
	</nav>

	<div id="page-wrapper">

		<div class="container-fluid">

			<!-- Page Heading -->
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">
						<?php 
							$users = User::find_all_users();
							// while ($row = $result->fetch_array()) {
							// 	echo $row["username"]."<br>";
							// }

							// $found_user = User::find_user_by_id(3); 
							// $user = User::instantiate($found_user);

							// echo $user->last_name;
							// echo $user->first_name;
							// echo $user->username;

							foreach ($users as $user) {
								// var_dump($user);
								// echo $user->username."<br>";
							}

							$found_user = User::find_user_by_id(1);
							// var_dump($found_user);
							// if ($found_user == false){
							// 	echo "User not found";
							// }else{
							// 	$found_user;
							// 	echo $found_user->last_name;
							// }
								echo $found_user->last_name;



						 ?>
						<small>Subheading</small>
					</h1>
					<ol class="breadcrumb">
						<li>
							<i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
						</li>
						<li class="active">
							<i class="fa fa-file"></i> Blank Page
						</li>
					</ol>
				</div>
			</div>
			<!-- /.row -->

		</div>
		<!-- /.container-fluid -->

	</div>
	<!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>