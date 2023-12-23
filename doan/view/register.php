<?php
include_once "../functions.php";
include_once "../dbconnect.php";
function usernameExists($name, $pdo)
{
    $query = "SELECT * FROM users WHERE name = :name";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':name', $name);
    $stmt->execute();
    return $stmt->rowCount() > 0;
}
function emailExists($email, $pdo)
{
    $query = "SELECT * FROM users WHERE Email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    return $stmt->rowCount() > 0;
}
$errors = [];
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $password = $_POST['password'];
    $email = trim($_POST['Email']);
    if (usernameExists($name, $pdo) && emailExists($email, $pdo)) {
        $errors[] = "Tên người dùng và email đã tồn tại. Vui lòng nhập thông tin mới.";
    } elseif (usernameExists($name, $pdo)) {
        $errors[] = "Tên người dùng đã tồn tại. Vui lòng nhập tên khác.";
    } elseif (emailExists($email, $pdo)) {
        $errors[] = "Email đã tồn tại. Vui lòng nhập email khác.";
    } else {
        $query = "INSERT INTO users (name, Email, password) VALUES (:name, :email, :password)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        if ($stmt->execute()) {
            $message = "Đăng ký thành công!";
            header("Location: ../view/login.php");
            exit();
        } else {
            $errors[] = "Đăng ký thất bại. Vui lòng thử lại!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- STYLE CSS LINK -->
    <link rel="stylesheet" href="./public/css/style.css">
    <!-- STYLE CSS LINK -->

    <!-- BOOTSTRAP CDN LINK -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- BOOTSTRAP CDN LINK -->
    <!-- FONT AWESOME CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- FONT AWESOME CDN -->
    <!-- GOOGLE FONTS LINK -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@600&display=swap" rel="stylesheet">
    <!-- GOOGLE FONTS LINK -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://use.fontawesome.com/f59bcd8580.js"></script>
    <script src="public/css/login.css"></script>
    <title>Register</title>
</head>

<body>
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-sm" id="navbar">
        <a href="index.html" class="navbar-brand" id="logo">
            <img src="public/img/logo.png" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
            <span><i class="fa-solid fa-bars"></i></span>
        </button>
        <div class="collapse navbar-collapse" id="mynavbar">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a href="index.php" class="nav-link text-dark">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Menu</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php
                        foreach ($category as $cat) {
                        ?>
                            <li><a class="dropdown-item" href="#" value="<?php echo $cat['id'] ?>"><?php echo $cat['name'] ?></a></li>
                        <?php } ?>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#order" class="nav-link text-dark">Order</a>
                </li>
                <li class="nav-item">
                    <a href="#review" class="nav-link text-dark">Reviews</a>
                </li>
                <li class="nav-item">
                    <a href="#contact" class="nav-link text-dark">Contact</a>
                </li>
            </ul>
            <form class="d-flex me-3">
                <input type="text" class="form-control me-2" placeholder="Search" required>
                <button type="button" id="btn">Search</button>
            </form>
            <li class="nav-item me-3">
                <a href="./cart.php" class="nav-link text-dark">
                    <i class="fas fa-shopping-cart"></i> Order
                </a>
            </li>
            <li class="nav-item">
                <a href="./login.php" class="nav-link text-dark">
                    <i class="fas fa-sign-in-alt"></i> Login
                </a>
            </li>

        </div>
    </nav>
    <!-- Navbar End -->
    <div class="container">
        <div class="row m-5 no-gutters shadow-lg">
            <div class="col-md-6 d-none d-md-block">
                <img src="public/img/Register.jpg" class="img-fluid">
            </div>
            <div class="col-md-6 bg-white p-5">
                <div class="form-style">
                    <?php include_once "../user/create.php"; ?>
                    <div class="pt-4 text-center">
                        Log in with your account. <a href="../view/login.php">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Start -->
    <footer id="footer">
        <div class="f-content">
            <div class="f-logo"><img src="public/img/logo.png" alt=""></div>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iure illo, facilis fugit quisquam nihil ipsa.</p>
            <i class="fa-brands fa-twitter"></i>
            <i class="fa-brands fa-instagram"></i>
            <i class="fa-brands fa-facebook-f"></i>
            <i class="fa-brands fa-youtube"></i>
            <i class="fa-brands fa-twitter"></i>
        </div>
        <br>
        <div class="c-content">
            &copy; Copyright SA Coding. All Rights Reserved <br>
            <span>Designed By <a href="../view/index.php">SA Coding</a></span>
        </div>
    </footer>
    <!-- Footer End -->
    <!-- BOOTSTRAP CDN LINK -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- BOOTSTRAP CDN LINK -->

</body>

</html>