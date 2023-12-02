<!DOCTYPE html>
<html lang="en">
<head>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./index.css">
    <link rel="icon" href="./Logo-DH-Thanh-Do-TDU.webp">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
</head>
<body>
    <div class="container">
        <div class="form-box">
            <h1 id="title">Đăng Nhập</h1>
            <form action="./login.php" method="POST">
            <select name="role" id="user_type">
                            <option value="teacher">Giáo Viên</option>
                            <option value="student" >Sinh viên</option>
                        </select>
                <div class="input-group">
                    <div class="input-field" id="nameField">
                        <i class='bx bxs-user'></i>
                        <input type="text" name="username" placeholder="Nhập mã sinh viên" required>
                    </div>
                    <div class="input-field">
                        <i class='bx bxs-lock-alt'></i>
                        <input type="password" name="password" placeholder="Nhập mật khẩu" required>
                    </div>
                    <p>Quên mật khẩu <a href="./quenmatkhau.php">Click here</a></p>
                    <p>Đăng ký <a href="./index.php">Click here</a></p>
                </div>
                <div class="btn-field">
                    <button type="submit" id="loginBtn" name="signin">Đăng Nhập</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>