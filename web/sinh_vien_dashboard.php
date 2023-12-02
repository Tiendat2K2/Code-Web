<?php
require_once 'config.php'; // Include the database configuration file
session_start();

if (!isset($_SESSION['username']) || !isset($_SESSION['user_id'])) {
    // If the user is not logged in, redirect to the login page or display an error message
    header("Location: dangnhap.php");
    exit;
}
// Retrieve the user's ID from the session
$user_id = $_SESSION['user_id'];
// Fetch user data from the database based on the user's ID
$query = "SELECT * FROM sinhvien WHERE ID = $user_id";
$result = $connection->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Extract user data
    $Username = $row['Username']; // Use 'Username' instead of 'MSSV'
    $LopHoc = $row['LopHoc'];
    $HoTen = $row['HoTen'];
    $KhoaHoc = $row['KhoaHoc'];
    $GioiTinh = $row['GioiTinh'];
    $BacDaoTao = $row['BacDaoTao'];
    $NgaySinh = $row['NgaySinh'];
    $LoaiHinhDaoTao = $row['LoaiHinhDaoTao'];
    $NoiSinh = $row['NoiSinh'];
    $Nganh = $row['Nganh'];
    $FileAnh = $row['FileAnh'];

    // Continue with your HTML code to display the user data
    // For example, you can display the Username like this:
} else {
    // Handle the case where user data cannot be retrieved
    echo "User data not found.";
    header('Location: giao_vien_dashboard.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="./giaovien.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" href="./Logo-DH-Thanh-Do-TDU.webp">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Tin Sinh Viên</title>
</head>

<body>
    <div class="container">
        <div class="home">
            <div class="list">
                <div class="img">
                    <a href="./sinh_vien_dashboard.php"><img src="./tải xuống.png" alt=""></a>
                </div>
                <div class="home1-bell-login">
                    <ul>
                        <li><a href="./sinh_vien_dashboard.php"><i class='bx bxs-home' ></i>Trang Chủ</a></li>
                        <li class="login-menu">
                        <a href="#"><i class='bx bxs-user'></i><?php echo $HoTen; ?></a>
                            <ul class="Menu" id="menu">
                                <li><a href="./sinh_vien_CapNhatThongTin.php?user_id=<?php echo $user_id; ?>">Cập Nhật thông tin</a></li>
                                <li><a href="./sinhvien_capnhatmatkhau.php?user_id=<?php echo $user_id; ?>">Đổi mật khẩu</a></li>
                                <li><a href="./logout.php">Đăng xuất</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="giaodien">
                <h1 style="margin-left: 15px;">Thông tin Sinh Viên</h1>
                <hr>
                <div class="img">
                <img src="<?php echo $FileAnh; ?>" alt="Hình ảnh">

                </div>
                <div class="danhsach">
                <div class="form-group" style="display: flex; flex-direction: row;">
                    <label class="col-xs-6"><span lang="sv-mssv">MSSV</span>: <span class="bold" style="color: #000;"><?php echo $Username; ?></span></label>
                    <label class="col-xs-6"><span lang="sv-lophoc">Lớp học</span>: <span class="bold" style="color: #000;"><?php echo $LopHoc; ?></span></label>
                </div>
                <div class="form-group" style="display: flex; flex-direction: row;">
                    <label class="col-xs-6"><span lang="sv-hoten">Họ tên</span>: <span class="bold" style="color: #000;"><?php echo $HoTen; ?></span></label>
                    <label class="col-xs-6"><span lang="sv-khoahoc">Khóa học</span>: <span class="bold" style="color: #000;"><?php echo $KhoaHoc; ?></span></label>
                </div>
                <div class="form-group" style="display: flex; flex-direction: row;">
                    <label class="col-xs-6"><span lang="sv-gioitinh">Giới tính</span>: <span class="bold" style="color: #000;"><?php echo $GioiTinh; ?></span></label>
                    <label class="col-xs-6"><span lang="sv-hedaotao">Bậc đào tạo</span>: <span class="bold" style="color: #000;"><?php echo $BacDaoTao; ?></span></label>
                </div>
                <div class="form-group" style="display: flex; flex-direction: row;">
                    <label class="col-xs-6">
                        <span lang="sv-ngaysinh">Ngày sinh</span>: <span class="bold" style="color: #000;"><?php echo $NgaySinh; ?></span>
                    </label>
                    <label class="col-xs-6"><span lang="sv-loaihinhdt">Loại hình đào tạo</span>: <span class="bold" style="color: #000;"><?php echo $LoaiHinhDaoTao; ?></span></label>
                </div>
                <div class="form-group" style="display: flex; flex-direction: row;">
                    <label class="col-xs-6"><span lang="sv-noisinh">Nơi sinh</span>: <span class="bold" style="color: #000;"><?php echo $NoiSinh; ?></span></label>
                    <label class="col-xs-6"><span lang="sv-nganh">Ngành</span>: <span class="bold" style="color: #000;"><?php echo $Nganh; ?></span></label>
                </div>
                <div class="trucnang " style="margin-left: 10px; width: 450px;">
                    <div class="lop">
                        <a href="sinh_vien_Danhsachlop.php"><i class='bx bx-menu' style="margin-left: 15px;"></i><br></a>
                        <a href="sinh_vien_Danhsachlop.php">Danh Sách lớp</a>
                    </div>
                    <div class="lop">
                        <a href="sinhvien_dongtien.php" style="font-size: 12px;"><i class='bx bxs-wallet-alt' style="margin-left: 15px;"></i><br></a>
                        <a href="sinhvien_dongtien.php" style="font-size: 12px;">Đã Đóng Tiền</a>
                    </div>
                    <div class="lop">
                        <a href="sinhvien_chitieu.php"><i class='bx bx-history' style="margin-left: 15px;"></i><br></a>
                        <a href="sinhvien_chitieu.php">Lịch sử chi tiêu</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    // Lấy tham chiếu đến phần tử menu
const menu = document.getElementById("menu");

// Lấy tham chiếu đến phần tử "Login"
const login = document.querySelector('.login-menu');

// Thêm sự kiện click cho phần tử "Login"
login.addEventListener('click', () => {
    // Kiểm tra trạng thái hiện tại của menu
    if (menu.style.display === "block") {
        // Nếu đang hiển thị, ẩn đi
        menu.style.display = "none";
    } else {
        // Nếu đang ẩn, hiển thị
        menu.style.display = "block";
    }
});
</script>
</html>