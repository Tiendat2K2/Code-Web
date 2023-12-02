<?php
require_once 'config.php';
session_start();

if (isset($_POST['signin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $redirect_page = '';

    if ($role === 'teacher') {
        $table = 'giaovien';
        $redirect_page = "giao_vien_dashboard.php";
        $query = "SELECT * FROM $table WHERE Username = '$username' AND Password = '$password'";
    } elseif ($role === 'student') {
        $table = 'sinhvien';
        $redirect_page = "sinh_vien_dashboard.php";
        $query = "SELECT * FROM $table WHERE Username = '$username' AND Password = '$password'";
    } else {
        // Handle invalid user roles if necessary
    }

    $result = $connection->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['ID'];
        $_SESSION['username'] = $row['Username'];
        $_SESSION['user_type'] = $role; // Đặt loại người dùng trong phiên làm việc
        // Cập nhật các thông tin người dùng khác tại đây (tương tự)
        $_SESSION['user_info'] = $row;
        header("Location: $redirect_page");
        exit;
    } else {
        echo '<script>alert("Sai tài khoản hoặc mật khẩu.");';
        echo 'window.location.href = "dangnhap.php";</script>';
        exit;
    }
}
?>