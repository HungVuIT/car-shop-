<?php
    session_start();

    require "db/db_connect.php";
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
    $car_img1       = $car_data["car_img1"];
    $car_img2       = $car_data["car_img2"];
    $car_img3       = $car_data["car_img3"];
    $brand          = $car_data["brand"];
    $price          = (float) $car_data["price"];
    $year           = (int) $car_data["year"];
    $seats          = (int) $car_data["seats"];
    $color_name     = $car_data["color"];
    $transmission   = ucfirst($car_data["transmission"]);
    $engine         = (float) $car_data["engine"];
    $warranty       = (int) $car_data["warranty"];
    $description    = $car_data["description"];

    $color;
    switch($color_name) {
        case "Red":
            $color = "#ffe6e6";
            break;
        case "Yellow":
            $color = "#fff9cc";
            break;
        case "Blue":
            $color = "#e7e7ff";
            break;
        case "White":
            $color = "#ffffff";
            break;
        case "Black":
            $color = "#c9c9c9";
            break;
        case "Grey":
            $color = "#dedede";
            break;
        case "Green":
            $color = "#d9ffd9";
            break;
        case "Purple":
            $color = "#f7d6ff";
            break;
    
    }

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
    <!-- <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <-- Bootstrap core CSS 
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> -->


    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery.js"></script>

    <style>
                .carousel-inner {
            height: 650px;
        }

        #slide1 {
            background-image: url(img1.jpg);
            height: 650px;
            width: 100%;
            margin: auto;
            background-size: 100% 100%;
        }

        #slide2 {
            background-image: url(img2.jpg);
            height: 650px;
            width: 100%;
            margin: auto;
            background-size: 100% 100%;
        }

        #slide3 {
            background-image: url(img3.jpg);
            height: 650px;
            width: 100%;
            margin: auto;
            background-size: 100% 100%;

        }

        #contact {
            background-image: url(contact.png);
            height: 500px;
            width: 85%;
            margin: auto;
            background-size: 100% 100%;

        }

        #btn_contact {
            margin-top: 320px;
            margin-left: 100px;
            width: 30%;
            height: 50px;
            float: inline-end;
        }

        /* CSS navbar */
        .navbar {
            height: 80px;
        }

        .navbar-default .navbar-nav>li.dropdown:hover>a,
        .navbar-default .navbar-nav>li.dropdown:hover>a:hover,
        .navbar-default .navbar-nav>li.dropdown:hover>a:focus {
            background-color: rgb(231, 231, 231);
            color: rgb(85, 85, 85);
        }

        li.dropdown:hover>.dropdown-menu {
            display: block;
        }

        /* CSS sign in sign out button */
        .button {
            margin-left:10px;
            display: inline-block;
            padding: 0.75rem 1.25rem;
            border-radius: 10rem;
            color: #fff;
            text-transform: uppercase;
            font-size: 1rem;
            letter-spacing: 0.15rem;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
            z-index: 1;
          }
          .button:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgb(144, 202, 96);
            border-radius: 10rem;
            z-index: -2;
          }
          .button:before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0%;
            height: 100%;
            background-color: #b30068;
            transition: all 0.3s;
            border-radius: 10rem;
            z-index: -1;
          }
          .button:hover {
            color: #fff;
          }
          .button:hover:before {
            width: 100%;
          }
          #up:after{
            background-color: rgb(96, 181, 202);
          }

          /*-------------------------------------------------- */
          .card-header{
            color: #fff !important;
            background-color: #e76427 !important;
            padding: 10px;
            border-bottom: 1px solid transparent;
            border-top-left-radius: 0px;
            border-top-right-radius: 0px;
            border-bottom-left-radius: 0px;
            border-bottom-right-radius: 0px;
          }
    </style>



    <link href="css/carDetail.css" rel="stylesheet">
    <link rel="icon" href="img/Dang/icon.png">
    <title><?php echo $car_name ?> - Carworld</title>

</head>


  
<body style="background-color: <?php echo $color ?>"
      data-sess-user-id="<?php echo $sess_user_id ?>"
      data-car-id ="<?php echo $car_id  ?>">

    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
            CAR SHOP
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Product list</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">News</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About us</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </ul>
            <a href="#" class="button" id="in">Sign in</a>
            <a href="#" class="button" id="up">Sign up</a>
        </div>
    </nav>

    <div class="mb-5 pb-4"></div>


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
                        <img class="d-block w-100" src="<?php echo $car_img1 ?>" alt="Image #1">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="<?php echo $car_img2 ?>" alt="Image #2">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="<?php echo $car_img3 ?>" alt="Image #3">
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

                <form id="addCartForm" action="php_be/order_quantity.php">
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
                            echo $color_name
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
                            echo $warranty? $warranty . " years" : "None";
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

                <form id="newReview" action="php_be/add_review.php" 
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
                            $userPfpPath = "img/Dang/user.png";
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
    
    <script src="js/carDetail.js"></script>
  

</body>

</html>