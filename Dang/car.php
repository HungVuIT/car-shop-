<?php
    include "db_connect.php";


    $id = $_GET["id"];
    $query = "SELECT * FROM Car WHERE Id={$id}";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        $message  = 'Invalid query: ' . mysqli_error($conn) . '<br>'; 
        $message .= 'Whole query: ' . $query;
        die($message);
    }

    $car_data = mysqli_fetch_assoc($result);

    $name           = $car_data["name"];
    $brand          = $car_data["brand"];
    $price          = (float)$car_data["price"];
    $year           = (int)$car_data["year"];
    $seats          = (int)$car_data["seats"];
    $color          = $car_data["color"];
    $transmission   = ucfirst($car_data["transmission"]);
    $description    = $car_data["description"];

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

    <link href="car.css" rel="stylesheet">
    <link rel="icon" href="res/icon.png">
    <title>Your Cart - Carworld</title>
</head>


  
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        
        <!-- Site logo -->
        <a class="navbar-brand mr-md-2 mr-lg-3" href="#">
            <img src="res/logo.png" alt="Site logo">
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

                <!-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com/" id="dropdown04" data-toggle="dropdown">Dropdown</a>

                    <div class="dropdown-menu" aria-labelledby="dropdown04">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li> -->
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

    <!-- Car page -->
    <div class="container-fluid carPage">
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
            <div class="col-md-5">
                <h2 id="carName">
                    <?php
                        echo $name;
                    ?>
                </h2>

                <h3 id="carPrice">
                    <?php
                        echo "$" . number_format($price, 2);
                    ?>
                </h3>

                <p id="carDescription">
                    <?php
                        echo "Description: " . $description;
                    ?>
                </p>
            </div>

            <!-- Detailed info table -->
            <div class="col-md-5 table-responsive">
                <table class="table table-striped">
                    <tr>
                        <th>Brand</th>
                        <td id="carBrand">
                            <?php
                                echo $brand;
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Year</th>
                        <td id="carYear">
                            <?php
                                echo $year;
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Color</th>
                        <td id="carColor">
                            <?php
                                echo $color;
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Seats</th>
                        <td id="carSeats">
                            <?php
                                echo $seats;
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Transmission</th>
                        <td id="carTransmission">
                            <?php
                                echo $transmission;
                            ?>
                        </td>
                    </tr>
                    <!-- <tr>
                        <th>Engine</th>
                        <td id="carEngine">
                            <?php
                                //echo $engine;
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Warranty</th>
                        <td id="carWarranty">
                            <?php
                                //echo $warranty;
                            ?>
                        </td>
                    </tr> -->
                </table>
            </div>
        </div>
    </div>

    <!-- end site -->




    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <script src="car.js"></script>
  

</body>

</html>