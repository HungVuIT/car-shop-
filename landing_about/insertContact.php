<?php
require $_SERVER['DOCUMENT_ROOT'] . "/lapTrinhWeb/db/db_connect.php";
// Kết nối database tintuc
$con = connect();

//Khai báo giá trị ban đầu, nếu không có thì khi chưa submit câu lệnh insert sẽ báo lỗi
$name = "";
$email = "";
$mess = "";

//Lấy giá trị POST từ form vừa submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["name"]))
        $name = $_POST['name'];
    
    if (isset($_POST["email"]))
        $email = $_POST['email'];
    
    if (isset($_POST["mess"]))
        $mess = $_POST['mess'];
    


    $sql = "INSERT INTO contact (`name`,`email`,`message`)
    VALUES ('$name', '$email', '$mess')";

    $result = mysqli_query($con, $sql);

    if ($result)
        echo "Thank for your message";
    else
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
}

//$connect->close();
?>