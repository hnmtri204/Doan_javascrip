<?php
include "../dbconnect.php";

// FunctionsUsers
function showAllUsers()
{
  global $conn;
  $query = "SELECT * FROM users";
  $result = mysqli_query($conn, $query);

  $users = [];
  $rowNum = 1;
  if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $users[] = array(
        "index" => $rowNum++,
        "id" => $row['id'],
        "name" => $row['name'],
        "Email" => $row['Email'],
        "password" => $row['password'],
        "created_at" => $row['created_at'],
        "updated_at" => $row['updated_at'],
      );
    }
  }
  return $users;
}

function showUsers($id)
{
  global $conn;
  $query = "SELECT * FROM users WHERE id=$id";
  $result = mysqli_query($conn, $query);
  $row = $result->fetch_assoc();
  if (empty($row)) {
    echo "Giá trị id: $id không tồn tại. Vui lòng kiểm tra lại.";
    header("Location:index.php");
  }
  return $row;
}


function createUser($name, $password, $Email)
{
    global $conn;
    validateCreateUser($name);
    $queryInsert = "INSERT INTO users (name, Email, password) VALUES ('$name', '$Email', '$password')";
    if (mysqli_query($conn, $queryInsert)) {
        // header('location:login.php'); // It's better to handle redirection outside this function
    } else {
        echo "Error: " . $queryInsert . "<br>" . mysqli_error($conn);
    }
}

function getUserByEmail($Email) {
  global $pdo;

  // Query để lấy thông tin người dùng từ email
  $query = "SELECT * FROM users WHERE email = :email";
  $stmt = $pdo->prepare($query);
  $stmt->bindParam(':email', $Email);
  $stmt->execute();

  // Lấy dòng dữ liệu kết quả trả về (nếu có)
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  return $user; // Trả về thông tin người dùng (hoặc null nếu không tìm thấy)
}

function validateCreateUser($name)
{
  $errors = [];
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
  if (!empty($password) && strlen($password) < 5) {
    $errors['name'][] = [
      'rule' => 'minlength',
      'rule_value' => true,
      'value' => $password,
      'msg' => 'Mô tả ít nhất 5 ký tự'
    ];
  }
  // maxlength 30 (tối đa 30 ký tự)
  if (!empty($password) && strlen($password) > 500) {
    $errors['name'][] = [
      'rule' => 'maxlength',
      'rule_value' => true,
      'value' => $password,
      'msg' => 'Mô tả nhiều nhất 30 ký tự'
    ];
  }

  // 5. Thông báo lỗi cụ thể người dùng mắc phải (nếu vi phạm bất kỳ quy luật kiểm tra ràng buộc)
  // var_dump($errors);
  if (!empty($errors)) {
    foreach ($errors as $errorField) {
      foreach ($errorField as $error) {
        echo $error["msg"] . "</br>";
      }
    }
    return;
  }
}

function deleteUser($id)
{
  global $conn;
  $queryDelete = "DELETE FROM users WHERE id='$id';";
  $result = mysqli_query($conn, $queryDelete);
  mysqli_close($conn);
  header("Location:index.php");
}

// FunctionProducts
function showAllProducts()
{
  global $conn;
  $query = "SELECT * FROM products";
  $result = mysqli_query($conn, $query);
  $products = [];
  $rownum = 1;
  $domian_name = explode('/', $_SERVER['REQUEST_URI'])[1];
  if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $products[] = array(
        "index" => $rownum++,
        "id" => $row['id'],
        "name" => $row['name'],
        "description" => $row['description'],
        "price" => $row['price'],
        "image" => '/' . $domian_name . $row['image'],
        "created_at" => $row['created_at'],
        "updated_at" => $row['updated_at']
      );
    }
  }
  return $products;
}
$products = showAllProducts();
function showProducts($id)
{
  global $conn;
  $query = " SELECT * FROM products WHERE id=$id";
  $result = mysqli_query($conn, $query);
  $row = $result->fetch_assoc();
  if (empty($row)) {
    echo "giá trị id: $id không tồn tại. Vui lòng kiểm tra laị ";
    header("Location:index.php");
  }
  return $row;
}
function getProduct($id)
{
    global $conn;
    $queryGet = " SELECT * FROM products WHERE id=$id";
    $result = mysqli_query($conn, $queryGet);
    $product = $result->fetch_assoc();
    return $product;
}

