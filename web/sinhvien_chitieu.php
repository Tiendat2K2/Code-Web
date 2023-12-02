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

// Query to retrieve the teacher ID
$query = "SELECT IDGiaovien FROM sinhvien WHERE ID = $user_id";
$result = $connection->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $teacherID = $row['IDGiaovien'];
} else {
    // Handle the case where user data cannot be retrieved
    echo "User data not found.";
    header('Location: giao_vien_chitieu.php');
   
    exit;
}

// Handle search query
$searchQuery = "";
if (isset($_GET['search'])) {
    $searchQuery = $connection->real_escape_string($_GET['search']);
    $queryExpenses = "SELECT `SoTienDangCo`, `DaChi`, `NgayChi`, `SoTienConLai`, `NoiDungChi`,Anh FROM `chitieu` WHERE IDGiaovien = $teacherID AND `NgayChi` LIKE '%$searchQuery%'";
} else {
    $queryExpenses = "SELECT `SoTienDangCo`, `DaChi`, `NgayChi`, `SoTienConLai`, `NoiDungChi`,Anh FROM `chitieu` WHERE IDGiaovien = $teacherID";
}

$resultExpenses = $connection->query($queryExpenses);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="./giaovien.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" href="./Logo-DH-Thanh-Do-TDU.webp">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch sử chi tiêu</title>
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
                <h1 style="margin-left: 15px;">Lịch sử chi tiêu</h1>
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
                                    <th>Số Tiền Đang Có</th>
                                    <th>Đã Chi</th>
                                    <th>Ngày Chi</th>
                                    <th>Số Tiền Còn Lại</th>
                                    <th>Nội Dung Chi</th>
                                    <th>Anh</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php while ($expense_row = $resultExpenses->fetch_assoc()) { ?>
    <tr>
        <td><?php echo $expense_row['SoTienDangCo']; ?></td>
        <td><?php echo $expense_row['DaChi']; ?></td>
        <td><?php echo $expense_row['NgayChi']; ?></td>
        <td><?php echo $expense_row['SoTienConLai']; ?></td>
        <td><?php echo $expense_row['NoiDungChi']; ?></td>
        <td>
                <a href="#" onclick="showImage('<?php echo $expense_row['Anh']; ?>')" style="text-decoration: none;">View Image</a>
            </td>
    </tr>
<?php }

// Check if there is no data to display and add the "Không có dữ liệu" message
if ($resultExpenses->num_rows == 0) {
    echo '<tr><td colspan="6">Không có dữ liệu</td></tr>';
}
?>
 <div id="imageModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeImageModal()">&times;</span>
            <img id="modalImage" class="modal-img" src="" alt="Image">
        </div>
    </div>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<style>
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
        }

        .modal-content {
            display: block;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            max-width: 80%;
            max-height: 80%;
            background: #fff;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        }

        .modal-img {
            display: block;
            width: 100%;
            max-height: 100%;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            color: #000;
            font-size: 20px;
            cursor: pointer;
        }
    </style>
<script>
    function showImage(imageSrc) {
            var modal = document.getElementById("imageModal");
            var modalImage = document.getElementById("modalImage");
            modalImage.src = imageSrc;
            modal.style.display = "block";
        }

        // Function to close the image modal
        function closeImageModal() {
            var modal = document.getElementById("imageModal");
            modal.style.display = "none";
        }
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