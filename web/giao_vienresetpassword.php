<?php
require_once 'config.php'; // Include the database configuration file
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        // Lấy mật khẩu mới từ form
        $newPassword = $_POST["password1"];

        // Kiểm tra xem mật khẩu có ít nhất một ký tự hoặc số
        if (preg_match('/[A-Za-z0-9]/', $newPassword)) {
            // Mật khẩu chứa ít nhất một chữ cái hoặc số

            // Cập nhật mật khẩu mới trong cơ sở dữ liệu
            $updateQuery = "UPDATE giaovien SET Password = '$newPassword' WHERE ID = $user_id";
            if ($connection->query($updateQuery) === TRUE) {
                echo "Mật khẩu đã được cập nhật thành công.";

                // Cập nhật giá trị đã băm trong phiên
                $_SESSION['hashedPassword'] = $newPassword;

                header("Location: giao_vien_dashboard.php");
            } else {
                echo "Lỗi khi cập nhật mật khẩu: " . $connection->error;
            }
        } 
    } else {
        echo "Không tìm thấy thông tin người dùng.";
    }
} else {
    echo "Yêu cầu không hợp lệ.";
}
?>