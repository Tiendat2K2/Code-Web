<!DOCTYPE html>
<html lang="en">

<head>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./index.css">
    <link rel="icon" href="./Logo-DH-Thanh-Do-TDU.webp">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu</title>
</head>
<body>
    <div class="container">
        <div class="form-box">
            <h1 id="title">Quên mật khẩu</h1>
            <form action="reset_passwod.php" method="post">
                <div class="input-group">
                    <div class="input-field" id="nameField">
                        <i class='bx bx-envelope'></i>
                        <input type="email" name="email" placeholder="Nhập email" required>
                    </div>
                    <div class="input-field">
                        <i class='bx bxs-lock-alt'></i>
                        <input type="password" name="new_password" placeholder="Nhập mật khẩu mới" required>
                    </div>
                    <p>Đăng Ký <a href="index.php">Click here</a></p>
                    <p>Đăng Nhập <a href="dangnhap.php">Click here</a></p>
                </div>
                <div class="btn-field">
                    <button type="submit" id="resetBtn">Cập Nhật</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>