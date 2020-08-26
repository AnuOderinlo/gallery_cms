<?php include("includes/header.php"); ?>
<?php 
  if (!$session->is_signed_in()) {
      redirect("login.php");
  }



  $photos = Photo::find_all();
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
            Photos
            <small></small>
          </h1>

          <div class="col-md-12">
            <table class="table">
              <thead>
                <tr>
                  <th>Photos</th>
                  <th>Id</th>
                  <th>File Name</th>
                  <th>Title</th>
                  <th>Size</th>
                  <th>Comments</th>
                </tr>
              </thead>
              <tbody>
                <?php 

                  foreach ($photos as $photo) :

                 ?>
                <tr>
                  <td>
                    <img src="<?php echo $photo->picture_path(); ?> " class="img-fluid w-100 admin-photo-thumbnail" alt="">
                    <div class="action_links">
                      <a class="delete_link" href="delete_picture.php?id=<?php echo $photo->id ?>">Delete</a>
                      <a href="edit_photo.php?id=<?php echo $photo->id ?>">Edit</a>
                      <a href="../photo.php?id=<?php echo $photo->id ?>">View</a>
                    </div>
                  </td>
                  <td>
                    <?php echo $photo->id; ?>
                  </td>
                  <td>
                    <?php echo $photo->filename; ?>
                  </td>
                  <td>
                    <?php echo $photo->title; ?>
                  </td>
                  <td>
                    <?php echo $photo->size; ?>
                  </td>
                   <td>
                    <?php
                      $comments = Comment::find_comments($photo->id);
                    ?>
                    <a class="btn btn-primary btn-sm" href="comment_photo.php?id=<?php echo $photo->id?>"><?php echo  count($comments); ?></a>
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