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

    if (!$result) {
        $message  = 'Invalid query: ' . mysqli_error($conn) . '<br>'; 
        $message .= 'Whole query: ' . $query;
        die($message);
    }


    $query = "SELECT `name` FROM `User` WHERE `id`={$user_id}";

    $result = mysqli_query($conn, $query);
    
    if (!$result) {
        $message  = 'Invalid query: ' . mysqli_error($conn) . '<br>'; 
        $message .= 'Whole query: ' . $query;
        die($message);
    }

    $userName = mysqli_fetch_assoc($result)["name"];
?>


<div class="row p-3 otherUserReview">
    <a href="#">
        <img src="res/user.png" class="otherUserPhoto pt-2 pb-3" alt="user2">
    </a>

    <div class="col-4">
        <div class="row">
            <div class="col otherUserName">
                <a href="#">
                    <?php echo $userName ?>
                </a>
            </div>
            
        </div>

        <div class="row">
            <div class="col">
                <?php echo $review ?>
            </div>
        </div>


        <div class="row">
            <div class="col timestamp">
                <?php echo $date_formatted ?>
            </div>
        </div>

    </div>
</div>