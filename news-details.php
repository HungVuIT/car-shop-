<?php 
  session_start();
  include('php_be/show_detail.php');

  // Genrating CSRF Token
  if(empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <!-- META CHARSET -->
  <meta charset="UTF-8">
  <!-- META VIEWPORT -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- META EDGE -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- META DESCRIPTION -->
  <meta name="description" content="Carworld Official Website: find Carworld models, new releases, latest news, events, and the dealers across the world.">
  <!-- META KEYWORDS -->
  <meta name="keywords" content="CARS, COMMERCIAL, NEWS">
  <!-- META AUTHOR -->
  <meta name="author" content="Squid Game">

  <!-- TITLE -->
  <title>Carworld - News</title>

  <!-- Logo -->
  <link rel = "icon" href = "img/favicon.png" type = "image/x-icon">

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles -->
  <link href="css/profile.css" rel="stylesheet">
  <link href="css/news.css" rel="stylesheet">

  <!-- Bootstrap CSS-->
  <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

  <!-- Vendor CSS-->
  <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
  <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
  <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
  <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
  <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
  <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
  <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
  <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
  <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
</head>

  <body>

    <!-- Navigation -->
   <?php include('includes/header.php');?>

    <!-- Page Content -->
    <div class="container">


     
      <div class="row" style="margin-top: 4%">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
  
          <!-- Blog Post -->
<?php
$pid=intval($_GET['nid']);
$currenturl="http://".$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];;
 $query=mysqli_query($con,"select tblposts.PostTitle as posttitle,tblposts.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url,tblposts.postedBy,tblposts.lastUpdatedBy,tblposts.UpdationDate from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.id='$pid'");
while ($row=mysqli_fetch_array($query)) {
?>

          <div class="card mb-4">
      
            <div class="card-body">
              <h2 class="card-title"><?php echo htmlentities($row['posttitle']);?></h2>
<!--category-->
 <a class="badge bg-secondary text-decoration-none link-light" href="category.php?catid=<?php echo htmlentities($row['cid'])?>" style="color:#fff"><?php echo htmlentities($row['category']);?></a>
<!--Subcategory--->
  <a class="badge bg-secondary text-decoration-none link-light"  style="color:#fff"><?php echo htmlentities($row['subcategory']);?></a>


<p>
             
          <b>Posted by </b> <?php echo htmlentities($row['postedBy']);?> on <?php echo htmlentities($row['postingdate']);?> |
          <?php if($row['lastUpdatedBy']!=''):?>
          <b>Last Updated by </b> <?php echo htmlentities($row['lastUpdatedBy']);?> on </b><?php echo htmlentities($row['UpdationDate']);?></p>
        <?php endif;?>
                <b>Visits:</b> <?php print $visits; ?>
                <hr />

 <img class="img-fluid rounded" src="admin/postimages/<?php echo htmlentities($row['PostImage']);?>" alt="<?php echo htmlentities($row['posttitle']);?>">
  
              <p class="card-text"><?php 
$pt=$row['postdetails'];
              echo  (substr($pt,0));?></p>
             
            </div>
            <div class="card-footer text-muted">
             
           
            </div>
          </div>
<?php } ?>
       

      

     

        </div>

        <!-- Sidebar Widgets Column -->
      <?php include('includes/sidebar.php');?>
      </div>
      <!-- /.row -->
<!---Comment Section --->

 <div class="row" style="margin-top: -8%">
   <div class="col-md-8">
      <div class="card my-4">
        <h5 class="card-header">Leave a Comment:</h5>
        <div class="card-body">
          <form name="Comment" method="post">
            <input type="hidden" name="csrftoken" value=<?php echo $_SESSION['token'] ?>>
            <div class="form-group">
              <textarea class="form-control" name="comment" rows="3" placeholder="Comment" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
          </form>
        </div>
      </div>

  <!---Comment Display Section --->

    <?php 
      $query=mysqli_query($conn,"select name, email, comment, postingDate, img_path from  tblcomments where postId='$pid'");
      while ($row=mysqli_fetch_array($query)) {
      ?>
        <div class="media mb-4">
          <?php if (empty($row['img_path'])) :
          ?> 
            <img class="d-flex mr-3 rounded-circle" src="img/user/default_avatar.png" alt="<?php echo htmlentities($row['name']);?>" width=30px>
          <?php else : ?>
            <img class="d-flex mr-3 rounded-circle" src="<?php echo 'img/user/' . $row['img_path'] ?>" alt="<?php echo htmlentities($row['name']);?>" width=30px>
          <?php endif; ?>  
          <div class="media-body">
            <h5 class="mt-0">
              <?php echo htmlentities($row['name']);?> </br>
              <span style="font-size:11px;"> 
                <b>at</b> <?php echo htmlentities($row['postingDate']);?>
              </span>
            </h5>
          <?php echo htmlentities($row['comment']);?>            
          </div>
        </div>
      <?php 
      } 
    ?>

        </div>
      </div>
    </div>

  
      <!-- <?php include('includes/footer.php');?> -->


    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS -->
    <script src="vendor/slick/slick.min.js"></script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js"></script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js"></script>

    <!-- Main JS-->
    <script src="js/main.js"></script>
</body>
</html>
