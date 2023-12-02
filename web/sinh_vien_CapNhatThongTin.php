<?php
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Sử dụng thông tin kết nối từ tệp config.php
    include 'config.php';

    // Sử dụng prepared statement để truy vấn cơ sở dữ liệu
    $stmt = $connection->prepare("SELECT `ID`, `Username`, `Password`, `Email`, `IDGiaovien`, `HoTen`, `GioiTinh`, `NgaySinh`, `NoiSinh`, `LopHoc`, `KhoaHoc`, `BacDaoTao`, `LoaiHinhDaoTao`, `Nganh`, `FileAnh` FROM `sinhvien` WHERE ID = ?");
    $stmt->bind_param("i", $user_id);

    // Thực thi truy vấn
    $stmt->execute();

    // Lấy kết quả truy vấn
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Lấy thông tin người dùng
        $userInfo = $result->fetch_assoc();

        // Sau đó, bạn có thể sử dụng $userInfo để điền thông tin vào các trường dữ liệu trên form
        // Ví dụ: $userInfo['HoTen'], $userInfo['GioiTinh'], ...

    } else {
        echo "Không tìm thấy người dùng với ID: " . $user_id;
    }

    // Đóng kết nối cơ sở dữ liệu
    $stmt->close();
    $connection->close();
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
    <title>Cập Nhật Thông Tin Sinh Viên</title>
</head>
<body>
    <div class="container">
        <div class="form-box">
            <h1 id="title">Cập nhật thông tin</h1>
            <form action="./Sinhvienup.php" method="post" enctype="multipart/form-data">
            <div class="input-group">
                    <div class="input-field">
                        <i class='bx bxs-user'></i>
                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                        <input type="text" id="HoTen" name="HoTen" placeholder="Nhập họ tên" required value="<?php echo $userInfo['HoTen']; ?>">
                    </div>
                    <div class="input-field">
                        <i class='bx bxs-user'></i>
                        <input type="text" id="GioiTinh" name="GioiTinh" placeholder="Nhập giới tính" required value="<?php echo $userInfo['GioiTinh']; ?>">
                    </div>
                    <div class="input-field">
                        <i class='bx bx-calendar'></i>
                        <input type="date" id="NgaySinh" name="NgaySinh" placeholder="Nhập ngày sinh" required value="<?php echo $userInfo['NgaySinh']; ?>">
                    </div>
                    <div class="input-field">
                        <i class='bx bxs-user'></i>
                        <input type="text" id="NoiSinh" name="NoiSinh" placeholder="Nhập nơi sinh" required value="<?php echo $userInfo['NoiSinh']; ?>">
                    </div>
                    <div class="input-field">
                        <i class='bx bxs-user'></i>
                        <input type="text" id="LopHoc" name="LopHoc" placeholder="Nhập lớp học"  required value="<?php echo $userInfo['LopHoc']; ?>">
                    </div>
                    <div class="input-field">
                        <i class='bx bxs-user'></i>
                        <input type="text" id="KhoaHoc" name="KhoaHoc" placeholder="Nhập khóa học"  required value="<?php echo $userInfo['KhoaHoc']; ?>">
                    </div>
                    <div class="input-field">
                        <i class='bx bxs-user'></i>
                        <input type="text" id="BacDaoTao" name="BacDaoTao" placeholder="Nhập bậc đào tạo" required value="<?php echo $userInfo['BacDaoTao']; ?>">
                    </div>
                    <div class="input-field">
                        <i class='bx bxs-user'></i>
                        <input type="text" id="LoaiHinhDaoTao" name="LoaiHinhDaoTao" placeholder="Nhập loại hình đào tạo" required value="<?php echo $userInfo['LoaiHinhDaoTao']; ?>">
                    </div>
                    <div class="input-field">
                        <i class='bx bxs-user'></i>
                        <input type="text" id="Nganh" name="Nganh" placeholder="Nhập ngành"  required value="<?php echo $userInfo['Nganh']; ?>">
                    </div>
                    <div class="input-field">
                        <i class='bx bxs-user'></i>
                        <input type="file" id="FileAnh" name="FileAnh" accept="image/*" >
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