<?php 
    ob_start();
    session_start();
    
    require $_SERVER['DOCUMENT_ROOT'] . "/Hanh/db/db_connect.php";

    if(isset($_SESSION["id"])) {
        header("Location: profile.php");
    }

    $error1 = false;
    $error2 = false;

    if (isset($_POST['login'])) {
        // SQL injection
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $hash_password = md5($password);

        if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
            $error1 = true;
            $email_error = "Please Enter Valid Email ID";
        }
        if(strlen($password) < 8 || !preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/", $password)) {
            $error2 = true;
            $password_error = "Password must be minimum of 8 characters, at least one number and one letter";
        }	

        $result = mysqli_query($conn, "SELECT * FROM user WHERE email = '" . $email. "' and password = '" .$hash_password. "'");
        if ($row = mysqli_fetch_array($result)) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];		
            header("Location: profile.php");
        } else {
            $error_message = "Incorrect Email or Password!!!";
        }
    }
?>