<?php
// Include the database connection configuration file
require_once 'config.php';
session_start();

// Check if the user is logged in; if not, redirect to the login page
if (!isset($_SESSION['username']) || !isset($_SESSION['user_id'])) {
    header("Location: dangnhap.php");
    exit;
}

// Retrieve the user's ID from the session
$user_id = $_SESSION['user_id'];

// Initialize variables to store student and teacher IDs
$student_id = $teacher_id = null;

// Query to retrieve student and teacher IDs
$query = "SELECT ID, IDGiaovien FROM sinhvien WHERE ID = $user_id";
$result = $connection->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $teacher_id = $row['IDGiaovien'];
} else {
    // Handle the case where user data cannot be retrieved
    echo "User data not found.";
    header('Location: giao_vien.danhsachdongtien.php');
}

// Handle search query
$searchQuery = "";
if (isset($_GET['search'])) {
    $searchQuery = $connection->real_escape_string($_GET['search']);
    $all_classes_query = "SELECT MSSV, HoTen, NgayDong, DaDong, NguoiNhan FROM dongtien WHERE IDGiaovien = $teacher_id AND (MSSV LIKE '%$searchQuery%' OR HoTen LIKE '%$searchQuery%')";
} else {
    $all_classes_query = "SELECT MSSV, HoTen, NgayDong, DaDong, NguoiNhan FROM dongtien WHERE IDGiaovien = $teacher_id";
}

$all_classes_result = $connection->query($all_classes_query);
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
        <div class "home">
            <div class="list">
                <div class="img">
                    <a href="./sinh_vien_dashboard.php"><img src="./tải xuống.png" alt=""></a>
                </div>
                <div class="home1-bell-login">
                    <ul>
                        <li><a href="./sinh_vien_dashboard.php"><i class='bx bxs-home'></i>Trang Chủ</a></li>
                        <li class="login-menu">
                            <a href="#"><i class='bx bxs-user'></i>Login</a>
                            <ul class="Menu" id="menu">
                            <li><a href="./sinh_vien_CapNhatThongTin.php?user_id=<?php echo $user_id; ?>">Cập Nhật thông tin</a></li>
                                <li><a href="./sinh_vienresetpassword.php">Đổi mật khẩu</a></li>
                                <li><a href="./logout.php">Đăng xuất</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="giaodien">
                <h1 style="margin-left: 15px;">Danh Sách Sinh Viên</h1>
                <div class="danhsach1">
                    <form action="#">
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
                                    <th>Ngày Đóng</th>
                                    <th>Đã Đóng</th>
                                    <th>Người Nhận</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
while ($class_row = $all_classes_result->fetch_assoc()) {
    echo '<tr>';
    echo '<td>' . $class_row['MSSV'] . '</td>';
    echo '<td>' . $class_row['HoTen'] . '</td>';
    echo '<td>' . $class_row['NgayDong'] . '</td>';
    echo '<td>' . $class_row['DaDong'] . '</td>';
    echo '<td>' . $class_row['NguoiNhan'] . '</td>';
    // Add other columns as needed
    echo '</tr>';
}

// Check if there is no data to display and add the "Không có dữ liệu" message
if ($all_classes_result->num_rows == 0) {
    echo '<tr><td colspan="5">Không có dữ liệu</td></tr>';
}
?>
                            </tbody>
                        </table>
                    </form>
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