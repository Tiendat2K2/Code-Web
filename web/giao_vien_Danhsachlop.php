<?php
require_once 'config.php';
session_start();

if (!isset($_SESSION['username']) || !isset($_SESSION['user_id'])) {
    header("Location: dangnhap.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM giaovien WHERE ID = $user_id";
$result = $connection->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Extract user data
    $Username = $row['Username'];
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
} else {
    echo "User data not foun";
    header('Location: sinh_vien_Danhsachlop.php');
   
}
// Handle the search query
$searchQuery = "";
if (isset($_GET['search'])) {
    $searchQuery = $_GET['search'];
}

// Query to retrieve data from the database
$query = "SELECT `ID`, `MSSV`, `HoTen`, `GioiTinh`, `NgaySinh`, `NoiSinh`, `DanToc`, `LopHoc`, `KhoaHoc`, `SDT` FROM `lop` WHERE IDGiaovien = '$user_id'";

if (!empty($searchQuery)) {
    $searchQuery = $connection->real_escape_string($searchQuery);
    $query .= " AND (`MSSV` LIKE '%$searchQuery%' OR `HoTen` LIKE '%$searchQuery%')";
}

$result = $connection->query($query);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="./giaovien.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" href="./Logo-DH-Thanh-Do-TDU.webp">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Sinh Viên</title>
</head>

<body>
    <div class="container">
        <div class="home">
            <div class="list">
                <div class="img">
                    <a href="./giao_vien_dashboard.php"><img src="./tải xuống.png" alt=""></a>
                </div>
                <div class="home1-bell-login">
                    <ul>
                        <li><a href="./giao_vien_dashboard.php"><i class='bx bxs-home'></i>Trang Chủ</a></li>
                        <li class="login-menu">
                            <a href="#"><i class='bx bxs-user'></i>Login</a>
                            <ul class="Menu" id="menu">
                                <li><a href="./giao_vien_CapNhatThongTin.php?user_id=<?php echo $user_id; ?>">Cập Nhật thông tin</a></li>
                                <li><a href="./giao_viencapnhatmatkhau.php">Đổi mật khẩu</a></li>
                                <li><a href="./logout.php">Đăng xuất</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="giaodien">
                <h1 style="margin-left: 15px;">Danh Sách Sinh Viên</h1>
                <div class="danhsach1">
                    <div class="them">
                        <button><a href="./giao_vien_themDanhsachlop.php">Thêm</a></button>
                    </div>
                    <div class="them" style="float: left;">
                            <form action="" method="GET" class="search-form">
                                <input type="text" name="search" placeholder="Tìm kiếm..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" class="search-input" style="padding: 5px;">
                                <button type="submit">Tìm kiếm</button>
                            </form>
                        </div>
                    <table class="student-table">
                        <thead>
                            <tr>
                                <th>MSV</th>
                                <th>Họ và tên</th>
                                <th>Giới tính</th>
                                <th>Ngày sinh</th>
                                <th>Nơi sinh</th>
                                <th>Dân tộc</th>
                                <th>Lớp học</th>
                                <th>Khóa học</th>
                                <th>Điện thoại</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result) {
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<tr>';
                                        echo '<td>' . $row['MSSV'] . '</td>';
                                        echo '<td>' . $row['HoTen'] . '</td>';
                                        echo '<td>' . $row['GioiTinh'] . '</td>';
                                        echo '<td>' . $row['NgaySinh'] . '</td>';
                                        echo '<td>' . $row['NoiSinh'] . '</td>';
                                        echo '<td>' . $row['DanToc'] . '</td>';
                                        echo '<td>' . $row['LopHoc'] . '</td>';
                                        echo '<td>' . $row['KhoaHoc'] . '</td>';
                                        echo '<td>' . $row['SDT'] . '</td>';
                                        echo '<td>';
                                        echo '<form action="giao_vien_suadanhsachlop.php" method="get">';
                                        echo '<input type="hidden" name="id" value="' . $row['ID'] . '">';
                                        echo '<button class="edit-button" type="submit" name="edit"><i class="bx bx-pencil"></i></button>';
                                        echo '</form>';
                                        echo '<form action="giao_vien.xoalop.php" method="post">';
                                        echo '<input type="hidden" name="teacher_id" value="' . $row['ID'] . '">';
                                        echo '<button class="delete-button" type="submit" name="delete"><i class="bx bxs-trash-alt"></i></button>';
                                        echo '</form>';
                                        echo '</td>';
                                        echo '</tr>';
                                    }
                                } else {
                                    echo '<tr><td colspan="10">Không có dữ liệu</td></tr>';
                                }
                            } else {
                                echo 'Lỗi truy vấn: ' . $connection->error;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    // Lấy tham chiếu đến phần tử menu
    const menu = document.getElementById("menu ");

    // Lấy tham chiếu đến phần tử "Login "
    const login = document.querySelector('.login-menu');

    // Thêm sự kiện click cho phần tử "Login "
    login.addEventListener('click', () => {
        // Kiểm tra trạng thái hiện tại của menu
        if (menu.style.display === "block ") {
            // Nếu đang hiển thị, ẩn đi
            menu.style.display = "none ";
        } else {
            // Nếu đang ẩn, hiển thị
            menu.style.display = "block ";
        }
    });
</script>

</html>