<?php 
	include("php_be/validate_register.php");
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
	<title>Carworld - Register</title>

	<!-- Logo -->
	<link rel = "icon" href = "img/logo.png" type = "image/x-icon">

	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

  	<!-- Custom styles -->
  	<link rel="stylesheet" href="css/base.css">
	<link rel="stylesheet" href="css/register.css">
</head>
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
							<input type="text" name="user_name" placeholder="Enter User Name" required value="<?php if(isset($user_name)) echo $user_name; ?>" class="form-control" />
							<span class="text-danger"><?php if (isset($uname_error)) echo $uname_error; ?></span>
						</div>
						
						<div class="form-group">
							<label for="name">Email</label>
							<input type="text" name="email" placeholder="Email" required value="<?php if(isset($email)) echo $email; ?>" class="form-control" />
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
				<span id="check">Already Registered? </span><a href="login.php">Login Here</a>
			</div>
		</div>	
		<div class="join-page-circle-1"></div>
		<div class="join-page-circle-2"></div>
	</div>	
	<!-- Main JS-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>

