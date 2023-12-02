<?php
// Include the database connection code (config.php)
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $MSSV = $_POST['MSSV'];
    $HoTen = $_POST['hoten'];
    $NgayDong = $_POST['date'];
    $DaDong = $_POST['Dadong'];
    $NguoiNhan = $_POST['nguoiNhan'];

    // Check if $MSSV is numeric
    if (!is_numeric($MSSV)) {
        echo '<script>alert("Vui lòng nhập mã số sinh viên dưới dạng số từ 0-9.");';
        echo 'window.location = "giao_vien_themdongtien.php";</script>';
    } else {
        // Get the ID of the logged-in teacher from the session
        session_start();
        if (isset($_SESSION['user_id'])) {
            $IDGiaoVien = $_SESSION['user_id'];

            // Insert the payment data into the database
            $query = "INSERT INTO dongtien (MSSV, HoTen, NgayDong, DaDong, NguoiNhan, IDGiaoVien) 
                      VALUES ('$MSSV', '$HoTen', '$NgayDong', '$DaDong', '$NguoiNhan', '$IDGiaoVien')";

            if ($connection->query($query) === TRUE) {
                // Data was inserted successfully
                header("Location: giao_vien.danhsachdongtien.php");
                exit();
            } else {
                // Error in the SQL query
                echo "Error: " . $query . "<br>" . $connection->error;
            }
        } else {
            // The user is not logged in, so you can handle this case as needed
            echo "Error: User is not logged in.";
            header("Location: error_page.php");
        }
    }
}

// Close the database connection
$connection->close();
?>