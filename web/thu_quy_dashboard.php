<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="./giaovien.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" href="./Logo-DH-Thanh-Do-TDU.webp">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Tin Thủ Qũy</title>
</head>

<body>
    <div class="container">
        <div class="home">
            <div class="list">
                <div class="img">
                    <a href="./thu_quy_dashboard.html"><img src="./tải xuống.png" alt=""></a>
                </div>
                <div class="home1-bell-login">
                    <ul>
                        <li><a href="./thu_quy_dashboard.html"><i class='bx bxs-home' ></i>Trang Chủ</a></li>
                        <li class="login-menu">
                            <a href="#"><i class='bx bxs-user'></i>Login</a>
                            <ul class="Menu" id="menu">

                                <li><a href="./thu_quy_capnhatthongtin.html">Cập Nhật thông tin</a></li>
                                <li><a href="thu_quy_capnhatmatkhau.html">Đổi mật khẩu</a></li>
                                <li><a href="./dangnhap.html">Đăng xuất</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="giaodien">
                <h1 style="margin-left: 15px;">Thông tin Sinh Viên</h1>
                <hr>
                <div class="img">
                    <img src="./tải xuống (1).png" alt="">

                </div>
                <div class="danhsach">
                    <div class="form-group" style="display: flex; flex-direction: row;">
                        <label class="col-xs-6"><span lang="sv-mssv">MSSV</span>: <span class="bold">2100535</span></label>
                        <label class="col-xs-6"><span lang="sv-lophoc">Lớp học</span>: <span class="bold">D101AK13</span></label>
                    </div>
                    <div class="form-group" style="display: flex; flex-direction: row;">
                        <label class="col-xs-6"><span lang="sv-hoten">Họ tên</span>: <span class="bold">Nguyễn Tiến Đạt</span></label>
                        <label class="col-xs-6"><span lang="sv-khoahoc">Khóa học</span>: <span class="bold">13</span></label>
                    </div>
                    <div class="form-group" style="display: flex; flex-direction: row;">
                        <label class="col-xs-6"><span lang="sv-gioitinh">Giới tính</span>: <span class="bold">Nam</span></label>
                        <label class="col-xs-6"><span lang="sv-hedaotao">Bậc đào tạo</span>: <span class="bold">Đại học</span></label>
                    </div>
                    <div class="form-group" style="display: flex; flex-direction: row;">
                        <label class="col-xs-6">
                            <span lang="sv-ngaysinh">Ngày sinh</span>: <span class="bold">20/10/2003</span>
                        </label>
                        <label class="col-xs-6"><span lang="sv-loaihinhdt">Loại hình đào tạo</span>: <span class="bold">Chính quy</span></label>
                    </div>
                    <div class="form-group" style="display: flex; flex-direction: row;">
                        <label class="col-xs-6"><span lang="sv-noisinh">Nơi sinh</span>: <span class="bold">Hà Nội</span></label>
                        <label class="col-xs-6"><span lang="sv-nganh">Ngành</span>: <span class="bold">Công nghệ thông tin</span></label>
                    </div>
                </div>
                <div class="trucnang" style="margin-left: 150px;">
                    <div class="lop">
                        <i class='bx bx-menu'></i><br>
                        <a href="./thu_quy_Danhsachlop.html">Danh Sách lớp</a>
                    </div>
                    <div class="lop">
                        <i class='bx bxs-wallet-alt'></i><br>
                        <a href="./thu_quy_dongtien.html" style="font-size: 12px;margin-left: 14px;">Danh Sách Đóng Tiền</a>
                    </div>
                    <div class="lop">
                        <i class='bx bx-history'></i><br>
                        <a href="./thu_quy_chitieu.html">Lịch sử chi tiêu</a>
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