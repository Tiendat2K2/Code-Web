<?php
// Include the database connection configuration
include "config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize the data from the HTML form
    $masinhvien = mysqli_real_escape_string($connection, $_POST['masinhvien']);
    $hoten = mysqli_real_escape_string($connection, $_POST['hoten']);
    $gioitinh = mysqli_real_escape_string($connection, $_POST['gioitinh']);
    $ngaysinh = mysqli_real_escape_string($connection, $_POST['ngaysinh']);
    $noisinh = mysqli_real_escape_string($connection, $_POST['noisinh']);
    $dantoc = mysqli_real_escape_string($connection, $_POST['dantoc']);
    $lophoc = mysqli_real_escape_string($connection, $_POST['lophoc']);
    $khoahoc = mysqli_real_escape_string($connection, $_POST['khoahoc']);
    $sdt = mysqli_real_escape_string($connection, $_POST['sdt']);

    // Validate "masinhvien" to ensure it contains only numeric characters
    

    // Get the ID of the logged-in teacher from the session
    session_start();
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        // Check if the student with the given masinhvien already exists
        $check_query = "SELECT COUNT(*) FROM lop WHERE MSSV = ?";
        $check_stmt = $connection->prepare($check_query);
        if ($check_stmt) {
            $check_stmt->bind_param("s", $masinhvien);
            $check_stmt->execute();
            $check_stmt->bind_result($count);
            $check_stmt->fetch();
            $check_stmt->close();

            if ($count > 0) {
                // The student already exists, display an error message
                echo "<script>alert('Mã sinh viên đã tồn tại. Vui lòng nhập lại.');";
                echo "window.location.href = 'giao_vien_themDanhsachlop.php';</script>";

            } else {
                // Insert the data into the database
                $insert_query = "INSERT INTO lop (MSSV, HoTen, GioiTinh, NgaySinh, NoiSinh, DanToc, LopHoc, KhoaHoc, SDT, IDGiaovien) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                $insert_stmt = $connection->prepare($insert_query);
                if ($insert_stmt) {
                    $insert_stmt->bind_param("ssssssssss", $masinhvien, $hoten, $gioitinh, $ngaysinh, $noisinh, $dantoc, $lophoc, $khoahoc, $sdt, $user_id);

                    if ($insert_stmt->execute()) {
                        // Record inserted successfully
                        header("Location: giao_vien_Danhsachlop.php");
                        exit;
                    } else {
                        // Error handling if the insertion fails
                        echo 'Error inserting record: ' . $insert_stmt->error;
                    }

                    $insert_stmt->close();
                } else {
                    // Error preparing the statement
                    echo 'Error preparing statement: ' . $connection->error;
                }
            }
        } else {
            // Error preparing the check statement
            echo 'Error preparing check statement: ' . $connection->error;
        }
    } else {
        echo 'User not logged in. Please log in first.';
    }
}

// Close the database connection
$connection->close();
?>