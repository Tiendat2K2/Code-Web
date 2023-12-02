<?php
// Include the database connection code (config.php)
include('config.php');

// Check if the 'id' query parameter is set and is a valid integer
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the record with the specified ID
    $query = "DELETE FROM `chitieu` WHERE ID = $id";

    if ($connection->query($query) === TRUE) {
        // Redirect to giao_vien_chitieu.php after successful deletion
        header("Location: giao_vien_chitieu.php");
        exit();
    } else {
        echo "Error deleting the record: " . $connection->error;
    }
} else {
    echo "Invalid or missing 'id' parameter.";
}

// Close the database connection
$connection->close();
?>