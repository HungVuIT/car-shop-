<?php
    require $_SERVER["DOCUMENT_ROOT"] . "/lapTrinhWeb/db/db_connect.php";
    $conn = connect();

    // echo "PHP received: (
    //     user_id = {$_REQUEST["user_id"]}, 
    //     car_id = {$_REQUEST["car_id"]}, 
    //     quantity = {$_REQUEST["quantity"]},
    //     req_type = {$_REQUEST["req_type"]}
    // )";

    // SQL to update/remove

    $req_type = $_REQUEST["req_type"];
    $user_id  = $_REQUEST["user_id"];
    $car_id   = $_REQUEST["car_id"];
    $quantity = isset($_REQUEST["quantity"])? $_REQUEST["quantity"] : null;


    $query = "";

    if ($req_type == "get") {
        $query = "SELECT `quantity` FROM `Order`
                    WHERE `user_id`={$user_id} AND `car_id`={$car_id}";
    }
    else if ($req_type == "add") {
        $quantity++;
        if ($quantity == 1) {
            // Update
            $query = "INSERT INTO `Order`(`user_id`, `car_id`, `quantity`)
                        VALUES ({$user_id}, {$car_id}, {$quantity})";
        }
        else {
            $query = "UPDATE `Order`
                        SET `quantity`={$quantity}
                        WHERE `user_id`={$user_id} AND `car_id`={$car_id}";
        }
    }
    else if ($req_type == "sub") {
        $quantity--;
        // Delete
        if ($quantity == 0) {
            $query = "DELETE FROM `Order`
                        WHERE `user_id`={$user_id} AND `car_id`={$car_id}";
        }
        else {
            $query = "UPDATE `Order`
                        SET `quantity`={$quantity}
                        WHERE `user_id`={$user_id} AND `car_id`={$car_id}";            
        }
    }
    


    $result = mysqli_query($conn, $query);

    if (!$result) {
        $message  = 'Invalid query: ' . mysqli_error($conn) . "<br>"; 
        $message .= 'Whole query: ' . $query;
        die($message); 
    }

    //echo "Query to be executed = {$query}";
    if ($req_type == "get") {
        $order_data = mysqli_fetch_assoc($result);

        if (isset($order_data))
            echo $order_data["quantity"];
        else
            echo 0;
    }

    // send back data as JSON
    // $new_quantity = $_POST["quantity"] + 1;
    // echo "return data = package(user_id = {$_POST["user_id"]}, car_id = {$_POST["car_id"]}, quantity = {$new_quantity})";
?>