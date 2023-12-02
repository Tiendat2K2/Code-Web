<!DOCTYPE html>
<html lang="en">

<head>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./index.css">
    <link rel="icon" href="./Logo-DH-Thanh-Do-TDU.webp">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm danh sách lớp </title>
</head>

<body>
    <div class="container">
        <div class="form-box">
            <h1 id="title">Thêm danh sách lớp </h1>
            <form action="./themdanhsachlop1.php" method="POST"> <!-- Make sure to specify the correct action -->
    <div class="input-group">
        <div class="input-field" id="nameField">
            <i class='bx bxs-user'></i>
            <input type="text" name="masinhvien" placeholder="Nhập mã sinh viên" required>
        </div>
        <div class="input-field">
            <i class='bx bxs-user'></i>
            <input type="text" name="hoten" placeholder="Nhập họ tên" required>
        </div>
        <div class="input-field">
            <i class='bx bxs-user'></i>
            <input type="text" name="gioitinh" placeholder="Nhập giới tính" required>
        </div>
        <div class="input-field">
            <i class='bx bx-calendar'></i>
            <input type="date" name="ngaysinh" required>
        </div>
        <div class="input-field">
            <i class='bx bxs-user'></i>
            <input type="text" name="noisinh" placeholder="Nhập nơi sinh" required>
        </div>
        <div class="input-field">
            <i class='bx bxs-user'></i>
            <input type="text" name="dantoc" placeholder="Nhập dân tộc" required>
        </div>
        <div class="input-field">
            <i class='bx bxs-user'></i>
            <input type="text" name="lophoc" placeholder="Nhập lớp học" required>
        </div>
        <div class="input-field">
            <i class='bx bxs-user'></i>
            <input type="text" name="khoahoc" placeholder="Nhập khóa học" required>
        </div>
        <div class="input-field">
            <i class='bx bxs-phone-call'></i>
            <input type="text" name="sdt" placeholder="Nhập số điện thoại" required>
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