<?php
include_once "../dbconnect.php";
include_once "../functions.php";

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $created_at = date('Y-m-d H:i:s'); 
    $updated_at = NULL;
    createCategories($name, $description);
}


?>
<?php include_once("../includes/header.php") ?>
<h1 class="fs-2 text-warning">Danh mục thêm sản phẩm</h1>
<form action="" method="post">
    <div class="mb-3">
        <div class="mb-3">
            <label for="name" class="form-label">Tên</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên sản phẩm">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <textarea class="form-control" id="description" name="description" rows="5"></textarea>
        </div>
        <button class="btn btn-primary" name="submit" type="submit"><i data-lucide="save"></i> Lưu</button>
    </div>
</form>
<?php include_once("../includes/footer.php") ?>