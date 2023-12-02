<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the database connection code (config.php)
    include('config.php');

    // Get the updated values from the form
    $MSV = $_POST['MSV'];
    $HoTen = $_POST['HoTen'];
    $NgayDong = $_POST['NgayDong'];
    $DaDong = $_POST['DaDong'];
    $NguoiNhan = $_POST['NguoiNhan'];

    // Update the student's information in the database
    $query = "UPDATE `dongtien` SET `HoTen`='$HoTen', `NgayDong`='$NgayDong', `DaDong`='$DaDong', `NguoiNhan`='$NguoiNhan' WHERE `MSSV`='$MSV'";
    $result = $connection->query($query);

    if ($result) {
        echo "Thông tin đã được cập nhật thành công.";
        header('Location: giao_vien.danhsachdongtien.php');

    } else {
        echo 'Lỗi truy vấn: ' . $connection->error;
    }

    // Close the database connection
    $connection->close();
} else {
    echo "Invalid request";
}
?>