function createProduct($name, $description, $price, $image)
{
  if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = uploadImage();
    validateCreateProduct($name, $description, $price, $image);
    global $conn;
    $queryInsert = "INSERT INTO products (name,description, price,image) VALUES ('$name', '$description', '$price','$image')";
    if (mysqli_query($conn, $queryInsert)) {
      mysqli_close($conn);
      header('location:index.php');
    } else {
      echo "Error: " . $queryInsert . "<br>" . mysqli_error($conn);
    }
  }
}

// upload image product
function uploadImage()
{
  $target_dir = __DIR__ . "/storage/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

  // Check if image file is a actual image or fake image
  if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
      echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
      echo "File is not an image.";
      $uploadOk = 0;
    }
  }

  // Check if file already exists
  if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }

  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }

  // Allow certain file formats
  if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
  ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      return "/storage/" . basename($_FILES["fileToUpload"]["name"]);
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }
}
function validateCreateProduct($name, $description, $price, $image)
{
  $errors = [];
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
  if (!empty($categoriesid) && strlen($categoriesid) < 5) {
    $errors['name'][] = [
      'rule' => 'minlength',
      'rule_value' => true,
      'value' => $categoriesid,
      'msg' => 'Mô tả ít nhất 5 ký tự'
    ];
  }
  if (!empty($categoriesid) && strlen($categoriesid) > 500) {
    $errors['name'][] = [
      'rule' => 'maxlength',
      'rule_value' => true,
      'value' => $categoriesid,
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
}

function deleteProduct($id)
{
  global $conn;

  // Lấy đường dẫn của hình ảnh từ CSDL trước khi xóa sản phẩm
  $querySelectImage = "SELECT image FROM products WHERE id='$id';";
  $result = mysqli_query($conn, $querySelectImage);
  $row = mysqli_fetch_assoc($result);
  $image_path = '/storage/' . $row['image'];

  // Xóa sản phẩm từ CSDL
  $queryDelete = "DELETE FROM products WHERE id='$id';";
  $result = mysqli_query($conn, $queryDelete);

  mysqli_close($conn);

  // Kiểm tra và xóa hình ảnh từ storage nếu tồn tại
  if (file_exists($image_path)) {
    $deleted = unlink($image_path); // Xóa hình ảnh từ thư mục storage
    if ($deleted) {
      echo 'Hình ảnh đã được xóa từ storage.';
    } else {
      echo 'Không thể xóa hình ảnh.';
    }
  } else {
    echo 'Không tìm thấy hình ảnh trong storage.';
  }

  header("Location:index.php");
}
// show products hot
function showProductsHot()
{
  global $conn;
  $query = "SELECT * FROM products ORDER BY view DESC LIMIT 4";
  $result = mysqli_query($conn, $query);
  $products_hot = [];
  $domian_name = explode('/', $_SERVER['REQUEST_URI'])[1];

  if ($result->num_rows > 0) {
    $rownum = 1;
    while ($row = $result->fetch_assoc()) {
      $products_hot[] = array(
        "index" => $rownum++,
        "id" => $row['id'],
        "name" => $row['name'],
        "description" => $row['description'],
        "price" => $row['price'],
        "image" => '/' . $domian_name . $row['image'],
        "view" => $row['view'],
        "created_at" => $row['created_at']
      );
    }
  }
  return $products_hot;
}
$products_hot = showProductsHot();



// Function Orders
function showAllOrder()
{
  global $conn;
  $query = "SELECT * FROM orders";
  $result = mysqli_query($conn, $query);

  $orders = [];
  $rowNum = 1;
  if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $orders[] = array(
        "index" => $rowNum++,
        "id" => $row['id'],
        "name" => $row['name'],
        "price" => $row['price'],
        "quantity" => $row['quantity'],
      );
    }
  }
  return $orders;
}

