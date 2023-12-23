<?php
include_once "../dbconnect.php";
include_once "../functions.php";
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $totalprice = $_POST['totalprice'];
    $address = $_POST['address'];
    $ispaid = $_POST['ispaid'];
    createOrder($name, $phone, $totalprice, $address, $ispaid);
}
?>
<?php include_once("../includes/header.php") ?>
<!-- <h1 class="fs-2 text-warning">Danh mục thêm sản phẩm</h1> -->
<form action="" method="post">
    <div class="mb-3">
        <div class="mb-3">
            <label for="name" class="form-label">Tên</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên sản phẩm">
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">SĐT</label>
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Nhập SĐT">
        </div>
        <div class="mb-3">
            <label for="totalprice" class="form-label">Giá</label>
            <input type="text" class="form-control" id="totalprice" name="totalprice" placeholder="Nhập giá">
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Địa chỉ</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Nhập địa chỉ">
        </div>
        <div class="mb-3">
            <label for="ispaid" class="form-label">Hình Thức Thanh Toán</label>
            <input type="text" class="form-control" id="ispaid" name="ispaid" placeholder="Nhập hình thức thanh toán">
        </div>
        <button class="btn btn-primary" name="submit" type="submit"><i data-lucide="save"></i> Lưu</button>
    </div>
</form>
<?php include_once("../includes/footer.php") ?>