<?php
include('config.php');

// Check if the 'id' query parameter is set
if (isset($_GET['id'])) {
    // Sanitize the 'id' parameter to prevent SQL injection
    $studentID = $connection->real_escape_string($_GET['id']);

    // Query to retrieve data for the specific student
    $query = "SELECT `ID`, `Username`, `Password`, `Email`, `IDGiaovien` FROM `sinhvien` WHERE `ID` = $studentID";
    $result = $connection->query($query);

    if ($result) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Store retrieved data in variables
            $ID = $row['ID'];
            $Username = $row['Username'];
            $Password = $row['Password'];
            $Email = $row['Email'];
            $IDGiaovien = $row['IDGiaovien'];
        } else {
            // Handle the case where no data is found for the specified student
            echo "Không tìm thấy dữ liệu cho sinh viên này.";
        }
    } else {
        echo 'Lỗi truy vấn: ' . $connection->error;
    }
} else {
    // Handle the case where 'id' query parameter is not set
    echo "Thiếu thông tin sinh viên.";
}

// Close the database connection
$connection->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./index.css">
    <link rel="icon" href="./Logo-DH-Thanh-Do-TDU.webp">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật thông tin sinh viên</title>
</head>

<body>
    <div class="container">
        <div class="form-box">
            <h1 id="title">Cập nhật tài khoản thông tin sinh viên</h1>
            <form action="update.php" method="POST">
                <div class="input-group">
                    <div class="input-field" id="nameField">
                        <i class='bx bxs-user'></i>
                        <input type="text" name="Username" value="<?php echo $Username; ?>" placeholder="Mã sinh viên" required readonly>
                    </div>
                    <div class="input-field">
                        <i class='bx bxs-lock-alt'></i>
                        <input type="password" name="Password" value="<?php echo $Password; ?>" placeholder="Mật Khẩu" required>
                    </div>
                    <div class="input-field">
                        <i class='bx bx-envelope'></i>
                        <input type="email" name="Email" value="<?php echo $Email; ?>" placeholder="Email" required>
                    </div>
                    
                    <div class="input-field">
                        
                    </div>
                </div>

                <div class="btn-field">
                    <button type="submit" id="updateBtn">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>