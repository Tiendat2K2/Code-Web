<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Include the database connection code (config.php)
    include('config.php');

    // Query to retrieve data based on ID
    $query = "SELECT `ID`, `MSSV`, `HoTen`, `NgayDong`, `DaDong`, `NguoiNhan` FROM `dongtien` WHERE ID = '$id'";
    $result = $connection->query($query);

    if ($result) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Store retrieved data in variables
            $MSV = $row['MSSV'];
            $HoTen = $row['HoTen'];
            $NgayDong = $row['NgayDong'];
            $DaDong = $row['DaDong'];
            $NguoiNhan = $row['NguoiNhan'];
        } else {
            // Handle the case where no matching record is found
            echo "Không tìm thấy bản ghi với ID: $id";
        }
    } else {
        echo 'Lỗi truy vấn: ' . $connection->error;
    }

    // Close the database connection
    $connection->close();
} else {
    // Handle the case where ID is not provided in the URL.
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./index.css">
    <link rel="icon" href="./Logo-DH-Thanh-Do-TDU.webp">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa danh sách đóng tiền</title>
</head>

<body>
    <div class="container">
        <div class="form-box">
            <h1 id="title">Sửa danh sách đóng tiền</h1>
            <form action="./update_personal_info.php" method="POST">
                <div class="input-group">
                    <div class="input-field" id="nameField">
                        <i class='bx bxs-user'></i>
                        <input type="text" name="MSV" value="<?php echo $MSV; ?>" placeholder="Nhập mã sinh viên" required readonly>
                    </div>
                    <div class="input-field">
                        <i class='bx bxs-user'></i>
                        <input type="text" name="HoTen" value="<?php echo $HoTen; ?>" placeholder="Nhập họ tên" required>
                    </div>
                    <div class="input-field">
                        <i class='bx bx-calendar'></i>
                        <input name="NgayDong" type="datetime-local" value="<?php echo $NgayDong; ?>" required>
                    </div>
                    <div class="input-field">
                        <i class='bx bxs-wallet-alt'></i>
                        <input type="text" name="DaDong" value="<?php echo $DaDong; ?>" placeholder="Đã Đóng" required>
                    </div>
                    <div class="input-field">
                        <i class='bx bxs-user'></i>
                        <input type="text" name="NguoiNhan" value="<?php echo $NguoiNhan; ?>" placeholder="Ngươi Nhận" required>
                    </div>
                </div>
                <div class="btn-field">
                    <button type="submit" id="signupBtn">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>