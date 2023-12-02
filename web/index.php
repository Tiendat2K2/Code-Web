<!DOCTYPE html>
<html lang="en">

<head>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./index.css">
    <link rel="icon" href="./Logo-DH-Thanh-Do-TDU.webp">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký</title>
</head>
<body>
    <!-- Inside your HTML form, add a hidden input to store the flag for duplicate -->
    <input type="hidden" id="duplicateFlag" name="duplicateFlag" value="">
    <!-- Modify the error message container -->
    <div id="error-message" style="color: red; display: none;"></div>
    <div class="container">
        <div class="form-box">
            <h1 id="title">Đăng Ký</h1>
            <form action="register.php" method="post">
                <div class="input-group">
                    <div class="input-field" id="nameField">
                        <i class='bx bxs-user'></i>
                        <input type="text" name="username" id="username" placeholder="Nhập mã giáo viên" required>
                    </div>
                    <div class="input-field">
                        <i class='bx bxs-lock-alt'></i>
                        <input type="password" name="password" placeholder="Nhập mật khẩu" required>
                    </div>
                    <div class="input-field" id="emailField">
                        <i class='bx bx-envelope'></i>
                        <input type="email" name="email" id="email" placeholder="Nhập email" required>
                    </div>
                    <p>Quên mật khẩu <a href="./quenmatkhau.php">Click here</a></p>
                    <p>Đăng Nhập <a href="./dangnhap.php">Click here</a></p>
                </div>
                <div class="btn-field">
                    <button type="submit" id="signupBtn" name="signup">Đăng ký</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>