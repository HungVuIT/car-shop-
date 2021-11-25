<?php
    session_start();

    if (!isset($_SESSION["id"])) {
        echo "Location: /lapTrinhWeb/register+login+user_profile/register.php";
        header("Location: /lapTrinhWeb/register+login+user_profile/register.php");
    }

    // echo "Current session ID = " . $_SESSION["id"];

    require $_SERVER['DOCUMENT_ROOT'] . "/lapTrinhWeb/db/db_connect.php";
    $conn = connect();

    $query = "SELECT `Order`.*, `Car`.`name`, `Car`.`price` FROM 
                (`User` JOIN `Order` ON 
                    (`User`.`id`=`Order`.`user_id` AND `User`.`id`={$_SESSION["id"]})
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
    
    <link href="userCart.css" rel="stylesheet">
    <link rel="icon" href="res/icon.png">
    <title>Your Cart - Carworld</title>
</head>


  
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        
        <!-- Site logo -->
        <a class="navbar-brand mr-md-2 mr-lg-3" href="#">
            <img src="res\logo.png" alt="Site logo">
            Carworld
        </a>

        <!-- Navbar collapse button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Main navbar -->
        <div class="collapse navbar-collapse justify-content-between" id="navbarsExample04">
            <ul class="navbar-nav mr-2">
                
                <li class="nav-item mx-sm-2 mx-md-1 mx-lg-3">
                    <a class="nav-link" href="#">Home</a>
                </li>

                <li class="nav-item mx-sm-2 mx-md-1 mx-lg-3">
                    <a class="nav-link" href="#">News</a>
                </li>

                <li class="nav-item mx-sm-2 mx-md-1 mx-lg-3">
                    <a class="nav-link" href="#">Cars</a>
                </li>

                <li class="nav-item mx-sm-2 mx-md-1 mx-lg-3">
                    <a class="nav-link" href="#">Find us</a>
                </li>
            </ul>

            
            <ul class="navbar-nav ml-md-1 ml-lg-2">
                <li class="nav-item mx-sm-2 mx-md-0 mx-lg-4">
                    <form class="form-inline col-sm-12 order-sm-1 order-md-11 px-0" id="searchBox">
                        <input class="form-control" type="text" placeholder="Browse car...">
                    </form>
                </li>

                <li class="nav-item mx-1">
                    <a href="#" id="userIcon">
                        <img src="res/user.png" alt="User"/>
                        <p class="d-none d-sm-block d-md-none">
                            <!-- display user's name here instead of "User Profile" -->
                            User Profile
                        </p>
                    </a>
                </li>

                <li class="nav-item mx-1">
                    <a href="#" id="cartIcon">
                        <img src="res/cart.png" alt="Your cart"/>
                    </a>
                </li>
            </ul>
        </div>

    </nav>

    
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

        <div class="row">
            <div class="col-12">
                <table id="userCart" class="table table-responsive table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col" class="col-sm-5 col-md-6">Car</th>
                            <th scope="col" class="col-sm-2">Unit Price</th>
                            <th scope="col" class="col-sm-3 col-md-2">Quantity</th>
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
                            data-user-id="<?php echo $_SESSION["id"] ?>"
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

                            <td class="carPrice">
                                <?php echo "$" . number_format($price, 2) ?>
                            </td>
                                
                            <td class="carQuantityInput">
                                <form action="php/change_quantity.php">
                                    <div class="row justify-content-center d-md-flex my-sm-2 my-lg-3">
                                        <div class="col-3 p-0">
                                            <a href="#!" class="carQuantityBtn incr">
                                                <img src="res/add.png"/>
                                            </a>
                                        </div>

                                        <div class="col-2 carQuantity p-0">
                                            <?php echo $quantity ?>
                                        </div>
                                        
                                        <div class="col-3 p-0">
                                            <a href="#!" class="carQuantityBtn decr">
                                                <img src="res/sub.png"/>
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </td>
                            
                            <td class="carPrice">
                                <!-- <div class="p-0 my-auto">
                                    <div class="row justify-content-center">
                                        <button class="btn btn-sm btn-success">Buy</button>
                                    </div>

                                    <div class="row justify-content-center">
                                        <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> </button> 
                                    </div>
                                </div> -->

                                <?php echo "$" . number_format($price, 2) ?>
                            </td>
                        </tr>

                        <?php
                            // end while loop
                            }
                        ?>

                    </tbody>
                </table>
            </div>

        </div>
    </div>


    <!-- end site -->




    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <script src="userCart.js"></script>
  

</body></html>