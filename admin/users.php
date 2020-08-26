<?php include("includes/header.php"); ?>
<?php 
  if (!$session->is_signed_in()) {
      redirect("login.php");
  }


  $users = User::find_all();
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
          <div class="bg-success">
            <p><?php echo $message; ?></p>
          </div>
          <h1 class="page-header">
            Users
            <!-- <small>Subheading</small> -->
          </h1>
          <a href="add_user.php" class="btn btn-primary">Add User</a>

          <div class="col-md-12">
            <table class="table">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Photo</th>
                  <th>Username</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                </tr>
              </thead>
              <tbody>
                <?php 

                  foreach ($users as $user) :

                 ?>
                <tr>
                  <td>
                    <?php echo $user->id; ?>
                  </td>
                  <td>
                    <img src="<?php echo $user->img_path_and_placeholder() ?>" class="img-fluid w-100 user_image" alt="img">
                    
                  </td>
                  
                  <td>
                    <?php echo $user->username; ?>
                    <div class="action_links">
                      <!-- <a href="delete_user.php?id=<?php echo $user->id ?>">Delete</a> -->
                      <a href="edit_user.php?id=<?php echo $user->id ?>">Edit</a>
                      <a href="">View</a>
                    </div>
                  </td>
                  <td>
                    <?php echo $user->first_name; ?>
                  </td>
                  <td>
                    <?php echo $user->last_name; ?>
                  </td>
                </tr>
                <?php endforeach; ?>  
              </tbody>
            </table>
          </div>
          <!-- <ol class="breadcrumb">
              <li>
                  <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
              </li>
              <li class="active">
                  <i class="fa fa-file"></i> Blank Page
              </li>
          </ol> -->
        </div>
      </div>
      <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>