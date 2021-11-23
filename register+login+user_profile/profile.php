<?php 
  session_start();

  if (!isset($_SESSION["id"])) {
    header("Location: register.php");
  }

  include "db_connect.php";

  $msg = "";
  $msg_class = "";

  if (isset($_POST["submit"]) || isset($_FILES['my_image'])) {
    $user_name = mysqli_real_escape_string($conn, $_POST["user_name"]);
    $phone = mysqli_real_escape_string($conn, $_POST["phone"]);
    $birthday_string = date('Y-m-d', strtotime($_POST["birthday"])); 
    $birthday = mysqli_real_escape_string($conn, $birthday_string);
    $password = mysqli_real_escape_string($conn, md5($_POST["password"]));

    // Upload image
    $profileImageName = time() . '-' . $_FILES["profileImage"]["name"];
    // For image upload
    $target_dir = "images/icon";
    $target_file = $target_dir . basename($profileImageName);

    $photo_tmp_name = $_FILES["profileImage"]["tmp_name"];
    $photo_size = $_FILES["profileImage"]["size"];
    $photo_new_name = rand() . $profileImageName;

    if ($photo_size > 5242880) {
        $msg = "Photo is very big. Maximum photo uploading size is 5MB";
        $msg_class = "alert-danger";
    }
    else if (!preg_match("/\\.(gif|jpg|png)$/i", $profileImageName) ) {
        $msg = "Your image file was not jpg, gif or png type";
        $msg_class = "alert-danger";
        exit(); 
    }    
    else if(file_exists($target_file)) {
        $msg = "File already exists";
        $msg_class = "alert-danger";
    }
    else {
        if(move_uploaded_file($photo_tmp_name, $target_file)) {
            $sql = "UPDATE users SET user_name='$user_name', phone='$phone', birthday='$birthday', password='$password', user_img='$profileImageName' WHERE id='{$_SESSION["id"]}'";
            if(mysqli_query($conn, $sql)){
              $msg = "Image uploaded and saved in the Database";
              $msg_class = "alert-success";
            } else {
              $msg = "There was an error in the database";
              $msg_class = "alert-danger";
            }
          } else {
            $error = "There was an error uploading the file";
            $msg = "alert-danger";
          }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Logo -->
    <link rel = "icon" href = "img/favicon.png" type = "image/x-icon">

    <!-- Title -->
    <title>Carworld Account</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet">

</head>

<body class="animsition">
    <div class="page-wrapper">

        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="landing_page.html">
                            <img src="img/logo.png" alt="CoolAdmin">
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>

            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="index.html">Dashboard 1</a>
                                </li>
                                <li>
                                    <a href="index2.html">Dashboard 2</a>
                                </li>
                                <li>
                                    <a href="index3.html">Dashboard 3</a>
                                </li>
                                <li>
                                    <a href="index4.html">Dashboard 4</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="chart.html">
                                <i class="fas fa-chart-bar"></i>Charts</a>
                        </li>
                        <li>
                            <a href="table.html">
                                <i class="fas fa-table"></i>Tables</a>
                        </li>
                        <li>
                            <a href="form.html">
                                <i class="far fa-check-square"></i>Forms</a>
                        </li>
                        <li>
                            <a href="calendar.html">
                                <i class="fas fa-calendar-alt"></i>Calendar</a>
                        </li>
                        <li>
                            <a href="map.html">
                                <i class="fas fa-map-marker-alt"></i>Maps</a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-copy"></i>Pages</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="login.html">Login</a>
                                </li>
                                <li>
                                    <a href="register.html">Register</a>
                                </li>
                                <li>
                                    <a href="forget-pass.html">Forget Password</a>
                                </li>
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-desktop"></i>UI Elements</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="button.html">Button</a>
                                </li>
                                <li>
                                    <a href="badge.html">Badges</a>
                                </li>
                                <li>
                                    <a href="tab.html">Tabs</a>
                                </li>
                                <li>
                                    <a href="card.html">Cards</a>
                                </li>
                                <li>
                                    <a href="alert.html">Alerts</a>
                                </li>
                                <li>
                                    <a href="progress-bar.html">Progress Bars</a>
                                </li>
                                <li>
                                    <a href="modal.html">Modals</a>
                                </li>
                                <li>
                                    <a href="switch.html">Switchs</a>
                                </li>
                                <li>
                                    <a href="grid.html">Grids</a>
                                </li>
                                <li>
                                    <a href="fontawesome.html">Fontawesome Icon</a>
                                </li>
                                <li>
                                    <a href="typo.html">Typography</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="sidebar-header">
                <a href="/" class="brand-logo">
                    <img src="img/logo.png">
                    <div class="brand-logo-name">Carworld</div>
                </a>
            </div>

            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li class="active has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-tachometer-alt"></i>My Account</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="index.html">Profile</a>
                                </li>
                                <li>
                                    <a href="index2.html">Payment Method</a>
                                </li>
                                <li>
                                    <a href="index3.html">Address</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="chart.html">
                                <i class="fas fa-box"></i>Order</a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-bell"></i>Notification</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="login.html">Order Update</a>
                                </li>
                                <li>
                                    <a href="register.html">News</a>
                                </li>
                                <li>
                                    <a href="forget-pass.html">Updating</a>
                                </li>
                                <li>
                                    <a href="#">Hot Sales</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="landing_page.html">
                                <i class="fas fa-home"></i>Homepage</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <div class="header-button">

                                <div class="noti-wrap">
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-comment-more"></i>
                                        <span class="quantity">1</span>
                                        <div class="mess-dropdown js-dropdown">
                                            <div class="mess__title">
                                                <p>You have 2 news message</p>
                                            </div>
                                            <div class="mess__item">
                                                <div class="image img-cir img-40">
                                                    <img src="images/icon/avatar-06.jpg" alt="Michelle Moreno" />
                                                </div>
                                                <div class="content">
                                                    <h6>Michelle Moreno</h6>
                                                    <p>Have sent a photo</p>
                                                    <span class="time">3 min ago</span>
                                                </div>
                                            </div>
                                            <div class="mess__item">
                                                <div class="image img-cir img-40">
                                                    <img src="images/icon/avatar-04.jpg" alt="Diane Myers" />
                                                </div>
                                                <div class="content">
                                                    <h6>Diane Myers</h6>
                                                    <p>You are now connected on message</p>
                                                    <span class="time">Yesterday</span>
                                                </div>
                                            </div>
                                            <div class="mess__footer">
                                                <a href="#">View all messages</a>
                                            </div>
                                        </div>
                                    </div>
                            
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-notifications"></i>
                                        <span class="quantity">4</span>
                                        <div class="notifi-dropdown js-dropdown">
                                            <div class="notifi__title">
                                                <p>You have 4 Notifications</p>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c1 img-cir img-40">
                                                    <i class="zmdi zmdi-email-open"></i>
                                                </div>
                                                <div class="content">
                                                    <p>You got a email notification</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c2 img-cir img-40">
                                                    <i class="zmdi zmdi-account-box"></i>
                                                </div>
                                                <div class="content">
                                                    <p>Your account has been blocked</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__item">
                                                <div class="bg-c3 img-cir img-40">
                                                    <i class="zmdi zmdi-file-text"></i>
                                                </div>
                                                <div class="content">
                                                    <p>You got a new file</p>
                                                    <span class="date">April 12, 2018 06:50</span>
                                                </div>
                                            </div>
                                            <div class="notifi__footer">
                                                <a href="#">All notifications</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <?php 
                                            $sql = "SELECT * FROM users WHERE id='{$_SESSION["id"]}'";
                                            $result = mysqli_query($conn, $sql);
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                        ?>

                                        <div class="image">
                                            <?php if (empty($row['user_img'])) : ?>
                                                <img src="images/icon/default_avatar.png" alt="<?=$row['user_name'];?>"/>
                                            <?php else : ?>
                                                <img src="<?php echo 'images/icon' . $row['user_img'] ?>" alt="avatar" id="profileDisplay">
                                            <?php endif; ?>    
                                        </div>    

                                        <div class="content">
                                            <a class="js-acc-btn" href="#"><?=$row['user_name'];?></a>
                                        </div>

                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <?php if (empty($row['user_img'])) : ?>
                                                            <img src="images/icon/default_avatar.png" alt="<?=$row['user_name'];?>"/>
                                                        <?php else : ?>
                                                            <img src="<?php echo 'images/icon' . $row['user_img'] ?>" alt="avatar" id="profileDisplay">
                                                        <?php endif; ?>
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#"><?=$row['user_name'];?></a>
                                                    </h5>
                                                    <span class="email"><?=$row['email'];?></span>
                                                </div>
                                            </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-account"></i>Account</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="zmdi zmdi-settings"></i>Setting</a>
                                                </div>
                                                <div class="account-dropdown__item">
                                                    <a href="#">
                                                        <i class="fas fa-box"></i>Order</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="logout.php">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">Profile Settings</h2>
                                </div>
                                <p>Manage profile information for account security</p>
                            </div>
                        </div>
                        <hr>
                    
                        <div class="row">
                            <form class="" action="" method="post" enctype="multipart/form-data">
                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <?php if (!empty($msg)): ?>
                                                    <div class="alert <?php echo $msg_class ?>" role="alert">
                                                    <?php echo $msg; ?>
                                                    </div>
                                        <?php endif; ?>
                                        <div class="col-md-12">
                                                <?php 
                                                    $sql = "SELECT * FROM users WHERE id='{$_SESSION["id"]}'";
                                                    $result = mysqli_query($conn, $sql);
                                                    if (mysqli_num_rows($result) > 0) {
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                                <div class="row mt-3">
                                                    <div class="col-md-10"><label class="labels">User Name</label><input type="text" class="form-control" placeholder="User Name" id="user_name" name="user_name" value="<?php echo $row['user_name']; ?>" required></div>
                                                    <div class="col-md-10"><label class="labels">Email</label><input type="text" class="form-control" placeholder="Email" id="email" name="email" value="<?php echo $row['email']; ?>" required></div>
                                                    <div class="col-md-10"><label class="labels">Phone Number</label><input type="text" class="form-control" placeholder="Phone Number" id="phone" name="phone" value="<?php echo $row['phone']; ?>"></div>
                                                    <div class="col-md-10"><label class="labels">Password</label><input type="password" class="form-control" placeholder="Password" id="password" name="password" value="<?php echo $row['password']; ?>" required></div>
                                                </div>
                                                
                                                <div class="row mt-3">
                                                    <div class="col-md-10"
                                                        <label for="birthday">Date of Birth</label>
                                                        <input type="date" name="birthday" class="form-control" id="birthday" value="<?php echo $row['birthday']; ?>" />
                                                    </div>
                                                </div>
                                                <?php
                                                    }
                                                }
                                                ?>
                                                <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit" name="submit">Save Profile</button></div>
                                        </div>
                                    </div>

                                    <!-- Upload image -->
                                    <div class="form-group col-md-4">
                                        <div class="X1SONv">
                                            <div class="_1FzaUZ">
                                                <div class="TgSfgo">
                                                    <div class="text-center img-placeholder"  onClick="triggerClick()">
                                                        <h4>Update image</h4>
                                                    </div>
                                                    <?php 
                                                        $sql = "SELECT * FROM users WHERE id='{$_SESSION["id"]}'";
                                                        $result = mysqli_query($conn, $sql);
                                                        $row = mysqli_fetch_assoc($result);
                                                        if (empty($row['user_img'])) : 
                                                            
                                                    ?>
                                                    <img src="images/icon/default_avatar.png" onClick="triggerClick()" id="profileDisplay">
                                                    <?php else : ?>
                                                    <img src="<?php echo 'images/icon' . $row['user_img'] ?>" alt="avatar" onClick="triggerClick()" id="profileDisplay"s>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <input type="file" accept=".jpg,.jpeg,.png" name="profileImage" onChange="displayImage(this)" id="profileImage" class="form-control" style="display: none;">
                                            <div class="_3Jd4Zu">
                                                <div class="_3UgHT6">Dụng lượng file tối đa 1 MB</div>
                                                <div class="_3UgHT6">Định dạng: .JPEG, .PNG, .JPG</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End upload image -->
                                </div>
                            </form>
                        </div>
         
                        <hr>
                        <!-- Footer -->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="copyright">
                                    <p>Carworld © 2021. All rights reserved.</p>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="copyright">
                                    <p>Privacy Policy</p>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="copyright">
                                    <p>Term & Condition </p>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="copyright">
                                    <p>Career</p>
                                </div>
                            </div>

                            <div class="col-md-2">  
                                <div class="copyright">
                                    <p>News</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>
    <script src="js/script.js"></script>

</body>

</html>
<!-- end document-->
