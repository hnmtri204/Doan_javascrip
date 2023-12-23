<?php
include_once "../dbconnect.php";
include_once "../functions.php";
$users = showAllUsers();
?>
<?php include_once("../includes/header.php") ?>
<h1 class="fs-2 text-warning">Trang tài khoản người dùng</h1>
<a href="./create.php" class="btn btn-primary d-inline-flex"><i data-lucide="plus"></i> Thêm</a>
<table class="table table-hover">
    <thead>
        <tr>
            <th>STT</th>
            <th>ID</th>
            <th>Tên</th>
            <th>Email</th>
            <th>Password</th>
            <th>Ngày tạo</th>
            <th>Ngày cập nhật</th>
            <th>###</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $us) { ?>
            <tr>
                <td><?php echo $us['index'] ?></td>
                <td><?php echo $us['id'] ?></td>
                <td><?php echo $us['name'] ?></td>
                <td><?php echo $us['Email'] ?></td>
                <td><?php echo $us['password'] ?></td>
                <td><?php echo $us['created_at'] ?></td>
                <td><?php echo $us['updated_at'] ?></td>
                <td>
                    <a href="./edit.php?id=<?php echo $us['id'] ?>" class="btn btn-primary"><i data-lucide="pencil"></i></a>
                    <a href="./delete.php?id=<?php echo $us['id'] ?>" class="btn btn-danger"><i data-lucide="trash-2"></i></a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<?php include_once("../includes/footer.php") ?>