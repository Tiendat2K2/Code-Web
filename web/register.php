<?php
// Include your database connection code
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["signup"])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Check if the username or email already exists
    $checkQuery = "SELECT * FROM giaovien WHERE Username = ? OR Email = ?";
    $checkStmt = $connection->prepare($checkQuery);

    if ($checkStmt) {
        $checkStmt->bind_param("ss", $username, $email);
        $checkStmt->execute();
        $result = $checkStmt->get_result();

        if ($result->num_rows > 0) {
            // Username or email already exists
            echo '<script>alert("tài khoản hoặc email đã tồn tại.");';
            echo 'window.location.href = "index.php";</script>';
        } else {
            // Insert the new user into the database
            $insertQuery = "INSERT INTO giaovien (Username, Password, Email) VALUES (?, ?, ?)";
            $insertStmt = $connection->prepare($insertQuery);

            if ($insertStmt) {
                $insertStmt->bind_param("sss", $username, $password, $email);

                if ($insertStmt->execute()) {
                    // Registration successful, redirect to dangnhap.php
                    header("Location: dangnhap.php");
                    exit();
                } else {
                    $error_message = "Lỗi đăng ký: " . $insertStmt->error;
                }
            } else {
                $error_message = "Lỗi trong truy vấn SQL: " . $connection->error;
            }
        }
        $checkStmt->close();
    } else {
        $error_message = "Lỗi trong truy vấn SQL: " . $connection->error;
    }
}

// Add the error message container just before the form
?>

