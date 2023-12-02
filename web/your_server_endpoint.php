<?php
session_start();

include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $SoTienDangCo = mysqli_real_escape_string($connection, $_POST["SoTienDangCo"]);
    $NgayChi = mysqli_real_escape_string($connection, $_POST["NgayChi"]);
    $DaChi = mysqli_real_escape_string($connection, $_POST["DaChi"]);
    $SoTienConLai = mysqli_real_escape_string($connection, $_POST["SoTienConLai"]);
    $NoiDungChi = mysqli_real_escape_string($connection, $_POST["NoiDungChi"]);

    // File handling
    $targetDir = "uploads/";  // Specify the directory where you want to store uploaded files
    $targetFile = $targetDir . basename($_FILES["Anh"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the file is an image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["Anh"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check file size
    if ($_FILES["Anh"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["Anh"]["tmp_name"], $targetFile)) {
            echo "The file " . htmlspecialchars(basename($_FILES["Anh"]["name"])) . " has been uploaded.";
            $Anh = $targetFile;

            $sql = "INSERT INTO chitieu (SoTienDangCo, NgayChi, DaChi, SoTienConLai, NoiDungChi, Anh, IDGiaovien) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $connection->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("ssssssi", $SoTienDangCo, $NgayChi, $DaChi, $SoTienConLai, $NoiDungChi, $Anh, $_SESSION['user_id']);

                if ($stmt->execute()) {
                    header("Location: giao_vien_chitieu.php");
                    exit;
                } else {
                    echo "Error: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Error: " . $connection->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>