function showOrder($id)
{
  global $conn;
  $query = " SELECT * FROM orders WHERE id = $id";
  $result = mysqli_query($conn, $query);
  $row = $result->fetch_assoc();
  if (empty($row)) {
    echo "giá trị id: $id không tồn tại. Vui lòng kiểm tra laị ";
    header("Location:index.php");
  }
  return $row;
}

function createOrder($name, $price, $quantity)
{
  global $conn;
  validateCreateOrder();
  $queryInsert = "INSERT INTO orders (name, price, quantity) VALUES('$name', '$price', '$quantity')";
  if (mysqli_query($conn, $queryInsert)) {
    mysqli_close($conn);
    header('location:index.php');
  } else {
    echo "Error: " . $queryInsert . "<br>" . mysqli_error($conn);
  }
}

function validateCreateOrder()
{
  $name = isset($_POST['name']) ? $_POST['name'] : '';
  $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
  $errors = array();
  if (empty($name)) {
    $errors['name'][] = [
      'rule' => 'required',
      'rule_value' => true,
      'value' => $name,
      'msg' => 'Vui lòng nhập tên danh mục sản phẩm'
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
  // minlength 5 (tối thiểu 5 ký tự)
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
}

function deleteOrder($id)
{
  global $conn;
  $queryDelete = "DELETE FROM orders WHERE id='$id';";
  $result = mysqli_query($conn, $queryDelete);
  mysqli_close($conn);
  header("Location:index.php");
}
// End Orders

// Functions Categoties
function showAllCategories()
{
  global $conn;
  $query = "SELECT * FROM categories";
  $result = mysqli_query($conn, $query);

  $categories = [];
  $rowNum = 1;
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $categories[] = array(
        "index" => $rowNum++,
        "id" => $row['id'],
        "name" => $row['name'],
        "description" => $row['description'],
        "created_at" => $row['created_at'],
        "updated_at" => $row['updated_at']
      );
    }
  }
  return $categories;
}

function showCategories($id)
{
  global $conn;
  $query = "SELECT * FROM categories WHERE id=$id";
  $result = mysqli_query($conn, $query);
  $row = [];
  $row = $result->fetch_assoc();
  if (empty($row)) {
    echo "Giá trị id: $id không tồn tại. Vui lòng kiểm tra lại.";
    header("Location:index.php");
  }
}

function createCategories($name, $description)
{
  global $conn;
  validateCreateCategories($name);
  $queryInsert = "INSERT INTO categories (name, description) VALUES ('$name', '$description')";
  if (mysqli_query($conn, $queryInsert)) {
    mysqli_close($conn);
    header('location:index.php');
  } else {
    echo "Error: " . $queryInsert . "<br>" . mysqli_error($conn);
  }
}

function validateCreateCategories($name)
{
  global $conn;
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
}

function deleteCategories($id)
{
  global $conn;
  $queryDelete = "DELETE FROM categories WHERE id='$id';";
  $result = mysqli_query($conn, $queryDelete);
  mysqli_close($conn);
  header("Location:index.php");
}

function checkLogin($email, $password, $conn)
{
    $query = "SELECT * FROM users WHERE email = ? AND password = ?";
    
    $stmt = $conn->prepare($query);
    
    if (!$stmt) {
        die("Error in preparing the statement: " . $conn->error);
    }
    
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    
    if (!$stmt) {
        die("Error in executing the statement: " . $stmt->error);
    }
    
    $result = $stmt->get_result();
    
    $user = $result->fetch_assoc();

    if (empty($user)) {
        echo "Tài khoản không tồn tại!";
    } else {
        session_start();
        
        $_SESSION['email'] = $user['email'];
        $_SESSION['name'] = $user['name']; 
        header("location: index.php");
        exit();
    }
}
