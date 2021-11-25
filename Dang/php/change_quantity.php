<?php
    require $_SERVER["DOCUMENT_ROOT"] . "/lapTrinhWeb/db/db_connect.php";
    $conn = connect();

    echo "package(user_id = {$_POST["user_id"]}, car_id = {$_POST["car_id"]}, quantity = {$_POST["quantity"]})";

    // SQL to update/remove

    $query = "";

    if ($_POST["quantity"] > 0) {
        // Update
        $query = "UPDATE `Order`
                    SET `quantity`={$_POST["quantity"]}
                    WHERE (`user_id`={$_POST["user_id"]} AND `car_id`={$_POST["car_id"]})";
    }
    else {
        // Delete
        $query = "DELETE FROM `Order`
                    WHERE (`user_id`={$_POST["user_id"]} AND `car_id`={$_POST["car_id"]})";
    }

    $result = mysqli_query($conn, $query);

    if (!$result) {
        $message  = 'Invalid query: ' . mysqli_error($conn) . "<br>"; 
        $message .= 'Whole query: ' . $query;
        die($message); 
    }


    // send back data as JSON
    // $new_quantity = $_POST["quantity"] + 1;
    // echo "return data = package(user_id = {$_POST["user_id"]}, car_id = {$_POST["car_id"]}, quantity = {$new_quantity})";
?>