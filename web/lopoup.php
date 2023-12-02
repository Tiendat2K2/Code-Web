<?php
// Include the database connection configuration
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize the data from the HTML form
    $student_id = mysqli_real_escape_string($connection, $_POST['student_id']);
    $masinhvien = mysqli_real_escape_string($connection, $_POST['masinhvien']);
    $hoten = mysqli_real_escape_string($connection, $_POST['hoten']);
    $gioitinh = mysqli_real_escape_string($connection, $_POST['gioitinh']);
    $ngaysinh = mysqli_real_escape_string($connection, $_POST['ngaysinh']);
    $noisinh = mysqli_real_escape_string($connection, $_POST['noisinh']);
    $dantoc = mysqli_real_escape_string($connection, $_POST['dantoc']);
    $lophoc = mysqli_real_escape_string($connection, $_POST['lophoc']);
    $khoahoc = mysqli_real_escape_string($connection, $_POST['khoahoc']);
    $sdt = mysqli_real_escape_string($connection, $_POST['sdt']);

    // Check if the student_id already exists

    // Update the student's information in the database
    $sql = "UPDATE lop SET
            MSSV = ?,
            HoTen = ?,
            GioiTinh = ?,
            NgaySinh = ?,
            NoiSinh = ?,
            DanToc = ?,
            LopHoc = ?,
            KhoaHoc = ?,
            SDT = ?
            WHERE ID = ?";

    $stmt = $connection->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("sssssssssi", $masinhvien, $hoten, $gioitinh, $ngaysinh, $noisinh, $dantoc, $lophoc, $khoahoc, $sdt, $student_id);

        if ($stmt->execute()) {
            // Record updated successfully
            header("Location: giao_vien_Danhsachlop.php");
            exit;
        } else {
            // Error handling if the update fails
            echo 'Error updating record: ' . $stmt->error;
        }

        $stmt->close();
    } else {
        // Error preparing the statement
        echo 'Error preparing statement: ' . $connection->error;
    }
}

// Close the database connection
$connection->close();
?>