<?php
// Include the database configuration
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $username = $_POST["Username"];
    $password = $_POST["Password"];
    $email = $_POST["Email"];

    // You should add validation and sanitation for the data, for example:
    // $username = mysqli_real_escape_string($connection, $username);
    // $password = password_hash($password, PASSWORD_DEFAULT); // Hash the password

    // Update student information in the database (replace with your database table and fields)
    $sql = "UPDATE sinhvien SET password='$password', email='$email' WHERE username='$username'";

    if ($connection->query($sql) === TRUE) {
        // Successful update, redirect to a success page or user's profile page
        header("Location: giao_vien_taikhoan.php");
        exit();
    } else {
        // Error in the update, you might want to handle this differently
        echo "Error updating record: " . $connection->error;
    }
}
?>