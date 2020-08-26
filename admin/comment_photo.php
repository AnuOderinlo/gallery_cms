<?php include("includes/header.php"); ?>
<?php 
  if (!$session->is_signed_in()) {
      redirect("login.php");
  }
  if (empty($_GET['id'])) {
      redirect('photos.php');
  }

  $photo = Photo::find_by_id($_GET['id']);
  $comments = Comment::find_comments($_GET['id']);
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
            comments
            <!-- <small>Subheading</small> -->
          </h1>
          <!-- <a href="add_comment.php" class="btn btn-primary">Add comment</a> -->

          <div class="col-md-12">
            <table class="table">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Photo</th>
                  <th>Author</th>
                  <th>Comment</th>
                </tr>
              </thead>
              <tbody>
                <?php 

                  foreach ($comments as $comment) :

                 ?>
                <tr>
                  <td>
                    <?php echo $comment->id; ?>
                  </td>
                  <td>
                    <img src="<?php echo $photo->picture_path(); ?> " class="image-responsive admin-photo-thumbnail" alt="">; 
                  </td>
                  <td>
                    <?php echo $comment->author; ?>
                    <div class="action_links">
                      <a href="delete_comment_photo.php?id=<?php echo $comment->id ?>">Delete</a>
                    </div>
                  </td>
                 
                  <td>
                    <?php echo $comment->body; ?>
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