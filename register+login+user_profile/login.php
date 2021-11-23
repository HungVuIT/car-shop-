<?php 
ob_start();
include('header.php');
include_once("db_connect.php");
session_start();
if(isset($_SESSION['id'])!="") {
	header("Location: profile.php");
}
if (isset($_POST['login'])) {
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$hash_password = md5($password);
	$result = mysqli_query($conn, "SELECT * FROM users WHERE email = '" . $email. "' and password = '" .$hash_password. "'");
	if ($row = mysqli_fetch_array($result)) {
		$_SESSION['id'] = $row['id'];
		$_SESSION['user_name'] = $row['user_name'];		
		header("Location: profile.php");
	} else {
		$error_message = "Incorrect Email or Password!!!";
	}
}
?>
<!-- CSS -->
<link rel="stylesheet" href="css/login.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- Logo -->
<link rel = "icon" href = "img/favicon.png" type = "image/x-icon">
<!-- Title -->
<title>Carworld - Login</title>

<script type="text/javascript" src="script/ajax.js"></script>

<div class="container">	
	<div class="row">
		<div class="col-md-4 col-md-offset-4 well">
			<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="loginform">
				<fieldset>
					<legend>Login</legend>	
					<div class="col social" >
						<a href="#" class="fb btn1">
						<i class="fa fa-facebook fa-fw"></i> Login with Facebook
						</a>

						<a href="#" class="google btn1"><i class="fa fa-google fa-fw">
						</i> Login with Google+
						</a>
					</div>
					
					<div class="form-group">
						<label for="name">Email</label>
						<input type="text" name="email" placeholder="Your Email" required class="form-control" />
					</div>	
					<div class="form-group">
						<label for="name">Password</label>
						<input type="password" name="password" placeholder="Your Password" required class="form-control" />
					</div>	
					<div class="form-group">
						<input type="submit" name="login" value="Login" class="btn btn-primary" id="login"/>
					</div>
				</fieldset>
			</form>
			<span class="text-danger"><?php if (isset($error_message)) { echo $error_message; } ?></span>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-4 text-center">	
		<span class="check">New User? </span><a href="register.php">Sign Up Here</a>
		</div>
	</div>
	<div class="join-page-circle-1"></div>
    <div class="join-page-circle-2"></div>
</div>