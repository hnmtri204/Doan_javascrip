<?php
include_once "../dbconnect.php";
include_once "../functions.php";

$errors = []; // Mảng lưu trữ các lỗi nếu có
$message = ""; // Biến thông báo

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Lấy dữ liệu từ form và làm sạch
    $name = trim($_POST['name']);
    $password = $_POST['password'];
    $Email = trim($_POST['Email']);

    // Kiểm tra xem tên đã tồn tại trong cơ sở dữ liệu
    if (usernameExists($name, $pdo)) {
        $errors[] = "Tên đã tồn tại. Vui lòng sử dụng tên khác.";
    } else {
        // Hash mật khẩu trước khi lưu vào cơ sở dữ liệu
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Thực hiện việc thêm dữ liệu mới vào cơ sở dữ liệu
        $query = "INSERT INTO users (name, Email, password) VALUES (:name, :email, :password)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $Email);
        $stmt->bindParam(':password', $passwordHash);

        if ($stmt->execute()) {
            // Đăng ký thành công
            $message = "Đăng ký thành công!";
        } else {
            // Đăng ký thất bại
            $errors[] = "Đã xảy ra lỗi. Vui lòng thử lại sau.";
        }
    }
}
?>
<!-- Hiển thị thông báo lỗi nếu có -->
<?php foreach ($errors as $error) : ?>
    <p><?= $error ?></p>
<?php endforeach; ?>

<!-- Hiển thị thông báo đăng ký thành công -->
<?php if (!empty($message)) : ?>
    <p><?= $message ?></p>
<?php endif; ?>

<!-- Form đăng ký -->
<?php include_once("../includes/header.php") ?>
<p class="fw-bold text-center fs-1">Register</p>
<div class="mb-3">
    <form action="" method="POST">
        <label for="name" class="form-label">Tên</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên">
</div>
<div class="mb-3">
    <label for="Email" class="form-label">Email</label>
    <input type="text" class="form-control" id="Email" name="Email" placeholder="Nhập email">
</div>
<div class="mb-3">
    <label for="password" class="form-label">Mật khẩu</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu">
</div>
<button class="btn btn-primary" name="submit" type="submit"><i data-lucide="save"></i>
    Thêm</button>
    </form>
    <?php include_once("../includes/footer.php") ?>
