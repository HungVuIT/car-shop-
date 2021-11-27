<?php 
    require $_SERVER['DOCUMENT_ROOT'] . "/lapTrinhWeb/db/db_connect.php";
    $conn = connect();
    
    date_default_timezone_set('Asia/Ho_Chi_Minh');

    // -------- Add new review --------------
    $user_id     = $_POST['user_id'];
    $car_id      = $_POST['car_id'];
    $review      = $_POST['review'];
    $date_posted = date("Y-m-d H:i:s");
    $date_formatted = date("H:i, j/m/Y");
    

    $query = "INSERT INTO `CarReview`(`user_id`, `car_id`, `review`, `date_posted`) 
                VALUES ({$user_id}, {$car_id}, '{$review}', '{$date_posted}')";

    $result = mysqli_query($conn, $query);
    $review_id = mysqli_insert_id($conn);

    if (!$result) {
        $message  = 'Invalid query: ' . mysqli_error($conn) . '<br>'; 
        $message .= 'Whole query: ' . $query;
        die($message);
    }


    $query = "SELECT `name`,`img_path` FROM `User` WHERE `id`={$user_id}";

    $result = mysqli_query($conn, $query);
    
    if (!$result) {
        $message  = 'Invalid query: ' . mysqli_error($conn) . '<br>'; 
        $message .= 'Whole query: ' . $query;
        die($message);
    }
    
    $userName = mysqli_fetch_assoc($result)["name"];
    $userPfpPath = isset(mysqli_fetch_assoc($result)["img_path"])? mysqli_fetch_assoc($result)["img_path"] : "res/user.png";
    // TODO: show users' profile pic, which has path $imgPath


?>


<div class="row p-3 userReview"
     data-review-id="<?php echo $review_id ?>"
     data-user-id="<?php echo $user_id ?>">
    <a href="#">
        <img src="<?php echo $userPfpPath ?>"
             class="rvUserPhoto pt-2 pb-3" 
             alt="<?php echo $userName ?>">
    </a>

    <div class="col-4">
        <div class="row">
            <div class="col rvUserName">
                <a href="#"><?php 
                    echo $userName 
                ?></a>
            </div>
            
        </div>

        <div class="row">
            <div class="col"><?php 
                echo $review
            ?></div>
        </div>


        <!-- Review details -->
        <div class="row">
            <div class="col detailsReview">
                <a href="#!" class="delReview">Delete</a> 
                | 
                <?php echo $date_formatted ?>
            </div>
        </div>


    </div>
</div>