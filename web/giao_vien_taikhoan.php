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
$query = "SELECT * FROM giaovien WHERE ID = $user_id";
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
    header("Location: error_page.php");
}
?>
    <?php
// Include your database connection code (config.php)
include('config.php');

// Start the session

// Check if the teacher is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: dangnhap.php"); // Redirect to the login page if not logged in
    exit;
}

// Get the teacher's ID from the session
$teacherID = $_SESSION['user_id'];

// Initialize an empty array to store student data
$data = array();

// Handle search query
$searchQuery = "";
if (isset($_GET['search'])) {
    $searchQuery = $connection->real_escape_string($_GET['search']);
}

// Query to retrieve student data for the specific teacher, with optional search filter
$query = "SELECT `ID`, `Username`, `Password`, `Email`, `IDGiaovien` FROM `sinhvien` WHERE `IDGiaovien` = $teacherID";

if (!empty($searchQuery)) {
    $query .= " AND `Username` LIKE '%$searchQuery%'";
}

$result = $connection->query($query);

if ($result) {
    // Check if there are rows returned
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
}

// Close the database connection
$connection->close();
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <link rel="stylesheet" href="./giaovien.css">
            <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
            <link rel="icon" href="./Logo-DH-Thanh-Do-TDU.webp">
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Danh sách tài khoản sinh viên</title>
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
                        <h1 style="margin-left: 15px;">Tài khoản sinh viên</h1>
                        <div class="danhsach1">
                            <form action="#">
                                <div class="them">
                                    <button type="button"><a href="./giao_vien_themtaikhoan.php">Thêm</a></button>
                                </div>
                                <div class="them" style="float: left;">
                            <form action="" method="GET" class="search-form">
                                <input type="text" name="search" placeholder="Tìm kiếm..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" class="search-input" style="padding: 5px;">
                                <button type="submit">Tìm kiếm</button>
                            </form>
                        </div>
                                </form>
                                <table class="student-table">
                                    <thead>
                                        <tr>
                                            <th>MSV</th>
                                            <th>Mật Khẩu</th>
                                            <th>Email</th>
                                            <th>Chức năng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($data)): ?>
                                        <tr>
                                            <td colspan="4">Không có dữ liệu</td>
                                        </tr>
                                        <?php else: ?>
                                        <?php foreach ($data as $row): ?>
                                        <tr>
                                            <td>
                                                <?php echo $row['Username']; ?>
                                            </td>
                                            <td>
        <span id="password-<?php echo $row['ID']; ?>"><?php echo str_repeat('*', strlen($row['Password'])); ?></span>
        <i class='bx bxs-low-vision' onclick="togglePasswordVisibility(<?php echo $row['ID']; ?>)"></i>
    </td>
                                            <td>
                                                <?php echo $row['Email']; ?>
                                            </td>
                                            <td>
                                            <a href="giao_vien_suataikhoan.php?id=<?php echo $row['ID']; ?>"><i class="bx bx-pencil" style="color: black;"></i></a>
                                                <a href="./delete.php?id=<?php echo $row['ID']; ?>"><i class="bx bxs-trash-alt" style="color: black;"></i></a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </body>
        <script>
function togglePasswordVisibility(studentID) {
    const passwordElement = document.getElementById(`password-${studentID}`);
    const passwordIcon = document.querySelector(`[onclick="togglePasswordVisibility(${studentID})"]`);

    if (passwordElement.textContent.includes('*')) {
        passwordElement.textContent = '<?php echo $row['Password']; ?>';
        passwordIcon.classList.remove('bx bxs-low-vision');
        passwordIcon.classList.add('bx bxs-low-vision-off');
    } else {
        passwordElement.textContent = '<?php echo str_repeat('*', strlen($row['Password'])); ?>';
        passwordIcon.classList.remove('bx bxs-low-vision-off');
        passwordIcon.classList.add('bx bxs-low-vision');
    }
}
</script>

        </html>