<!DOCTYPE html>
<html lang="en">
<head>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./index.css">
    <link rel="icon" href="./Logo-DH-Thanh-Do-TDU.webp">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đổi mật khẩu</title>
</head>

<body>
    <div class="container">
        <div class="form-box">
            <h1 id="title">Cập nhật mật khẩu</h1>
            <form action="./sinh_vienresetpassword.php" method="post" onsubmit="return checkPasswords()">
                <div class="input-group">
                    <div class="input-field" id="nameField">
                        <i class='bx bxs-lock-alt'></i>
                        <input type="password" name="password1" id="password1" placeholder="Nhập mật khẩu mới" required>
                    </div>
                    <div class="input-field">
                        <i class='bx bxs-lock-alt'></i>
                        <input type="password" name="password2" id="password2" placeholder="Nhập lại mật khẩu" required>
                    </div>
                </div>
                <div class="btn-field">
                    <button type="submit" name="updatePasswordBtn">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function checkPasswords() {
            var password1 = document.getElementById("password1").value;
            var password2 = document.getElementById("password2").value;

            if (password1 === password2) {
                return true; // Passwords match, form submission allowed
            } else {
                alert("Hai mật khẩu không giống nhau. Vui lòng nhập lại.");
                return false; // Passwords don't match, form submission blocked
            }
        }
    </script>
</body>

</html>