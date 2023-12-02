<!DOCTYPE html>
<html lang="en">
<head>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./index.css">
    <link rel="icon" href="./Logo-DH-Thanh-Do-TDU.webp">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa danh sách lớp</title>
</head>

<body>
    <div class="container">
        <div class="form-box">
            <h1 id="title">Sửa danh sách lớp</h1>
            <?php
            require_once 'config.php';

            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
                $student_id = $_GET['id'];

                // Truy vấn SQL để lấy thông tin học sinh dựa trên ID
                $sql = "SELECT * FROM lop WHERE ID = $student_id";
                $result = $connection->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();

                    // Lấy thông tin từ kết quả truy vấn để điền vào các trường trong biểu mẫu
                    $masinhvien = $row["MSSV"];
                    $hoten = $row["HoTen"];
                    $gioitinh = $row["GioiTinh"];
                    $ngaysinh = $row["NgaySinh"];
                    $noisinh = $row["NoiSinh"];
                    $dantoc = $row["DanToc"];
                    $lophoc = $row["LopHoc"];
                    $khoahoc = $row["KhoaHoc"];
                    $sdt = $row["SDT"];

                    // Hiển thị biểu mẫu và điền dữ liệu từ kết quả truy vấn
                    echo '<form action="lopoup.php" method="post">
                            <div class="input-group">
                                <div class="input-field" id="nameField">
                                    <input type="hidden" name="student_id" value="' . $student_id . '">
                                    <i class="bx bxs-user"></i>
                                    <input type="text" name="masinhvien" placeholder="Nhập mã sinh viên" required value="' . $masinhvien . '" readonly>
                                </div>
                                <div class="input-field">
                                    <i class="bx bxs-user"></i>
                                    <input type="text" name="hoten" placeholder="Nhập họ tên" required value="' . $hoten . '">
                                </div>
                                <div class="input-field">
                                    <i class="bx bxs-user"></i>
                                    <input type="text" name="gioitinh" placeholder="Nhập giới tính" required value="' . $gioitinh . '">
                                </div>
                                <div class="input-field">
                                    <i class="bx bx-calendar"></i>
                                    <input type="date" name="ngaysinh" required value="' . $ngaysinh . '">
                                </div>
                                <div class="input-field">
                                    <i class="bx bxs-user"></i>
                                    <input type="text" name="noisinh" placeholder="Nhập nơi sinh" required value="' . $noisinh . '">
                                </div>
                                <div class="input-field">
                                    <i class="bx bxs-user"></i>
                                    <input type="text" name="dantoc" placeholder="Nhập dân tộc" required value="' . $dantoc . '">
                                </div>
                                <div class="input-field">
                                    <i class="bx bxs-user"></i>
                                    <input type="text" name="lophoc" placeholder="Nhập lớp học" required value="' . $lophoc . '">
                                </div>
                                <div class="input-field">
                                    <i class="bx bxs-user"></i>
                                    <input type="text" name="khoahoc" placeholder="Nhập khóa học" required value="' . $khoahoc . '">
                                </div>
                                <div class="input-field">
                                    <i class="bx bxs-phone-call"></i>
                                    <input type="text" name="sdt" placeholder="Nhập số điện thoại" required value="' . $sdt . '">
                                </div>
                            </div>
                            <div class="btn-field">
                                <button type="submit" id="updateBtn">Cập nhật</button>
                            </div>
                        </form>';
                } else {
                    echo "Học sinh không tồn tại.";
                }
            } else {
                echo "Lỗi: ID không hợp lệ.";
            }

            // Đóng kết nối đến cơ sở dữ liệu
            $connection->close();
            ?>
        </div>
    </div>
</body>
</html>