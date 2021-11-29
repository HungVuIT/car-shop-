 <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="news.php">News</a>
            </li>
            <li class="nav-item">
              <?php if(isset($_SESSION['id'])) :
              ?>  
                <div class="account-wrap">
                  <div class="account-item clearfix js-item-menu">
                      <?php 
                          $sql = "SELECT * FROM user WHERE id='{$_SESSION["id"]}'";
                          $result = mysqli_query($con, $sql);
                          if (mysqli_num_rows($result) > 0) {
                              while ($row = mysqli_fetch_assoc($result)) {
                      ?>

                      <div class="image">
                          <?php if (empty($row['img_path'])) : ?>
                              <img src="img/user/default_avatar.png" alt="<?=$row['name'];?>"/>
                          <?php else : ?>
                              <img src="<?php echo 'img/user' . $row['img_path'] ?>" alt="avatar">
                          <?php endif; ?>    
                      </div>    

                      <div class="content">
                          <a class="js-acc-btn" href="#"><?=$row['name'];?></a>
                      </div>

                      <div class="account-dropdown js-dropdown">
                          <div class="info clearfix">
                              <div class="image">
                                  <a href="profile.php">
                                      <?php if (empty($row['img_path'])) : ?>
                                          <img src="img/user/default_avatar.png" alt="<?=$row['name'];?>"/>
                                      <?php else : ?>
                                          <img src="<?php echo 'img/user' . $row['img_path'] ?>" alt="avatar">
                                      <?php endif; ?>
                                  </a>
                              </div>
                              <div class="content">
                                  <h5 class="name">
                                      <a href="profile.php"><?=$row['name'];?></a>
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
            <?php else : ?>
              <a class="nav-link" href="login.php">Login</a>
            <?php endif; ?>
            </li>
          </ul>
        </div>
      </div>
  </nav>
