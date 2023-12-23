<?php
include_once "../dbconnect.php";
include_once "../functions.php";
if (!isset($_GET['id'])) {
    header('location:index.php');
}
$id = $_GET['id'];
$products = showProducts($id);
?>

<?php include_once("../includes/header.php") ?>
<p class="fw-bold text-center fs-1">Trang sửa danh mục sản phẩm.</p>
<div class="mb-3">
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="name" class="form-label">Tên</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo $products['name']; ?>">
</div>
<div class="mb-3">
    <label for="description" class="form-label">Mô tả</label>
    <input type="text" class="form-control" id="description" name="description" value="<?php echo $products['description']; ?>">
</div>
<div class="mb-3">
    <label for="price" class="form-label">Giá</label>
    <input type="text" class="form-control" id="price" name="price" value="<?php echo $products['price']; ?>">
</div>
<div class="mb-3">
    <label for="image" class="form-label">Ảnh</label>
    <input type="file" class="form-control" id="fileToUpload" name="fileToUpload" value="<?php echo $products['image']; ?>">
</div>
<button class="btn btn-primary" name="submit" type="submit"><i data-lucide="save"></i>Edit</button>
</form>

<?php include_once("../includes/footer.php") ?>
<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_POST['image'];
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
    if (!empty($description) && strlen($description) < 5) {
        $errors['name'][] = [
            'rule' => 'minlength',
            'rule_value' => true,
            'value' => $description,
            'msg' => 'Mô tả ít nhất 5 ký tự'
        ];
    }
    if (!empty($description) && strlen($description) > 500) {
        $errors['name'][] = [
            'rule' => 'maxlength',
            'rule_value' => true,
            'value' => $description,
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
    $queryUpdate = "UPDATE products SET name = '$name', description = '$description', price = '$price', image='$image' WHERE id='$id'";

    if (mysqli_query($conn, $queryUpdate)) {
        mysqli_close($conn);
        header('location:index.php');
    }
}
?>