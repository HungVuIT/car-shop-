<?php 
ob_start();
include('header.php');
include_once("db_connect.php");
session_start();
if(isset($_SESSION['id'])) {
	header("Location: profile.php");
}

$error1 = false;
$error2 = false;
$error3 = false;
$error4 = false;

if (isset($_POST['signup'])) {
	$user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);	
	if (!preg_match("/^[a-zA-Z ]+$/",$user_name) || strlen($user_name) < 4) {
		$error1 = true;
		$uname_error = "Name must be minimum of 4 characters, contain only alphabets and space";
	}
	if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
		$error2 = true;
		$email_error = "Please Enter Valid Email ID";
	}
	if(strlen($password) < 8 || !preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/", $password)) {
		$error3 = true;
		$password_error = "Password must be minimum of 8 characters, at least one number and one letter";
	}	
	if($password != $cpassword) {
		$error4 = true;
		$cpassword_error = "Password and Confirm Password doesn't match";
	}
	if (!$error1 && !$error2 && !$error3 && !$error4) {
		if(mysqli_query($conn, "INSERT INTO users(user_name, email, password) VALUES('" . $user_name . "', '" . $email . "', '" . md5($password) . "')")) {
			$success_message = "Successfully Registered!";
		} else {
			$error_message = "Error in registering...Please try again later!";
		}
	}
}
?>

<!-- CSS -->
<link rel="stylesheet" href="css/register.css">

<!-- Logo -->
<link rel = "icon" href = "img/favicon.png" type = "image/x-icon">
<!-- Title -->
<title>Carworld - Login</title>

<script type="text/javascript" src="script/ajax.js"></script>
<body>
<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4 well">
			<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
				<fieldset>
					<legend>Sign Up</legend>

					<div class="form-group">
						<div class="extend_input">
							<label for="name">User Name</label>
							<div class="tool-tip">
								<i class="tool-tip__icon">i</i>
								<p class="tool-tip__info">
								<span class="info"><span class="info__title">Please enter a valid user name that has a minium of four
									characters. User name only have aphabet and blank space.
								</span>
								</p>
							</div>
            			</div>
						<input type="text" name="user_name" placeholder="Enter User Name" required value="<?php if($error1) echo $user_name; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($uname_error)) echo $uname_error; ?></span>
					</div>
					
					<div class="form-group">
						<label for="name">Email</label>
						<input type="text" name="email" placeholder="Email" required value="<?php if($error2) echo $email; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
					</div>

					<div class="form-group">
						<div class="extend_input">
						<label for="name">Password</label>
							<div class="tool-tip">
								<i class="tool-tip__icon">i</i>
								<p class="tool-tip__info">
								<span class="info"><span class="info__title">Please enter a valid password that has a minium of eight
                        characters. Password must have at least one number and one letter.
								</span>
								</p>
							</div>
            			</div>
						<input type="password" name="password" placeholder="Password" required value="<?php if($error3) echo $password; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
					</div>

					<div class="form-group">
						<label for="name">Confirm Password</label>
						<input type="password" name="cpassword" placeholder="Confirm Password" required value="<?php if($error4) echo $cpassword; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>
					</div>

					<div class="form-group">
						<input type="submit" name="signup" value="Sign Up" class="btn btn-primary" id="sign_up"/>
					</div>
				</fieldset>
			</form>
			
			<span class="text-success"><?php if (isset($success_message)) { echo $success_message; } ?></span>
			<span class="text-danger"><?php if (isset($error_message)) { echo $error_message; } ?></span>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-4 text-center">	
		<span class="check">Already Registered? </span><a href="login.php">Login Here</a>
		</div>
	</div>	
	<div class="join-page-circle-1"></div>
    <div class="join-page-circle-2"></div>
</div>	
</body>

