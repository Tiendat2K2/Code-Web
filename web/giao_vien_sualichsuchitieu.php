<?php
include 'config.php';
session_start();
if (isset($_GET['id'])) {
    $recordID = $_GET['id'];
    // Check if the user has submitted the form for updating the record
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve the updated data from the form
        $soTienDangCo = $_POST['SoTienDangCo'];
        $daChi = $_POST['DaChi'];
        $ngayChi = $_POST['NgayChi'];
        $soTienConLai = $_POST['SoTienConLai'];
        $noiDungChi = $_POST['NoiDungChi'];
        $Anh = $_POST['Anh'];
        // Perform the update operation in the database
        $updateQuery = "UPDATE chitieu SET SoTienDangCo = ?, DaChi = ?, NgayChi = ?, SoTienConLai = ?, NoiDungChi = ? WHERE ID = ?";
        $stmt = $connection->prepare($updateQuery);
        $stmt->bind_param("sssssi", $soTienDangCo, $daChi, $ngayChi, $soTienConLai, $noiDungChi, $recordID);

        if ($stmt->execute()) {
            // Update successful, redirect to the list page or perform other actions
            header("Location: giao_vien_chitieu.php");
            exit();
        } else {
            echo "Update failed: " . $stmt->error;
        }
    }
    // Retrieve the existing record data for the specified ID
    $selectQuery = "SELECT SoTienDangCo, DaChi, NgayChi, SoTienConLai, NoiDungChi,Anh FROM chitieu WHERE ID = ?";
    $stmt = $connection->prepare($selectQuery);
    $stmt->bind_param("i", $recordID);
    $stmt->execute();
    $stmt->bind_result($soTienDangCo, $daChi, $ngayChi, $soTienConLai, $noiDungChi,$Anh);
    $stmt->fetch();
    // Close the prepared statement
    $stmt->close();
} else {
    // Handle the case where the 'id' parameter is not provided in the URL or other errors.
    echo "Record ID not specified or invalid.";
}
?>
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
            <h1 id="title">Cập nhật lịch sử chi tiêu</h1>
            <form action="giao_vien_sualichsuchitieu.php?id=<?php echo $recordID; ?>" method="POST">
                <div class="input-group">
                    <div class="input-field" id="nameField">
                        <i class='bx bxs-wallet-alt'></i>
                        <input type="text" name="SoTienDangCo" placeholder="Số Tiền Đang Có" value="<?php echo $soTienDangCo; ?>" required>
                    </div>
                    <div class="input-field">
                        <i class='bx bx-calendar'></i>
                        <input type="datetime-local" name="NgayChi" placeholder="Ngày Chi" value="<?php echo $ngayChi; ?>" required>
                    </div>
                    <div class="input-field">
                        <i class='bx bxs-wallet-alt'></i>
                        <input type="text" name="DaChi" placeholder="Đã chi" value="<?php echo $daChi; ?>" required>
                    </div>
                    <div class="input-field">
                        <i class='bx bxs-wallet-alt'></i>
                        <input type="text" name="SoTienConLai" placeholder="Số Tiền Còn Lại" value="<?php echo $soTienConLai; ?>" required>
                    </div>
                    <div class="input-field">
                        <i class='bx bx-text'></i>
                        <input type="text" name="NoiDungChi" placeholder="Nội Dung Chi" value="<?php echo $noiDungChi; ?>" required>
                    </div>
                    <div class="input-field">
    <label for="Anh">Ảnh</label>
    <img src="<?php echo $Anh; ?>" alt="Anh" style="width: 150px;">
</div>
                </div>
                <div class="btn-field">
                    <button type="submit" id="signupBtn">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</body>
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
</html>