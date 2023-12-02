<?php
// Include the database connection code (config.php)
include('config.php');

session_start(); // Start the session

if (isset($_POST['delete']) && isset($_POST['teacher_id'])) {
    $teacher_id = $_POST['teacher_id'];

    // Use prepared statements to prevent SQL injection
    $delete_query = $connection->prepare("DELETE FROM lop WHERE ID = ?");
    $delete_query->bind_param("i", $teacher_id); // "i" indicates an integer parameter

    if ($delete_query->execute()) {
        echo "Xóa giáo viên thành công";
        header('Location: giao_vien_Danhsachlop.php'); // Redirect after successful deletion
    } else {
        // Log errors and display a user-friendly message
        error_log("Lỗi xóa giáo viên: " . $delete_query->error);
        echo "Xảy ra lỗi khi xóa giáo viên. Vui lòng thử lại sau.";
    }

    $delete_query->close(); // Close the prepared statement
}

// Close the database connection
$connection->close();
?>