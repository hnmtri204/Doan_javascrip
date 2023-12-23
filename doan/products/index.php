<?php
include_once "../dbconnect.php";
include_once "../functions.php";
$products = showAllProducts();

?>
<?php include_once("../includes/header.php") ?>
<p class="fw-bold text-center fs-1">Trang danh mục sản phẩm</p>
<a href="./created.php" class="btn btn-primary d-inline"><i data-lucide="plus"></i> Thêm</a>
<table class="table table-hover">
    <thead>
        <tr>
            <th>STT</th>
            <th>ID</th>
            <th>Tên</th>
            <th>Mô tả</th>
            <th>Đơn giá</th>
            <th>Ảnh</th>
            <th>Ngày tạo</th>
            <th>Ngày cập nhật</th>
            <th>###</th>
        </tr>
    <tbody>
        <?php foreach ($products as $cat) { ?>
            <tr>
                <td><?php echo $cat['index'] ?></td>
                <td><?php echo $cat['id'] ?></td>
                <td><?php echo $cat['name'] ?></td>
                <td><?php echo $cat['description'] ?></td>
                <td><?php echo $cat['price'] ?></td>
                <td><img src="<?php echo $cat['image']; ?>" style="max-width: 100px; max-height: 100px;"></td>
                <td><?php echo $cat['created_at'] ?></td>
                <td><?php echo $cat['updated_at'] ?></td>
                <td>
                    <a href="./edit.php ?id=<?php echo $cat['id'] ?>" class="btn btn-primary"><i data-lucide="pencil"></i></a>
                    <a href="./delete.php ?id=<?php echo $cat['id'] ?>" class="btn btn-danger"><i data-lucide="trash"></i></a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
    </thead>
</table>
<?php include_once("../includes/footer.php") ?>