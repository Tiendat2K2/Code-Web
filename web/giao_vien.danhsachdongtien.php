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
} else {
    // Handle the case where user data cannot be retrieved
    echo "User data not found.";
    header('Location: sinhvien_dongtien.php');
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
        <title>Danh Sách Đóng Tiền</title>
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
                    <h1 style="margin-left: 15px;">Danh Sách Đóng Tiền</h1>
                    <div class="danhsach1">
                        <div class="them" style="margin-left: -150px;">
                            <button><a href="./giao_vien_themdongtien.php">Thêm</a></button>
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
                                    <th>Ngày Đóng</th>
                                    <th>Đã Đóng</th>
                                    <th>Người Nhận</th>
                                    <th>Chức năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                            // Get the ID of the logged-in teacher from the session
                            if (isset($_SESSION['user_id'])) {
                                $user_id = $_SESSION['user_id'];
                                // Get the search query from the GET parameters
                                $search = isset($_GET['search']) ? $_GET['search'] : '';

                                // Prepare the SQL query
                                $query = "SELECT `ID`, `MSSV`, `HoTen`, `NgayDong`, `DaDong`, `NguoiNhan` FROM `dongtien` WHERE IDGiaoVien = '$user_id'";

                                // Add the search condition if a search query is provided
                                if (!empty($search)) {
                                    $query .= " AND (`MSSV` LIKE '%$search%' OR `HoTen` LIKE '%$search%')";
                                }

                                // Execute the query
                                $result = $connection->query($query);

                                // Check if there are any results
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $ID = $row['ID'];
                                        $MSSV = $row['MSSV'];
                                        $HoTen = $row['HoTen'];
                                        $NgayDong = $row['NgayDong'];
                                        $DaDong = $row['DaDong'];
                                        $NguoiNhan = $row['NguoiNhan'];

                                        echo "<tr>";
                                        echo "<td>$MSSV</td>";
                                        echo "<td>$HoTen</td>";
                                        echo "<td>$NgayDong</td>";
                                        echo "<td>$DaDong</td>";
                                        echo "<td>$NguoiNhan</td>";
                                        echo "<td><a href='giao_vien_suadanhsachdongtien.php?id=$ID'><i class=\"bx bx-pencil\" style=\"color: black;\"></i></a> | <a href='./delete_payment.php?stt=" . $row['ID'] . "'><i class='bx bxs-trash-alt' style='color: black;'></i></a></td>";
echo "</tr>";
                                    }
                                } else {
                                    echo '<tr><td colspan="6">Không có dữ liệu</td></tr>';
                                }

                                // Close the database connection
                                $connection->close();
                            } else {
                                echo "User ID not found.";
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>