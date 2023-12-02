<!DOCTYPE html>
<html lang="en">
<head>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./index.css">
    <link rel="icon" href="./Logo-DH-Thanh-Do-TDU.webp">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch sử chi tiêu</title>
</head>
<body>
    <div class="container">
        <div class="form-box">
            <h1 id="title">Thêm Lịch sử chi tiêu</h1>
            <form action="your_server_endpoint.php" method="POST" enctype="multipart/form-data">
                <!-- Ensure to add enctype="multipart/form-data" for file uploads -->
                <div class="input-group">
                    <div class="input-field" id="nameField">
                        <i class='bx bxs-wallet-alt'></i>
                        <input type="text" name="SoTienDangCo" placeholder="Số Tiền Đang Có" required>
                    </div>
                    <div class="input-field">
                        <i class='bx bx-calendar'></i>
                        <input type="datetime-local" name="NgayChi" placeholder="Ngày Chi" required>
                    </div>
                    <div class="input-field">
                        <i class='bx bxs-wallet-alt'></i>
                        <input type="text" name="DaChi" placeholder="Đã chi" required>
                    </div>
                    <div class="input-field">
                        <i class='bx bxs-wallet-alt'></i>
                        <input type="text" name="SoTienConLai" placeholder="Số Tiền Còn Lại" required>
                    </div>
                    <div class="input-field">
                        <i class='bx bx-text'></i>
                        <input type="text" name="NoiDungChi" placeholder="Nội Dung Chi" required>
                    </div>
                    <div class="input-field">
        <i class='bx bx-image-add'></i>
        <input type="file" name="Anh" accept="image/*">
    </div>
                </div>
                <div class="btn-field">
                    <button type="submit" id="signupBtn">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Your existing script for updating SoTienConLai -->
    <script>
        // Lấy các trường đầu vào và sử dụng sự kiện "input" để theo dõi thay đổi
        const soTienDangCoInput = document.querySelector('input[name="SoTienDangCo"]');
        const daChiInput = document.querySelector('input[name="DaChi"]');
        const soTienConLaiInput = document.querySelector('input[name="SoTienConLai"]');

        // Sử dụng sự kiện "input" để tính toán Số Tiền Còn Lại khi có sự thay đổi
        soTienDangCoInput.addEventListener('input', updateSoTienConLai);
        daChiInput.addEventListener('input', updateSoTienConLai);

        function updateSoTienConLai() {
            const soTienDangCo = parseFloat(soTienDangCoInput.value) || 0;
            const daChi = parseFloat(daChiInput.value) || 0;

            // Tính toán Số Tiền Còn Lại
            const soTienConLai = soTienDangCo - daChi;

            // Cập nhật giá trị của trường Số Tiền Còn Lại
            soTienConLaiInput.value = soTienConLai;
        }
    </script>
</body>
</html>