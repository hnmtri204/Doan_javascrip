<?php
include_once "../dbconnect.php";
include_once "../functions.php";
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    createProduct($name,$description,$price,$image);
}
?>
<?php include_once("../includes/header.php") ?>
<p class="fw-bold text-center fs-1">Trang thêm danh mục sản phẩm.</p>
<div class="mb-3">
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="name" class="form-label">Tên</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên danh mục sản phẩm">
</div>
<div class="mb-3">
    <label for="description" class="form-label">Mô tả</label>
    <textarea class="form-control" id="description" name="description" placeholder="Nhập mô tả danh mục sản phẩm"></textarea>
</div>
<div class="mb-3">
    <label for="price" class="form-label">Giá</label>
    <input type="text" class="form-control" id="price" name="price" placeholder="Nhập giá danh mục sản phẩm">
</div>
<div class="mb-3">
    <label for="image" class="form-label">Ảnh</label>
    <input type="file" class="form-control" id="fileToUpload" name="fileToUpload">
</div>
<button class="btn btn-primary" name="submit" type="submit"><i data-lucide="chevron-right-square"></i>Thêm</button>
</form>
<?php include_once("../includes/footer.php") ?>