<?php
// Include the database connection configuration
include "config.php";

// Define the upload directory
$upload_dir = "uploads/";

// Check if the "uploads" directory exists, and if not, create it
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0755, true); // Create the directory with appropriate permissions
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the teacher's ID from the hidden input field
    $teacher_id = $_POST["id"];
    $HoTen = $_POST["HoTen"];
    $GioiTinh = $_POST["GioiTinh"];
    $NgaySinh = $_POST["NgaySinh"];
    $NoiSinh = $_POST["NoiSinh"];
    $LopHoc = $_POST["LopHoc"];
    $KhoaHoc = $_POST["KhoaHoc"];
    $BacDaoTao = $_POST["BacDaoTao"];
    $LoaiHinhDaoTao = $_POST["LoaiHinhDaoTao"];
    $Nganh = $_POST["Nganh"];

    // Check if a new image file has been uploaded
    if (isset($_FILES["FileAnh"]) && $_FILES["FileAnh"]["error"] == 0) {
        // Get the image file details
        $file_name = $_FILES["FileAnh"]["name"];
        $file_tmp = $_FILES["FileAnh"]["tmp_name"];

        // Generate a unique file name for the uploaded image
        $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
        $unique_file_name = uniqid() . "." . $file_extension;
        $target_path = $upload_dir . $unique_file_name;

        // Move the uploaded file to the upload directory
        if (move_uploaded_file($file_tmp, $target_path)) {
            // Image was successfully uploaded, store the new file path in the database
            $FileAnh = $target_path;

            // Update the teacher's information in the database, including the new image file path
            $sql = "UPDATE giaovien SET
        HoTen = ?,
        GioiTinh = ?,
        NgaySinh = ?,
        NoiSinh = ?,
        LopHoc = ?,
        KhoaHoc = ?,
        BacDaoTao = ?,
        LoaiHinhDaoTao = ?,
        Nganh = ?,
        FileAnh = ?
        WHERE ID = ?";

$stmt = $connection->prepare($sql);
if ($stmt === false) {
    die("Lỗi: " . $connection->error);
}

$stmt->bind_param("sssssssssss", $HoTen, $GioiTinh, $NgaySinh, $NoiSinh, $LopHoc, $KhoaHoc, $BacDaoTao, $LoaiHinhDaoTao, $Nganh, $FileAnh, $teacher_id);
            if ($stmt->execute()) {
                // Redirect after a successful update
                header("Location: giao_vien_dashboard.php");
                exit;
            } else {
                echo "Lỗi: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Lỗi: Không thể tải lên tệp ảnh.";
            // Handle the error or redirect as needed
        }
    }
}

$connection->close();
?>