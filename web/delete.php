<?php
require_once 'config.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $student_id = $_GET['id'];

    // Prepare the DELETE statement
    $delete_sql = "DELETE FROM `sinhvien` WHERE `ID` = ?";
    $delete_stmt = $connection->prepare($delete_sql);

    if ($delete_stmt) {
        $delete_stmt->bind_param("i", $student_id);

        // Execute the DELETE statement
        if ($delete_stmt->execute()) {
            if ($delete_stmt->affected_rows > 0) {
                // Successful delete, redirect to giao_vien_taikhoan.php
                header("Location: giao_vien_taikhoan.php");
                exit(); // Ensure that no further code is executed after the redirect
            } else {
                echo "Lỗi: Không có bản ghi nào được xóa.";
            }
        } else {
            echo "Lỗi: " . $delete_stmt->error;
        }

        $delete_stmt->close();
    } else {
        echo "Lỗi trong câu lệnh xóa: " . $connection->error;
    }
} else {
    echo "Yêu cầu không hợp lệ!";
}

$connection->close();
?>