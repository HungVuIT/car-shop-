<?php
require "./db/db_connect.php";
$con = connect();

# Pagination
$result_per_page = 4;
if (isset($_GET["page"])) {
  $page = $_GET["page"];
  settype($page, "int");
} else {
  $page = 1;
}
// Prev + Next
$prev = $page - 1;
$next = $page + 1;

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!-- My CSS-->
  <link rel="stylesheet" href="./css/car_list.css">
  <!-- Fontawesome -->
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="./js/liveSearch.js"></script>
  <style>
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
      margin-left: 10px;
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

    #up:after {
      background-color: rgb(96, 181, 202);
    }
  </style>
  <title>Car Shop</title>
</head>

<body>
  <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">
      CAR SHOP
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="carList.php">Product list</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">News</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About us</a>
        </li>
      </ul>
      <a href="#" class="button" id="in">Sign in</a>
      <a href="#" class="button" id="up">Sign up</a>
    </div>
  </nav>
  <div class="container-fluid p-3">

    <!--Search bar-->
    <div class="row search-row mb-3">
      <div class="search-box">
        <div class="input-group ">
          <div class="form-outline">
            <input type="text" id="search-keyword" autocomplete="off" class="form-control" />
            <div class="result"></div>

          </div>
          <div class="input-group-append">
            <a id="search-btn" class="btn my-btn btn-primary" onclick="validateCarSearch()">
              <i class="fas fa-search"></i>
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- List cards -->
    <div class="row justify-content-center">
      <?php
      if ($page > 0) {
        $from = ($page - 1) * $result_per_page;
        if ($from < 0) $from = 0;

        $stmt = mysqli_prepare($con, "SELECT * FROM car WHERE name LIKE ? ORDER BY id DESC LIMIT $from, $result_per_page");
        mysqli_stmt_bind_param($stmt, "s", $param_term);
        $param_term = '%' . $_GET["keyword"] . '%';
        
        if (mysqli_stmt_execute($stmt)) {
          $result = mysqli_stmt_get_result($stmt);
        }
        // Wrong keyword input => No result alert
        if (mysqli_num_rows($result) == 0 || $_GET["keyword"] == "") {
          echo '<div class="alert alert-info" role="alert">
                No results were returned in keyword search: <strong>' . $_GET["keyword"] . ' </strong></br>
                Or page <strong>' . $page . '</strong> does not exist.</br>
                <ul>
                  <li>Please check your keywords.</li>
                  <li>Keywords should be short and relevant to the product.</li>
                  <li>Please check the page number.</li>
                  <li>Page numbers must be between 1 and total of pages</li>
                </ul>
              </div>';
        }

        while ($cars = mysqli_fetch_array($result)) {
          echo '
          <div class="col-md-3 col-xs-6">
            <div class="card h-100 shadow-sm">
              <img src="./'.$cars["car_img1"].'" class="card-img-top" alt="...">
              <div class="card-body">
                <div class="car-name">' . $cars["name"] . '</div>
                <div class="car-price">' . number_format($cars["price"], 0, '', ',') . ' $</div>

                <h6> <strong>Color: </strong>' . $cars["color"] .'</h6>
                <h6> <strong>Number of seats: </strong>' . $cars["seats"] .'</h6>
                <h6> <strong>Transmission: </strong>' . $cars["transmission"] .'</h6>
                <h5>' . $cars["description"] .'</h5>

                <div class="text-center">
                  <a href="car.php?car_id=' . $cars["id"] . '" class="btn my-btn btn-primary">View Detail</a>
                </div>
              </div>
            </div>
          </div>';
        }
      } ?>

    </div>

    <!-- Pagination by DB -->
    <?php
    $stmt = mysqli_prepare($con, "SELECT id FROM car WHERE name LIKE ?");
    mysqli_stmt_bind_param($stmt, "s", $param_term);
    $param_term = '%' . $_GET["keyword"] . '%';
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $total_row = mysqli_num_rows($result);
    $total_page = ceil($total_row / $result_per_page);
    ?>

    <ul class="pagination justify-content-center">
      <li class="page-item <?php if ($page <= 1) {
                              echo 'disabled';
                            } ?>">
        <a class="page-link" href="<?php if ($page <= 1) {
                                      echo '#';
                                    } else {
                                      echo "?page=" . $prev . "&keyword=" . $_GET["keyword"];
                                    } ?>">Previous
        </a>
      </li>

      <?php for ($i = 1; $i <= $total_page; $i++) : ?>
        <li class="page-item <?php if ($page == $i) {
                                echo 'active';
                              } ?>">
          <a class="page-link" href="<?php echo "?page=" . $i . "&keyword=" . $_GET["keyword"]; ?>"> <?= $i; ?> </a>
        </li>
      <?php endfor; ?>

      <li class="page-item <?php if ($page >= $total_page) {
                              echo 'disabled';
                            } ?>">
        <a class="page-link" href="<?php if ($page >= $total_page) {
                                      echo '#';
                                    } else {
                                      echo "?page=" . $next . "&keyword=" . $_GET["keyword"];
                                    } ?>">Next
        </a>
      </li>

    </ul>

  </div>
  <?php mysqli_close($con) ?>
</body>

</html>