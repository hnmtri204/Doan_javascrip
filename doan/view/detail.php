<?php
session_start();
include_once "../dbconnect.php";
include_once "../functions.php";
$category = showAllCategories();
$products = showAllProducts();
include_once "./includes/header.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $product_detail = getProduct($id);
}
?>


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
                    <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Menu
                    </a>

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
            <form class="d-flex">
                <input type="text" class="form-control me-2" placeholder="Search" required>
                <button type="button" id="btn">Search</button>
            </form>
            <li class="nav-item">
                <a href="./cart.php" class="nav-link text-dark">
                    <i class="fas fa-shopping-cart"></i> Order
                </a>
            </li>
            <li class="nav-item">
                <?php if (isset($_SESSION['name'])) { ?>
                    <a href="./index.php" class="nav-link text-dark">
                        <i class="fas fa-user"></i> Hi, <?php echo $_SESSION['name']; ?>
                    </a>
                <?php } else { ?>
                    <a href="login.php" class="nav-link text-dark">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a>
                <?php } ?>
            </li>
            <?php if (isset($_SESSION['name'])) { ?>
                <li class="nav-item">
                    <a href="logout.php" class="nav-link text-dark">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </li>
            <?php } ?>

        </div>
    </nav>
    <!-- Navbar End -->
    <main role="main">
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-6">
                    <!-- Product Image -->
                    <div class="preview">
                        <div class="preview-pic tab-content">
                            <div class="tab-pane active" id="pic-1">
                                <img class="img-fluid mx-auto d-block" width="400px" src="<?php echo "/doan" . $product_detail['image'] ?>" alt="Product Image">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Product Details -->
                    <div class="details">
                        <h3 class="product-title"><?php echo $product_detail['name'] ?></h3>
                        <div class="rating">
                            <div class="stars">
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                            </div>
                            <span class="review-no">999 reviews</span>
                        </div>
                        <p class="product-description">Lorem ipsum dolor sit amet.</p>
                        <small class="text-muted">Giá cũ: <s><span>40$</span></s></small>
                        <h4 class="price">Giá hiện tại: <span><?php echo $product_detail['price'] ?>$</span></h4>
                        <p class="vote"><strong>100%</strong> hàng <strong>Chất lượng</strong>, đảm bảo
                            <strong>Uy tín</strong>!
                        </p>
                        <h5 class="sizes">sizes:
                            <span class="size" data-toggle="tooltip" title="cỡ Nhỏ">S</span>
                            <span class="size" data-toggle="tooltip" title="cỡ Trung bình">M</span>
                            <span class="size" data-toggle="tooltip" title="cỡ Lớn">L</span>
                            <span class="size" data-toggle="tooltip" title="cỡ Đại">XL</span>
                        </h5>
                        <input type="number" class="form-control" name="quantity" min="1" placeholder="Quantity" style="width: 20%;">
                        <button class="btn btn-primary mt-3 addToCartBtn" data-product-id="<?php echo $product_detail['id']; ?>" data-product-name="<?php echo $product_detail['name']; ?>" data-product-price="<?php echo $product_detail['price']; ?>">
                            Add to cart
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Footer -->
    <?php
    include_once "./includes/footer.php";
    ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="./public/js/cart.js"></script>
</body>

</html>