<?php 
    session_start();

    require $_SERVER['DOCUMENT_ROOT'] . "/Hanh/db/db_connect.php";

    if(!isset($_SESSION["id"])) {
        header("Location: login.php");
    }

    $msg = "";
    $msg_class = "";

    $name_error = "";
    $phone_error = "";
    $password_error = "";
    $img_error = "";

    $error1 = false;
    $error2 = false;
    $error3 = false;
    $error4 = false;


    if (isset($_POST["submit"])) {
        // Other information
        $user_name = mysqli_real_escape_string($conn, $_POST["user_name"]);
        $phone = mysqli_real_escape_string($conn, $_POST["phone"]);
        $birthday_string = date('Y-m-d', strtotime($_POST["birthday"])); 
        $birthday = mysqli_real_escape_string($conn, $birthday_string);
        $password = mysqli_real_escape_string($conn, md5($_POST["password"]));

        if(!preg_match("/^[a-zA-Z ]+$/",$user_name) || strlen($user_name) < 4) {
            $name_error = "Name must be minimum of 4 characters, contain only alphabets and space";
            $error1 = true;
        }

        if((!preg_match("/(84|0[3|5|7|8|9])+([0-9]{8})\b/", $phone)) && !($_POST["phone"] == "")) {
            $phone_error = "Phone is invalid. Please retype";
            $error2 = true;
        }

        if(strlen($password) < 8 || !preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/", $password)) {
            $password_error = "Password must be minimum of 8 characters, at least one number and one letter";
            $error3 = true;
        }	
        

        if ($_FILES['profileImage'] != "") {   
             // Image
            $profileImageName = time() . '-' . $_FILES["profileImage"]["name"];
            $target_dir = "img/user";
            $target_file = $target_dir . basename($profileImageName);

            $photo_tmp_name = $_FILES["profileImage"]["tmp_name"];
            $photo_size = $_FILES["profileImage"]["size"];
            $photo_new_name = rand() . $profileImageName;

            if ($photo_size > 5242880) {
                $error4 = true;
                $img_error = "Photo is very big. Maximum photo uploading size is 5MB";
            } 
            else if(file_exists($target_file)) {
                $error4 = true;
                $img_error = "File already exists";
            }
            else {
                $check = move_uploaded_file($photo_tmp_name, $target_file);
                if($check) {
                    $sql1 = "UPDATE user SET img_path = '$profileImageName' WHERE id='{$_SESSION["id"]}'";
                    mysqli_query($conn, $sql1);
                }
            }
        }

        if(!$error1 && !$error2 && !$error3) { 
            $sql = "UPDATE user SET name='$user_name', phone='$phone', birthday='$birthday', password='$password' WHERE id='{$_SESSION["id"]}'";
            if(mysqli_query($conn, $sql) && !$error4){
                $msg = "Profile updated successfully";
                $msg_class = "alert-success";
            } else {
                $msg = "There was an error updating your profile";
                $msg_class = "alert-danger";
            }
        } else {  
            $msg = "There was an error updating your profile";
            $msg_class = "alert-danger";
        }
    }
?>