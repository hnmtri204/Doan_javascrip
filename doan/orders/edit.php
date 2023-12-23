<?php
include_once "../dbconnect.php";
include_once "../functions.php";
if (!isset($_GET['id'])) {
    header('location:index.php');
}
$id = $_GET['id'];
$orders = showOrder($id);
?>

<?php include_once("../includes/header.php") ?>
<p class="fw-bold text-center fs-1">Trang chỉnh sửa sản phẩm</p>
<form action="" method="POST">
    <div class="mb-3">
        <label for="name" class="form-label">Tên</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo $orders['name']; ?>">
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">SĐT</label>
        <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $orders['phone']; ?>">
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Giá</label>
        <input type="text" class="form-control" id="totalprice" name="totalprice" value="<?php echo $orders['totalprice']; ?>">
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Địa chỉ</label>
        <input type="text" class="form-control" id="address" name="address" value="<?php echo $orders['address']; ?>">
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Hình thức thanh toán</label>
        <input type="text" class="form-control" id="ispaid" name="ispaid" value="<?php echo $orders['ispaid']; ?>">
    </div>
    <button class="btn btn-primary" name="submit" type="submit"><i data-lucide="save"></i>Lưu</button>
</form>
<?php include_once("../includes/footer.php") ?>
<?php
if (isset($_POST['submit'])) {
    echo "post from client";
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $totalprice = $_POST['totalprice'];
    $address = $_POST['address'];
    $ispaid = $_POST['ispaid'];
    $errors = [];
    if (empty($name)) {
        $errors['name'][] = [
            'rule' => 'required',
            'rule_value' => true,
            'rule' => '$name',
            'msg' => 'Vui lòng nhập  sản phẩm'
        ];
    }
    if (!empty($name) && strlen($name) > 30) {
        $errors['name'][] = [
            'rule' => 'maxlength',
            'rule_value' => true,
            'value' => $name,
            'msg' => 'Tên nhiều nhất 30 ký tự'
        ];
    }
    if (!empty($phone) && strlen($phone) < 5) {
        $errors['name'][] = [
            'rule' => 'minlength',
            'rule_value' => true,
            'value' => $phone,
            'msg' => 'Mô tả ít nhất 5 ký tự'
        ];
    }
    if (!empty($phone) && strlen($phone) > 500) {
        $errors['name'][] = [
            'rule' => 'maxlength',
            'rule_value' => true,
            'value' => $phone,
            'msg' => 'Mô tả nhiều nhất 30 ký tự'
        ];
    }
    if (!empty($errors)) {
        foreach ($errors as $errorField) {
            foreach ($errorField as $error) {
                echo $error["msg"] . "</br>";
            }
        }
        return;
    }
    $queryUpdate = "UPDATE orders SET name = '$name', phone = '$phone', totalprice = '$totalprice', address='$address', ispaid='$ispaid' WHERE id='$id'";

    if (mysqli_query($conn, $queryUpdate)) {

        mysqli_close($conn);

        header('location:index.php');
    }
}
?>