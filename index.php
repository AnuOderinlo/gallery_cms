<?php include("includes/header.php"); 

$page = !empty($_GET['page'])? $_GET['page']: 1;
$items_per_page = 4;
$total_items = Photo::count_all(); 

$paginate = new Paginate($page, $items_per_page, $total_items );

$sql = "SELECT * FROM photos LIMIT {$items_per_page} OFFSET {$paginate->offset()}";
$photos = Photo::find_this_query($sql);



?>

      <!-- Page Content -->
      <div class="container">

        <div class="row">

          <!-- Blog Entries Column -->
          <div class="col-md-12">
            <div class="thumbnails row">
            <?php foreach ($photos as $photo): ?>

                <div class="col-sm-6 col-md-3">
                  <a class="thumbnail" href="photo.php?id=<?php echo $photo->id ?>">
                    <img class=" home-photo"  src="admin/<?php echo $photo->picture_path() ?>" >
                  </a>
                </div>
            <?php endforeach; ?>
            </div>
          </div>
          <div class="row">
            <ul class="pager">
            <?php 
              if ($paginate->total_page() > 1) {
                if ($paginate->has_previous()) {
                  echo "<li class='previous'><a href='index.php?page={$paginate->previous()}'>previous</a> </li>" ;
                }
              
                for ($i=1; $i <= $paginate->total_page() ; $i++) { 
                  if ($i == $page) {
                    echo "<li class='active'><a href='index.php?page=$i''>$i</a></li>";
                  }else{
                    echo "<li class=''><a href='index.php?page=$i''>$i</a></li>";

                  }
                }
                if ($paginate->has_next()) {
                  echo "<li class='next'><a href='index.php?page={$paginate->next()}'>next</a> </li>" ;
                }

                
                
              }
             ?>
            <!-- <li><a href="#">1</a></li> -->
              <!-- <li class="previous"><a href="#">previous</a> </li> -->
            </ul>
          </div>

          <!-- Blog Sidebar Widgets Column -->
          <!-- <div class="col-md-4">
            <?php /*include("includes/sidebar.php"); */?>
          </div> -->



        </div>
        <!-- /.row -->

<?php include("includes/footer.php"); ?>
