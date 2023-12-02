<!DOCTYPE html>
<html lang="en">

<head>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./index.css">
    <link rel="icon" href="./Logo-DH-Thanh-Do-TDU.webp">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tài khoản sinh viên</title>
</head>

<body>
    <div class="container">
        <div class="form-box">
            <h1 id="title">Tài khoản sinh viên</h1>
            <form action="process_student.php" method="POST">
                <div class="input-group">
                    <div class="input-field" id="nameField">
                        <i class='bx bxs-user'></i>
                        <input type="text" name="Username" placeholder="Nhập mã sinh viên" required>
                    </div>
                    <div class="input-field">
                        <i class='bx bxs-lock-alt'></i>
                        <input type="password" name="Password" placeholder="Mật Khẩu" required>
                    </div>
                    <div class="input-field">
                        <i class='bx bx-envelope'></i>
                        <input type="email" name="Email" placeholder="Email" required>
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