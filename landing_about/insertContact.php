<?php
$username = "root"; // Khai báo username
$password = "";      // Khai báo password
$server   = "localhost";   // Khai báo server
$dbname   = "final";      // Khai báo database
// Kết nối database tintuc
$connect = new mysqli($server, $username, $password, $dbname);

//Nếu kết nối bị lỗi thì xuất báo lỗi và thoát.
if ($connect->connect_error) {
    die("Không kết nối :" . $conn->connect_error);
    exit();
}

//Khai báo giá trị ban đầu, nếu không có thì khi chưa submit câu lệnh insert sẽ báo lỗi
$name = "";
$email = "";
$mess = "";

//Lấy giá trị POST từ form vừa submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["name"])) {
        $name = $_POST['name'];
    }
    if (isset($_POST["email"])) {
        $email = $_POST['email'];
    }
    if (isset($_POST["mess"])) {
        $mess = $_POST['mess'];
    }
        $sql = "INSERT INTO contact (name,email,message)
        VALUES ('$name', '$email', '$mess')";

        if ($connect->query($sql) === TRUE) {
            echo "Thank for your message";
        } else {
            echo "Error: " . $sql . "<br>" . $connect->error;
        }
}
$connect->close();
?>