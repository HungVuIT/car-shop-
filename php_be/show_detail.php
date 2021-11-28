<?php 
  session_start();
  include('includes/config.php');

  // Genrating CSRF Token
  if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
  }

  if(isset($_POST['submit'])) {
    // Verifying CSRF Token
    if (!empty($_POST['csrftoken'])) {
      if (hash_equals($_SESSION['token'], $_POST['csrftoken'])) {
        $comment=$_POST['comment'];
        $postid=intval($_GET['nid']);
        $st1='0';
        $query=mysqli_query($con,"insert into tblcomments(postId,name,email,comment,status) values('$postid','$name','$email','$comment','$st1')");
        if($query):
          echo "<script>alert('Comment successfully submit');</script>";
          unset($_SESSION['token']);
        else :
        echo "<script>alert('Something went wrong. Please try again.');</script>";  
        endif;
      }
    }
  }

  $postid=intval($_GET['nid']);
  $sql = "SELECT viewCounter FROM tblposts WHERE id = '$postid'";
  $result = $con->query($sql);

  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $visits = $row["viewCounter"];
      $sql = "UPDATE tblposts SET viewCounter = $visits+1 WHERE id ='$postid'";
      $con->query($sql);
    }
  } else {
      echo "No results";
  }
?>