<?php 
    include_once("php_be/validate_profile.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- META CHARSET -->
	<meta charset="UTF-8">
	<!-- META VIEWPORT -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- META EDGE -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- META DESCRIPTION -->
	<meta name="description" content="Carworld Official Website: find Carworld models, new releases, latest news, events, and the dealers across the world.">
	<!-- META KEYWORDS -->
	<meta name="keywords" content="CARS, COMMERCIAL, NEWS">
	<!-- META AUTHOR -->
	<meta name="author" content="Squid Game">

    <!-- TITLE -->
	<title>Carworld - Account</title>

    <!-- Logo -->
    <link rel = "icon" href = "img/logo.png" type = "image/x-icon">

    <!-- Fontfaces CSS-->
    <!-- <link href="css/font-face.css" rel="stylesheet"> -->
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/profile.css" rel="stylesheet">
</head>

<body class="animsition">
    <div class="page-wrapper">
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
                                    <a href="profile.php">Profile</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">
                            <i class="fas fa-box"></i>Order</a>
                        </li>
                        <li class="has-sub">
                            <a class="js-arrow" href="#">
                            <i class="fas fa-bell"></i>Notification</a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="login.html">Order Update</a>
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
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <?php 
                                            $sql = "SELECT * FROM user WHERE id='{$_SESSION["id"]}'";
                                            $result = mysqli_query($conn, $sql);
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                        ?>

                                        <div class="image">
                                            <?php if (empty($row['img_path'])) : ?>
                                                <img src="img/user/default_avatar.png" alt="<?=$row['name'];?>"/>
                                            <?php else : ?>
                                                <img src="<?php echo $row['img_path'] ?>" alt="avatar">
                                            <?php endif; ?>    
                                        </div>    

                                        <div class="content">
                                            <a class="js-acc-btn" href="#"><?=$row['name'];?></a>
                                        </div>

                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <?php if (empty($row['img_path'])) : ?>
                                                            <img src="img/user/default_avatar.png" alt="<?=$row['name'];?>"/>
                                                        <?php else : ?>
                                                            <img src="<?php echo $row['img_path'] ?>" alt="avatar">
                                                        <?php endif; ?>
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#"><?=$row['name'];?></a>
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
                                                    $sql = "SELECT * FROM user WHERE id='{$_SESSION["id"]}'";
                                                    $result = mysqli_query($conn, $sql);
                                                    if (mysqli_num_rows($result) > 0) {
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                                <div class="row mt-3">
                                                    <div class="col-md-10">
                                                        <label class="labels">User Name</label>
                                                        <input type="text" class="form-control" placeholder="User Name" id="user_name" name="user_name" value="<?php echo $row['name']; ?>" required>
                                                        <span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>
                                                    </div>
                                                    <div class="col-md-10"><label class="labels">Email</label><input type="text" class="form-control" placeholder="Email" id="email" name="email" value="<?php echo $row['email']; ?>" required></div>
                                                    <div class="col-md-10">
                                                        <label class="labels">Phone Number</label>
                                                        <input type="text" class="form-control" placeholder="Phone Number" id="phone" name="phone" value="<?php echo $row['phone']; ?>">
                                                        <span class="text-danger"><?php if ($error2 == true) echo $phone_error; ?></span>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <label class="labels">Password</label>
                                                        <input type="password" class="form-control" placeholder="Password" id="password" name="password" value="<?php echo $row['password']; ?>" required>
                                                        <span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
                                                    </div>
                                                </div>
                                                
                                                <div class="row mt-3">
                                                    <div class="col-md-10">
                                                        <label class="labels" for="birthday">Date of Birth</label>
                                                        <input type="date" name="birthday" class="form-control" id="birthday" value="<?php echo $row['birthday']; ?>" />
                                                    </div>
                                                </div>
                                                <?php
                                                    }
                                                }
                                                ?>
                                                <div class="mt-5"><button class="btn btn-primary profile-button" type="submit" name="submit">Save Profile</button></div>
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
                                                        $sql = "SELECT * FROM user WHERE id='{$_SESSION["id"]}'";
                                                        $result = mysqli_query($conn, $sql);
                                                        $row = mysqli_fetch_assoc($result);
                                                        if (empty($row['img_path'])) : 
                                                            
                                                    ?>
                                                    <img src="img/user/default_avatar.png" onClick="triggerClick()" id="profileDisplay">
                                                    <?php else : ?>
                                                    <img src="<?php echo $row['img_path'] ?>" alt="<?php echo $row['name']; ?>" onClick="triggerClick()" id="profileDisplay">
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <input type="file" accept=".jpg,.jpeg,.png" name="profileImage" onChange="displayImage(this)" alt="<?php echo $row['name']; ?>" id="profileImage" class="form-control" style="display: none;">
                                            <span class="text-danger"><?php if(isset($img_error)) echo $img_error; ?></span>
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

    <!-- vendor JS -->
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script> TODO:
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/slick/slick.min.js"></script>
    <script src="vendor/wow/wow.min.js"></script>

    <!-- Main JS-->
    <script src="js/main.js"></script>
    <script src="js/upload_img.js"></script>
</body>
</html>
