<?php
include_once "../dbconnect.php";
include_once "../functions.php";
if (!isset($_GET['id'])) {
    header('location:index.php');
}
$id = $_GET['id'];
$category = showCategories($id);
?>
<?php include_once("../includes/header.php") ?>
<h1 class="fs-2 text-warning">Danh mục sửa sản phẩm</h1>
<form action="" method="post">
    <div class="mb-3">
        <div class="mb-3">
            <label for="name" class="form-label">Tên</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên sản phẩm" value="<?php echo $category['description']; ?>">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <textarea class="form-control" id="description" name="description" rows="5" placeholder="Nhập mô tả sản phẩm" value="<?php echo $category['description']; ?>"></textarea>
        </div>
        <button class="btn btn-primary" name="submit" type="submit"><i data-lucide="save"></i> Lưu</button>
    </div>
</form>
<?php include_once("../includes/footer.php") ?>
<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $updated_at = date('Y-m-d H:i:s');;
    $errors = [];
    if (empty($name)) {
        $errors['name'][] = [
            'rule' => 'required',
            'rule_value' => true,
            'value' => $name,
            'msg' => 'Vui lòng nhập tên danh mục sản phẩm'
        ];
    }
    if (!empty($name) && strlen($name) < 5) {
        $errors['name'][] = [
            'rule' => 'minlength',
            'rule_value' => true,
            'value' => $name,
            'msg' => 'Tên phải ít nhất 5 ký tự'
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
    $queryUpdate = "UPDATE categories SET name = '$name', description = '$description', updated_at = '$updated_at' WHERE id='$id'";
    if (mysqli_query($conn, $queryUpdate)) {
        mysqli_close($conn);
        header('location:index.php');
    }
}
?>