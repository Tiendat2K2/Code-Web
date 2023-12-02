<?php
session_start();

// Include the database connection configuration
include 'config.php';

// Check if the teacher is logged in
if (isset($_SESSION['user_id'])) {
    // Retrieve the teacher's ID from the session
    $teacher_id = $_SESSION['user_id'];

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve data from the form
        $username = $_POST['Username'];
        $password = $_POST['Password'];
        $email = $_POST['Email'];

        // Check if the username is a valid number (0-9)
        if (!ctype_digit($username)) {
            echo "<script>alert('Vui lòng nhập mã sinh viên đúng định dạng số từ 0 đến 9.');";
            echo "window.location.href = 'giao_vien_themtaikhoan.php';</script>";
            exit(); // Stop execution if the username format is invalid
        }

        // Check if the entered student ID matches the teacher's ID
        if ($teacher_id == $username) {
            echo "<script>alert('Không được nhập mã giáo viên vào tài khoản sinh viên.');";
            echo "window.location.href = 'giao_vien_themtaikhoan.php';</script>";
            exit();
        }

        // Check if the username or email already exist in the database
        $checkQuery = $connection->prepare("SELECT ID FROM sinhvien WHERE Username = ? OR Email = ?");
        $checkQuery->bind_param("ss", $username, $email);
        $checkQuery->execute();
        $checkResult = $checkQuery->get_result();

        if ($checkResult->num_rows > 0) {
            // Username or email already exists, display an error message
            echo "<script>alert('Tài khoản hoặc email đã tồn tại. Vui lòng nhập lại.');";
            echo "window.location.href = 'giao_vien_themtaikhoan.php';</script>";

            // Close the prepared statement
            $checkQuery->close();
        } else {
            // Check if the entered student ID exists in the teacher table
            $checkTeacherQuery = $connection->prepare("SELECT ID FROM giaovien WHERE ID = ?");
            $checkTeacherQuery->bind_param("i", $username);
            $checkTeacherQuery->execute();
            $checkTeacherResult = $checkTeacherQuery->get_result();

            if ($checkTeacherResult->num_rows > 0) {
                // Entered ID matches a teacher's ID, display an error message
                echo "<script>alert('Giáo viên không thể nhập mã giáo viên vào tài khoản sinh viên.');";
                echo "window.location.href = 'giao_vien_themtaikhoan.php';</script>";

                // Close the prepared statement
                $checkTeacherQuery->close();
            } else {
                // Insert data into the database with the teacher's ID
                $insertQuery = $connection->prepare("INSERT INTO sinhvien (Username, Password, Email, IDGiaovien) VALUES (?, ?, ?, ?)");
                $insertQuery->bind_param("sssi", $username, $password, $email, $teacher_id);

                if ($insertQuery->execute()) {
                    echo "<script>alert('Tài khoản sinh viên đã được tạo thành công.');</script>";

                    // Redirect to the giao_vien_taikhoan.php page
                    header("Location: giao_vien_taikhoan.php");
                    exit();
                } else {
                    echo "Error: " . $sql . "<br>" . $connection->error;
                }

                // Close the prepared statement
                $insertQuery->close();
            }
        }
    }
} else {
    echo "Teacher is not logged in."; // Handle the case where the teacher is not logged in.
}

// Close the database connection
$connection->close();
?>