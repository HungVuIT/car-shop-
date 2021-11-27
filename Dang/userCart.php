<?php
    session_start();

    if (!isset($_SESSION["id"]))
        header("Location: /lapTrinhWeb/register+login+user_profile/register.php");

    $sess_user_id = $_SESSION["id"];

    // echo "Current session ID = " . $sess_user_id;

    require $_SERVER['DOCUMENT_ROOT'] . "/lapTrinhWeb/db/db_connect.php";
    $conn = connect();

    $query = "SELECT `Order`.*, `Car`.`name`, `Car`.`price` FROM 
                (`User` JOIN `Order` ON 
                    (`User`.`id`=`Order`.`user_id` AND `User`.`id`={$sess_user_id})
                        JOIN `Car` ON `Car`.`id`=`Order`.`car_id`)";
        //Car WHERE (Id = $rand_id) or (Id = 13 - $rand_id)";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        $message  = 'Invalid query: ' . mysqli_error($conn) . '<br>'; 
        $message .= 'Whole query: ' . $query;
        die($message);
    }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    
    <link href="css/userCart.css" rel="stylesheet">
    <link rel="icon" href="res/icon.png">
    <title>Your Cart - Carworld</title>
</head>


  
<body>

    <h1 id="cartTitle" class="mx-auto mb-5 text-center">
        <img src="res/cartBig.png" alt="Cart"/>
        <b>Your Cart</b>
    </h1>

    <!-- main cart -->
    <div class="container-fluid" id="cart">
        <div id="emptyCart" class="d-none">
            <h3 class="row justify-content-center">
                There's nothing here yet...
            </h3>

            <h3 class="row justify-content-center">
                Check out&nbsp;<a href="<?php echo "#" /* TODO: link to products page */ ?>">our selection</a>!
            </h3>
        </div>

        <div id="nonEmptyCart" class="d-none">
            <table id="userCart" class="table table-responsive table-striped table-bordered text-center overflow-hidden">
                <thead>
                    <tr>
                        <th scope="col" class="col-sm-5 col-md-6">Car</th>
                        <th scope="col" class="col-sm-2">Unit Price</th>
                        <th scope="col" class="col-sm-3 col-md-2">Qnty</th>
                        <th scope="col" class="col-sm-2">Total Price</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            $car_id         = (int) $row["car_id"];
                            $name           = $row["name"];
                            $price          = (float) $row["price"];
                            $quantity       = (int) $row["quantity"];
                    ?>
                    
                    <tr class="carItem" 
                        data-user-id="<?php echo $sess_user_id ?>"
                        data-car-id ="<?php echo $car_id ?>">
                        <td>
                            <a href="car.php?car_id=<?php echo $car_id ?>">
                                <img src="res/car<?php echo $car_id % 2 + 1?>.jpg" class="carImg col-sm-12 col-md-11 p-0" 
                                    alt="<?php echo $name ?>">
                            </a>
                            <br>
                            <a href="car.php?car_id=<?php echo $car_id ?>">
                                <h5><?php echo $name ?></h5>
                            </a>
                        </td>

                        <td class="carUnitPrice"><?php 
                            echo "$" . number_format($price, 2)
                        ?></td>
                            
                        <td class="carQntyInput">
                            <form action="php/order_quantity.php">
                                <div class="row justify-content-center d-md-flex my-sm-2 my-lg-3">
                                    <div class="col-3 p-0">
                                        <a href="#!" class="carQntyBtn incr">
                                            <img src="res/add.png" alt="+"/>
                                        </a>
                                    </div>

                                    <div class="col-2 carQnty p-0">
                                        <?php echo $quantity ?>
                                    </div>
                                    
                                    <div class="col-3 p-0">
                                        <a href="#!" class="carQntyBtn decr">
                                            <img src="res/sub.png" alt="-"/>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </td>
                        
                        <td class="carTotalPrice"><?php 
                            echo "$" . number_format($price * $quantity, 2) 
                        ?></td>
                    </tr>

                    <?php
                        // end while loop
                        }
                    ?>

                    <tr id="totalRow">
                        <td colspan=3 class="text-right font-weight-bold align-middle">
                            Total Price
                        </td>

                        <td id="totalPrice">
                            
                        </td>
                    </tr>
                        
                </tbody>
            </table>

        
            <div class="row justify-content-end mx-0">
                <div class="col-sm-2 col-lg-1 px-1">
                    <button class="btn btn-primary w-100">Buy</button>
                </div>
            </div>
        </div>
    </div>

    <!-------------------- end site ------------------------------>



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <script src="js/userCart.js"></script>
  

</body></html>