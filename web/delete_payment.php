<?php
// Include the database connection code (config.php)
include('config.php');

if (isset($_GET['stt'])) {
    $stt = $_GET['stt'];

    // Delete the record with the specified STT
    $query = "DELETE FROM dongtien WHERE ID = $stt";

    if ($connection->query($query) === TRUE) {
        // Redirect to the giao_vien.danhsachdongtien.php page
        header("Location: giao_vien.danhsachdongtien.php");
        exit();
    } else {
        echo "Error deleting record: " . $connection->error;
    }
} else {
    echo "STT parameter is missing.";
}

// Close the database connection
$connection->close();
?>