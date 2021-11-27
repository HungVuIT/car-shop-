<?php
    session_start();

    require $_SERVER['DOCUMENT_ROOT'] . "/lapTrinhWeb/db/db_connect.php";
    $conn = connect();


    // ---------- Get car info -----------------
    $car_id = $_GET["car_id"];
    $sess_user_id = isset($_SESSION["id"])? $_SESSION["id"] : "guest";   // TODO: guest stuff

    $query = "";
    // if (isset($_SESSION["id"])) {
    //     $query = "SELECT `Car`.*, `Order`.`quantity` FROM 
    //                 (`Car` JOIN `Order` ON `Car`.`id`=`Order`.`car_id`)
    //                 WHERE `Car`.`id`={$car_id} AND `Order`.`user_id`={$user_id}";
    //     echo "Query SESSION = {$query}";
    // }
    // else {
        // TODO: guests can still buy!!!!
    $query = "SELECT * FROM `Car` WHERE `Car`.`id`={$car_id}";
        // echo "Query NORMAL = {$query} <br>";
        // echo "user_id = {$user_id}";
    //}
    $car_result = mysqli_query($conn, $query);

    if (!$car_result) {
        $message  = 'Invalid query: ' . mysqli_error($conn) . '<br>'; 
        $message .= 'Whole query: ' . $query;
        die($message);
    }

    $car_data = mysqli_fetch_assoc($car_result);

    $car_name       = $car_data["name"];
    $brand          = $car_data["brand"];
    $price          = (float) $car_data["price"];
    $year           = (int) $car_data["year"];
    $seats          = (int) $car_data["seats"];
    $color          = $car_data["color"];
    $transmission   = ucfirst($car_data["transmission"]);
    $engine         = (float) $car_data["engine"];
    $warranty       = (int) $car_data["warranty"];
    $description    = $car_data["description"];


    // ------- Get review list -------------------
    $query = "SELECT `CarReview`.*, `User`.`name`, `User`.`img_path` FROM 
                (`CarReview` JOIN `User` ON `CarReview`.`user_id`=`User`.`id`)
                    WHERE `car_id`={$car_id}
                    ORDER BY `review_id`";

    $rv_result = mysqli_query($conn, $query);

    if (!$rv_result) {
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

    <link href="css/car.css" rel="stylesheet">
    <link rel="icon" href="res/icon.png">
    <title><?php echo $car_name ?> - Carworld</title>
</head>


  
<body data-sess-user-id="<?php echo $sess_user_id ?>"
      data-car-id ="<?php echo $car_id  ?>">

    <!-- Car page -->
    <div class="container-fluid carPage">
        <!-- Car photos -->
        <div class="row mb-4">
            <div id="carouselIndicators" class="col carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselIndicators" data-slide-to="2"></li>
                </ol>

                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="res/car1.jpg" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="res/car1.jpg" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="res/car1.jpg" alt="Third slide">
                    </div>
                </div>

                <a class="carousel-control-prev" href="#carouselIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>


        <!-- Main info -->
        <div class="row justify-content-between">
            <div class="col-7 pl-sm-5 pl-md-3">
                <!-- Basic info + add to cart -->
                <h2 id="carName"><?php 
                    echo $car_name
                ?></h2>

                <h3 id="carPrice"><?php 
                    echo "$" . number_format($price, 2) 
                ?></h3>

                <form id="addCartForm" action="php/order_quantity.php">
                    <button class="btn btn-primary my-4">Add to cart</button>
                </form>

                <p id="carDescription"><?php 
                    echo "Description: " . $description; 
                ?></p>
            </div>


            <!-- Detailed info table -->
            <div class="col-sm-5 col-lg-4 table-responsive">
                <table class="table table-striped">
                    <tr>
                        <th>Brand</th>
                        <td id="carBrand"><?php 
                            echo $brand
                        ?></td>
                    </tr>
                    <tr>
                        <th>Year</th>
                        <td id="carYear"><?php 
                            echo $year
                        ?></td>
                    </tr>
                    <tr>
                        <th>Color</th>
                        <td id="carColor"><?php 
                            echo $color
                        ?></td>
                    </tr>
                    <tr>
                        <th>Seats</th>
                        <td id="carSeats"><?php 
                            echo $seats 
                        ?></td>
                    </tr>
                    <tr>
                        <th>Transmission</th>
                        <td id="carTransmission"><?php 
                            echo $transmission 
                        ?></td>
                    </tr>
                    <tr>
                        <th>Engine</th>
                        <td id="carEngine"><?php 
                            echo $engine . "L"
                        ?></td>
                    </tr>
                    <tr>
                        <th>Warranty</th>
                        <td id="carWarranty"><?php 
                            echo $warranty . " years" 
                        ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Reviews -->
        <div id="reviewSection" class="row pl-3 py-5">
            <div class="col-12">
                <div class="row pb-3 justify-content-sm-center justify-content-md-start">
                    <h2>Customer Reviews</h2>
                </div>

                <form id="newReview" action="php/add_review.php" 
                    <?php echo (!isset($_SESSION["id"]))? "class=\"d-none\"" : "" ?>>

                    <div class="row justify-content-sm-center justify-content-md-start">
                        <div class="col-sm-10 col-md-9 col-lg-8 text-sm-center text-md-left">
                            <label for="sessUserReview">Leave a review...</label>
                            <textarea id="sessUserReview" class="form-control" rows="3"></textarea>
                            <button type="submit" class="btn btn-primary my-2">Post</button>
                        </div>
                    </div>
                </form>


                <div id="userReviews">
                    <?php
                        while ($review = mysqli_fetch_assoc($rv_result)) {
                            $review_id = $review["review_id"];

                            $userName = $review["name"];
                            $user_id = $review["user_id"];
                            //$userPfpPath = $review["img_path"];   // TODO:
                            $userPfpPath = "res/user.png";
                            $reviewText = $review["review"];

                            $date_posted = $review["date_posted"];
                            $date_formatted = (new DateTime($date_posted))->format("H:i, j/m/Y");
                    ?>
                    <div class="row p-3 userReview"
                         data-review-id="<?php echo $review_id ?>"
                         data-user-id="<?php echo $user_id ?>">
                        <!-- User pfp -->
                        <a href="#!">
                            <img src="<?php echo $userPfpPath ?>" 
                                class="rvUserPhoto pt-2 pb-3" 
                                alt="<?php echo $userName ?>">
                        </a>

                        <!-- User review -->
                        <div class="col-4">
                            <!-- Username -->
                            <div class="row">
                                <div class="col rvUserName">
                                    <a href="#!"><?php 
                                        echo $userName 
                                    ?></a>
                                </div>
                                
                            </div>

                            <!-- User's review text -->
                            <div class="row">
                                <div class="col"><?php 
                                    echo $reviewText 
                                ?></div>
                            </div>

                            <!-- Review details -->
                            <div class="row">
                                <div class="col detailsReview">
                                    <?php
                                        if ($user_id == $sess_user_id) {
                                    ?>
                                    <a href="#!" class="delReview">Delete</a> | 
                                    <?php
                                        }
                                    ?>

                                    <?php echo $date_formatted ?>
                                </div>
                            </div>

                        </div>
                    </div>
                    <?php
                        }
                    ?>
                </div>
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
    
    <script src="js/car.js"></script>
  

</body>

</html>