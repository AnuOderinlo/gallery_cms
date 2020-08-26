<?php include("includes/header.php"); ?>
<?php 
  if (!$session->is_signed_in()) {
      redirect("login.php");
  }

  if (empty($_GET['id'])) {
    redirect('users.php');
  }
  $user = User::find_by_id($_GET['id']);



  if (isset($_POST['update'])) {
    if ($user) {
      $user->username = $_POST['username'];
      $user->first_name = $_POST['first_name'];
      $user->last_name = $_POST['last_name'];
      $user->password = $_POST['password'];

      if (empty($_FILES['file_upload'])) {
        $user->save();
        redirect("users.php");
        $session->message("User has been updated");
      }else{
        $user->set_file($_FILES['file_upload']);
        $user->upload_image();
        $user->save();
        // redirect("edit_user.php?id=$user->id");

        redirect("users.php");
        $session->message("User has been updated");
       

      }

    }

  }




  // $users = user::find_all();
 ?>

  <?php include("includes/modal.php"); ?>
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
            Edit User
            <!-- <small>Subheading</small> -->
          </h1>

          <div class="col-md-6 user_image_box">
            <a href="#photo-modal" data-toggle="modal">
              <img class="img-responsive user_img" style="width: 100%" src="<?php echo $user->img_path_and_placeholder() ?>" alt="">
            </a>
          </div>

          <form action="" method="post" enctype="multipart/form-data">
            <div class="col-md-6">
              <div class="form-group">
                <input type="file" name="file_upload" class="">
              </div>

              <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $user->username ?>">
              </div>
              
              <div class="form-group">
                <label for="" >First Name</label>
                <input type="text" name="first_name" class="form-control" value="<?php echo $user->first_name ?>">
              </div>

              <div class="form-group">
                <label for="" >Last Name</label>
                <input type="text" name="last_name" class="form-control" value="<?php echo $user->last_name ?>">
              </div>

              <div class="form-group">
                <label for="" >Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $user->password ?>">
              </div>

              <div class="form-group">
                <a id="btn" href="delete_user.php?id=<?php echo $user->id; ?>" class="btn btn-danger pull-left ">Delete</a>
                <input type="submit" name="update" class="btn btn-primary pull-right" value="update">
              </div>
              
            </div>
            
          </form> 

        </div>
      </div>
      <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>