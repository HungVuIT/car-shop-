<?php
    require $_SERVER['DOCUMENT_ROOT'] . "/lapTrinhWeb/db/db_connect.php";
    $conn = connect();

    $review_id = $_POST["review_id"];
    $user_id   = $_POST["user_id"];

    $query = "DELETE FROM `CarReview`
                WHERE `review_id`={$review_id}";
    
    $result = mysqli_query($conn, $query);

    if (!$result) {
        $message  = 'Invalid query: ' . mysqli_error($conn) . '<br>'; 
        $message .= 'Whole query: ' . $query;
        die($message);
    }