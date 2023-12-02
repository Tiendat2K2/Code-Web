<?php
// Include the database connection configuration
include "config.php";
if (isset($_POST['updateInfoBtn'])) {
    // Get data from the form
    $user_id = $_POST['user_id']; // Make sure you have an input field with the name 'user_id' in your form
    $HoTen = $_POST['HoTen'];
    $GioiTinh = $_POST['GioiTinh'];
    $NgaySinh = $_POST['NgaySinh'];
    $NoiSinh = $_POST['NoiSinh'];
    $LopHoc = $_POST['LopHoc'];
    $KhoaHoc = $_POST['KhoaHoc'];
    $BacDaoTao = $_POST['BacDaoTao'];
    $LoaiHinhDaoTao = $_POST['LoaiHinhDaoTao'];
    $Nganh = $_POST['Nganh'];

    // Handle the uploaded image (if any)
    if (isset($_FILES['FileAnh'])) {
        $file_name = $_FILES['FileAnh']['name'];
        $file_tmp = $_FILES['FileAnh']['tmp_name'];
        move_uploaded_file($file_tmp, "uploads/" . $file_name); // Store the uploaded file in a directory
        $FileAnh = "uploads/" . $file_name; // Store the file path in the database
    } else {
        // If no new image is uploaded, retain the existing one
        $FileAnh = $_POST['FileAnh'];
    }

    // Prepare the SQL update statement with a WHERE clause based on user_id
    $sql = "UPDATE sinhvien SET HoTen='$HoTen', GioiTinh='$GioiTinh', NgaySinh='$NgaySinh', NoiSinh='$NoiSinh',
    LopHoc='$LopHoc', KhoaHoc='$KhoaHoc', BacDaoTao='$BacDaoTao', LoaiHinhDaoTao='$LoaiHinhDaoTao', Nganh='$Nganh', FileAnh='$FileAnh' WHERE ID = $user_id";

    if ($connection->query($sql) === TRUE) {
        echo "Cập nhật thông tin thành công";
        // Redirect to the student dashboard or wherever you want
        header("Location: sinh_vien_dashboard.php");
    } else {
        echo "Lỗi: " . $sql . "<br>" . $connection->error;
    }
}

// Close the database connection
$connection->close();
?>