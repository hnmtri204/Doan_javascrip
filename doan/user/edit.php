<?php
include_once "../dbconnect.php";
include_once "../functions.php";
if (!isset($_GET['id'])) {
  header('location:index.php');
}
$id = $_GET['id'];
$user = showUsers($id); 

?>
<?php include_once("../includes/header.php") ?>
<p class="fw-bold text-center fs-1">Trang chỉnh sửa tài khoản người dùng</p>
<div class="mb-3">
  <form action="" method="POST">
    <label for="name" class="form-label">Tên</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên danh mục sản phẩm" value="<?php echo $user['name']; ?>">
</div>
<div class="mb-3">
  <label for="Email" class="form-label">Email</label>
  <input type="text" class="form-control" id="Email" name="Email" placeholder="Nhập Email" value="<?php echo $user['Email']; ?>">
</div>
<div class="mb-3">
  <label for="password" class="form-label">Mật khẩu</label>
  <input type="text" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu" value="<?php echo $user['password']; ?>">
</div>
<button class="btn btn-primary" name="submit" type="submit"><i data-lucide="save"></i>
  Edit</button>
</form>
<?php include_once("../includes/footer.php") ?>
<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $Email = $_POST['Email'];
    $password = $_POST['password'];
    $created_at = date('Y-m-d H:i:s');
    $updated_at = date('Y-m-d H:i:s');


    // 5. Kiểm tra ràng buộc dữ liệu (Validation)
    // Tạo biến lỗi để chứa thông báo lỗi
    $errors = [];

    // --- Kiểm tra Tên của danh mục sản phẩm (validate)
    // required (bắt buộc nhập <=> không được rỗng)
    if (empty($name)) {
      $errors['name'][] = [
        'rule' => 'required',
        'rule_value' => true,
        'value' => $name,
        'msg' => 'Vui lòng nhập tên danh mục sản phẩm'
      ];
    }

    // minlength 5 (tối thiểu 5 ký tự)
    if (!empty($name) && strlen($name) < 5) {
      $errors['name'][] = [
        'rule' => 'minlength',
        'rule_value' => true,
        'value' => $name,
        'msg' => 'Tên phải ít nhất 5 ký tự'
      ];
    }
    // maxlength 30 (tối đa 30 ký tự)
    if (!empty($name) && strlen($name) > 30) {
      $errors['name'][] = [
        'rule' => 'maxlength',
        'rule_value' => true,
        'value' => $name,
        'msg' => 'Tên nhiều nhất 30 ký tự'
      ];
    }
    // minlength 5 (tối thiểu 5 ký tự)
    if (!empty($Email) && strlen($Email) < 5) {
      $errors['name'][] = [
        'rule' => 'minlength',
        'rule_value' => true,
        'value' => $Email,
        'msg' => 'Mô tả ít nhất 5 ký tự'
      ];
    }
    // maxlength 30 (tối đa 30 ký tự)
    if (!empty($Email) && strlen($Email) > 500) {
      $errors['name'][] = [
        'rule' => 'maxlength',
        'rule_value' => true,
        'value' => $Email,
        'msg' => 'Mô tả nhiều nhất 30 ký tự'
      ];
    }

    // 6. Thông báo lỗi cụ thể người dùng mắc phải (nếu vi phạm bất kỳ quy luật kiểm tra ràng buộc)
    // var_dump($errors);
    if (!empty($errors)) {
      foreach ($errors as $errorField) {
        foreach ($errorField as $error) {
          echo $error["msg"] . "</br>";
        }
      }
      return;
    }

    // 7. Nếu không có lỗi dữ liệu sẽ thực thi câu lệnh SQL
    // Câu lệnh INSERT

    $queryUpdate = "UPDATE users SET name = '$name', Email = '$Email', password = '$password', created_at = '$created_at',updated_at = '$updated_at' WHERE id = '$id'";

    if (mysqli_query($conn, $queryUpdate)) {
      // Đóng kết nối
      mysqli_close($conn);

      // Sau khi cập nhật dữ liệu, tự động điều hướng về trang Danh sách
      header('location:index.php');
    }
  }
?>