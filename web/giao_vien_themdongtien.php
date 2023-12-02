<!DOCTYPE html>
<html lang="en">

<head>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./index.css">
    <link rel="icon" href="./Logo-DH-Thanh-Do-TDU.webp">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm danh sách đóng tiền</title>
</head>
<body>
    <div class="container">
        <div class="form-box">
            <h1 id="title">Thêm danh sách đóng tiền</h1>
            <form action="./add_payment.php" method="POST">
                <div class="input-group">
                    <div class="input-field" id="nameField">
                        <i class='bx bxs-user'></i>
                        <input type="text" name="MSSV" placeholder="Nhập mã sinh viên" required>
                    </div>
                    <div class="input-field">
                        <i class='bx bxs-user'></i>
                        <input type="text" name="hoten" placeholder="Nhập họ tên" required>
                    </div>
                    <div class="input-field">
                        <i class='bx bx-calendar'></i>
                        <input type="datetime-local" name="date" placeholder="Nhập ngày đóng" required>
                    </div>
                    <div class="input-field">
                        <i class='bx bxs-wallet-alt'></i>
                        <input type="text" name="Dadong" placeholder="Đã Đóng" required>
                    </div>
                    <div class="input-field">
                        <i class='bx bxs-user'></i>
                        <input type="text" name="nguoiNhan" placeholder="Ngươi Nhận" required>
                    </div>
                </div>
                <div class="btn-field">
                    <button type="submit" id="signupBtn">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>