<?php
// Include the config.php file to establish a database connection
require_once 'config.php';

// Check if the user_id parameter is set in the URL
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Prepare and execute a query to fetch teacher data by ID
    $query = "SELECT `ID`, `Username`, `Password`, `Email`, `HoTen`, `GioiTinh`, `NgaySinh`, `NoiSinh`, `LopHoc`, `KhoaHoc`, `BacDaoTao`, `LoaiHinhDaoTao`, `Nganh`, `FileAnh` FROM `giaovien` WHERE ID = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $user_id);  // Assuming ID is an integer
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Retrieve data and populate form fields
        $HoTen = $row['HoTen'];
        $GioiTinh = $row['GioiTinh'];
        $NgaySinh = $row['NgaySinh'];
        $NoiSinh = $row['NoiSinh'];
        $LopHoc = $row['LopHoc'];
        $KhoaHoc = $row['KhoaHoc'];
        $BacDaoTao = $row['BacDaoTao'];
        $LoaiHinhDaoTao = $row['LoaiHinhDaoTao'];
        $Nganh = $row['Nganh'];
        $FileAnh = $row['FileAnh'];
    }
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
    <title>Cập Nhật Thông Tin Giáo Viên</title>
</head>
<body>
    <div class="container">
        <div class="form-box">
            <h1 id="title">Cập nhật thông tin</h1>
            <form action="./giao_vienup.php" method="post" enctype="multipart/form-data">
                <div class="input-group">
                    <div class="input-field">
                        <i class='bx bxs-user'></i>
                        <input type="hidden" name="id" value="<?php echo $user_id; ?>">
                        <input type="text" id="HoTen" name="HoTen" placeholder="Nhập họ tên" value="<?php echo $HoTen; ?>" required>
                    </div>
                    <div class="input-field">
                        <i class='bx bxs-user'></i>
                        <input type="text" id="GioiTinh" name="GioiTinh" placeholder="Nhập giới tính" value="<?php echo $GioiTinh; ?>" required>
                    </div>
                    <div class="input-field">
                        <i class='bx bx-calendar'></i>
                        <input type="date" id="NgaySinh" name="NgaySinh" placeholder="Nhập ngày sinh"  value="<?php echo$NgaySinh;?>" required>
                    </div>
                    <div class="input-field">
                        <i class='bx bxs-user'></i>
                        <input type="text" id="NoiSinh" name="NoiSinh" placeholder="Nhập nơi sinh" value="<?php echo$NoiSinh;?>" required>
                    </div>
                    <div class="input-field">
                        <i class='bx bxs-user'></i>
                        <input type="text" id="LopHoc" name="LopHoc" placeholder="Nhập lớp học" value="<?php echo$LopHoc;?>" required>
                    </div>
                    <div class="input-field">
                        <i class='bx bxs-user'></i>
                        <input type="text" id="KhoaHoc" name="KhoaHoc" placeholder="Nhập khóa học" value="<?php echo$KhoaHoc;?>" required>
                    </div>
                    <div class="input-field">
                        <i class='bx bxs-user'></i>
                        <input type="text" id="BacDaoTao" name="BacDaoTao" placeholder="Nhập bậc đào tạo" value="<?php echo$BacDaoTao;?>" required>
                    </div>
                    <div class="input-field">
                        <i class='bx bxs-user'></i>
                        <input type="text" id="LoaiHinhDaoTao" name="LoaiHinhDaoTao" placeholder="Nhập loại hình đào tạo" value="<?php echo$LoaiHinhDaoTao;?>" required>
                    </div>
                    <div class="input-field">
                        <i class='bx bxs-user'></i>
                        <input type="text" id="Nganh" name="Nganh" placeholder="Nhập ngành" value="<?php echo$Nganh;?>" required>
                    </div>
                    <div class="input-field">
        <i class='bx bxs-user'></i>
        <input type="file" id="FileAnh" name="FileAnh" accept="image/*" value="<?php echo$FileAnh;?>" required> 
    </div>
                </div>
                <div class="btn-field">
                    <button type="submit" id="updateInfoBtn" name="updateInfoBtn">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>