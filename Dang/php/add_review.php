<?php 
    require 'db_connect.php';

    $user_id = $_POST['user_id'];
    $userName = "tempUser";     // TODO: query userName from DB (using user_ID/session?)
    $review = $_POST['review'];

    date_default_timezone_set('Asia/Ho_Chi_Minh');

?>


<div class="row p-3 userReview">
    <a href="#">
        <img src="res/user.png" class="userPhoto pt-2 pb-3" alt="user2">
    </a>

    <div class="col-4">
        <div class="row">
            <div class="col userName">
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
                <?php echo date("H:i, j/m/Y") ?>
            </div>
        </div>

    </div>
</div>