<?php
require_once('config.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['email']) && isset($_POST['new_password'])) {
        $email = $_POST['email'];
        $new_password = $_POST['new_password'];

        // Query to check if the email exists in the teacher (giaovien) table
        $teacher_query = "SELECT * FROM giaovien WHERE Email = ?";
        // Query to check if the email exists in the student (sinhvien) table
        $student_query = "SELECT * FROM sinhvien WHERE Email = ?";

        // Use a prepared statement to avoid SQL injection
        $stmt_teacher = $connection->prepare($teacher_query);
        $stmt_teacher->bind_param("s", $email);
        $stmt_teacher->execute();
        $result_teacher = $stmt_teacher->get_result();

        // Use a separate prepared statement for students
        $stmt_student = $connection->prepare($student_query);
        $stmt_student->bind_param("s", $email);
        $stmt_student->execute();
        $result_student = $stmt_student->get_result();

        if ($result_teacher->num_rows == 1) {
            // Email exists in teacher table, update the teacher's password
            $update_query = "UPDATE giaovien SET password = ? WHERE Email = ?";
            $update_stmt = $connection->prepare($update_query);
            $update_stmt->bind_param("ss", $new_password, $email);

            if ($update_stmt->execute()) {
                echo "Mật khẩu của giáo viên đã được cập nhật thành công.";
                header("Location: dangnhap.php");
                exit();
            } else {
                echo "Lỗi khi cập nhật mật khẩu: " . $update_stmt->error;
            }
            $update_stmt->close();
        } elseif ($result_student->num_rows == 1) {
            // Email exists in student table, update the student's password
            $update_query = "UPDATE sinhvien SET password = ? WHERE Email = ?";
            $update_stmt = $connection->prepare($update_query);
            $update_stmt->bind_param("ss", $new_password, $email);

            if ($update_stmt->execute()) {
                echo "Mật khẩu của sinh viên đã được cập nhật thành công.";
                header("Location: dangnhap.php");
                exit();
            } else {
                echo "Lỗi khi cập nhật mật khẩu: " . $update_stmt->error;
            }
            $update_stmt->close();
        } else {
            echo '<script>window.alert("Email không tồn tại.");</script>';
            echo '<script>window.location.href = "quenmatkhau.php";</script>';
            exit();
        }
        $stmt_teacher->close();
        $stmt_student->close();
    }
}
$connection->close();
?>