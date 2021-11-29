<?php 
    ob_start();
    session_start();

    
    require "db/db_connect.php";

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

        $email_query = mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");
        if(mysqli_num_rows($email_query) > 0) {
            $error2 = true;
            $email_error = "This email already in use";
        }
        else {
            if (!$error1 && !$error2 && !$error3 && !$error4) {
                if(mysqli_query($conn, "INSERT INTO user(name, email, password) VALUES('" . $user_name . "', '" . $email . "', '" . md5($password) . "')")) {
                    $success_message = "Successfully Registered!";
                } else {
                    $error_message = "Error in registering...Please try again later!";
                }
            }
        }
    }
?>
