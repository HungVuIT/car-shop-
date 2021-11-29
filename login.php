<?php 
	include_once("php_be/validate_login.php");
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
	<title>Carworld - Login</title>

	<!-- Logo -->
	<link rel = "icon" href = "img/logo.png" type = "image/x-icon">

	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

  	<!-- Custom styles -->
  	<link rel="stylesheet" href="css/base.css">
	<link rel="stylesheet" href="css/login.css">
</head>
<body>
	<div class="container">	
		<div class="row">
			<div class="col-md-4 col-md-offset-4 well">
				<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="loginform">
					<fieldset>
						<legend>Login</legend>						
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
			<span id="check">New User? </span><a href="register.php">Sign Up Here</a>
			</div>
		</div>
		<div class="join-page-circle-1"></div>
		<div class="join-page-circle-2"></div>
	</div>
</body>
</html>