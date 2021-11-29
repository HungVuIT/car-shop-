<?php 
  session_start();
  include('includes/config.php');
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
  <link rel = "icon" href = "img/Hanh/favicon.png" type = "image/x-icon">

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <!-- Custom styles -->
  <link href="css/new.css" rel="stylesheet">
</head>
<body>
  <!-- Navigation -->
  <?php include('includes/header.php');?>
  <!-- Page Content -->
  <div class="container">
    <div class="row" style="margin-top: 5%">

      <!-- Blog Entries Column -->
      <div class="col-md-8">
        <!-- Blog Post -->
        <?php 
            if (isset($_GET['pageno'])) {
                    $pageno = $_GET['pageno'];
                } else {
                    $pageno = 1;
                }
                $no_of_records_per_page = 8;
                $offset = ($pageno-1) * $no_of_records_per_page;
                $total_pages_sql = "SELECT COUNT(*) FROM tblposts";
                $result = mysqli_query($con,$total_pages_sql);
                $total_rows = mysqli_fetch_array($result)[0];
                $total_pages = ceil($total_rows / $no_of_records_per_page);
                $query=mysqli_query($con,"select tblposts.id as pid,tblposts.PostTitle as posttitle,tblposts.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.Is_Active=1 order by tblposts.id desc  LIMIT $offset, $no_of_records_per_page");
                while ($row=mysqli_fetch_array($query)) {
        ?>

          <div class="card mb-4">
            <img class="card-img-top" src="admin/postimages/<?php echo htmlentities($row['PostImage']);?>" alt="<?php echo htmlentities($row['posttitle']);?>">
            <div class="card-body">
              <h2 class="card-title"><?php echo htmlentities($row['posttitle']);?></h2>
                <p><!--category-->
                <a class="badge bg-secondary text-decoration-none link-light" href="category.php?catid=<?php echo htmlentities($row['cid'])?>" style="color:#fff"><?php echo htmlentities($row['category']);?></a>
                <!--Subcategory--->
                <a class="badge bg-secondary text-decoration-none link-light"  style="color:#fff"><?php echo htmlentities($row['subcategory']);?></a></p>
        
              <a href="news-details.php?nid=<?php echo htmlentities($row['pid'])?>" class="btn btn-primary">Read More &rarr;</a>
            </div>
            <div class="card-footer text-muted">
              Posted on <?php echo htmlentities($row['postingdate']);?>
            </div>
          </div>
        <?php } ?>
      
        <!-- Pagination -->
        <ul class="pagination justify-content-center mb-4">
            <li class="page-item"><a href="?pageno=1"  class="page-link">First</a></li>
            <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?> page-item">
                <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>" class="page-link">Prev</a>
            </li>
            <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?> page-item">
                <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?> " class="page-link">Next</a>
            </li>
            <li class="page-item"><a href="?pageno=<?php echo $total_pages; ?>" class="page-link">Last</a></li>
        </ul>
      </div>

      <!-- Sidebar Widgets Column -->
      <?php include('includes/sidebar.php');?>
    </div>
  </div>
  <!-- Footer -->
    <!-- <?php include('includes/footer.php');?> -->


  <!-- Bootstrap core JavaScript -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
