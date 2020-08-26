<?php include("includes/header.php"); ?>
<?php 
  if (!$session->is_signed_in()) {
      redirect("login.php");
  }

   $message = "";
  if (isset($_FILES['file'])) {
    $photo = new Photo;
    $photo->title = $_POST['title'];
    $photo->set_file($_FILES['file']) ;


    if ($photo->save()) {
      $message = "Photo uploaded successfully";
    }else{
      $message = join("<br>", $photo->custom_errors);

    }

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
            Upload
          </h1>

          <div class="col-md-6">
            <?php echo $message; ?>
            <form action="" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <input type="text" name="title" class="form-control">
              </div>
              <div class="form-group">
                <input type="file" name="file" >
              </div>
              <input type="submit" name="submit">
            </form>
          </div>
          
        </div>
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-md-12">
          <form action="upload.php" class="dropzone"></form>
        </div>
      </div>

    </div>
    <!-- /.container-fluid -->

  </div>
  <!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>