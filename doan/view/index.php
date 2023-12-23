<?php
session_start();
include_once "../dbconnect.php";
include_once "../functions.php";
$category = showAllCategories();
$products = showAllProducts();
$pro = showProductsHot();
include_once "./includes/header.php";

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $Email = $_POST['Email'];
    $_SESSION['name'] = $name;
    $_SESSION['Email'] = $Email;
}
if (!isset($_SESSION["loggedin"])) {
} else {
    echo $_SESSION["name"];
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
    <!-- Home Section Start -->
    <section class="home" id="home">
        <div class="home-content">
            <h3>Claim Best Offer <br> On Fast <span>Food</span> & <span>Restaurant</span></h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed, quibusdam minus. Ea accusamus rem numquam.</p>
            <a href="#menu" id="home-btn">Menu</a>
        </div>
        <div class="img">
            <img src="./public/img/image 46.png" alt="">
        </div>
    </section>
    <!-- Home Section End -->
    <!-- Top Section Start -->
    <div class="top-section">
        <h5>WHAT WE SERVE</h5>
        <h3>Your Favourite Food <br> Delivery Partner</h3>
        <div class="row">
            <div class="col-md-4 py-3 py-md-0">
                <div class="card">
                    <img src="public/img/img1.png" alt="">
                    <div class="card-body">
                        <h1>Easy To Order</h1>
                        <p>You only need a few steps in <br> ordering food</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 py-3 py-md-0">
                <div class="card">
                    <img src="public/img/img2.png" alt="">
                    <div class="card-body">
                        <h1>Fastest Delivery</h1>
                        <p>Delivery that is always ontime <br> even faster</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 py-3 py-md-0">
                <div class="card">
                    <img src="public/img/img3.png" alt="">
                    <div class="card-body">
                        <h1>Best Quality</h1>
                        <p>Not only fast for us quality is also <br> number one</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Top Section End -->

    <!-- Our Menu Start -->
    <section class="menu" id="menu">
        <h3>Menu</h3>
        <h2>Delicious Dishes Is Here <i class="fa-solid fa-arrow-down"></i></h2>
        <div class="row" style="margin-top: 30px;">
            <?php foreach ($products_hot as $productshot) { ?>
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <a href="detail.php?id=<?php echo $productshot['id'] ?>">
                            <img class="img-fluid mx-auto d-block" src=<?php echo $productshot['image'] ?> alt="">
                        </a>
                        <div class="card-body">
                            <h3><?php echo $productshot['name'] ?></h3>
                            <h6>Lorem ipsum dolor sit amet.</h6>
                            <div class="rating">
                                <i class="fa-solid fa-star checked"></i>
                                <i class="fa-solid fa-star checked"></i>
                                <i class="fa-solid fa-star checked"></i>
                                <i class="fa-solid fa-star checked"></i>
                                <i class="fa-solid fa-star checked"></i>
                            </div>
                            <p><?php echo $productshot['price'] ?>$
                                <a href="#order">
                                    <i class="fa-solid fa-credit-card"></i>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>

    <!-- Our Menu End -->
    <div class="container">
        <div class="line" style="width: 100%; height: 2px; background-color: #e53937;"></div>
    </div>
    <!-- Our Menu Start -->

    <section class="menu" id="menu">
        <h3>Our Menu</h3>
        <div class="row" style="margin-top: 30px;">
            <?php foreach ($products as $product) { ?>
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <a href="detail.php?id=<?php echo $product['id'] ?>">
                            <img class="img-fluid mx-auto d-block" src=<?php echo $product['image'] ?> alt="">
                        </a>
                        <div class="card-body">
                            <h3> <?php echo $product['name'] ?></h3>
                            <h6>Lorem ipsum dolor sit amet.</h6>
                            <div class="rating">
                                <i class="fa-solid fa-star checked"></i>
                                <i class="fa-solid fa-star checked"></i>
                                <i class="fa-solid fa-star checked"></i>
                                <i class="fa-solid fa-star checked"></i>
                                <i class="fa-solid fa-star checked"></i>
                            </div>
                            <p><?php echo $product['price'] ?>$
                                <a href="#order">
                                    <i class="fa-solid fa-credit-card"></i>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </section>
    <!-- Our Menu End -->
    <!-- Ordre Section Start -->
    <section class="order" id="order">
        <div class="heading">Order Your <span>Food</span></div>
        <div class="row">
            <div class="col-md-5 py-3 py-md-0">
                <div class="card">
                    <img src="public/img/img1.png" alt="">
                </div>
            </div>
            <div class="col-md-7 py-3 py-md-0">
                <form action="#">
                    <div class="mb-3 mt-3">
                        <input type="text" class="form-control" id="name" placeholder="Name" required>
                    </div>
                    <div class="mb-3 mt-3">
                        <input type="email" class="form-control" id="email" placeholder="Phone" required>
                    </div>
                    <div class="mb-3 mt-3">
                        <input type="number" class="form-control" id="number" placeholder="Number" required>
                    </div>
                    <textarea class="form-control" id="comment" rows="5" name="text" placeholder="Address" required></textarea>
                    <button type="submit" class="order-btn">Order Now</button>
                </form>
            </div>
        </div>
    </section>
    <!-- Ordre Section End -->



    <!-- Review Section Start -->
    <section class="review" id="review">
        <div class="row">
            <div class="col-md-4 py-3 py-md-0">
                <div class="card">
                    <img src="public/img/review-img.png" alt="">
                </div>
            </div>
            <div class="col-md-8 py-3 py-md-0" style="padding: 100px;">
                <h3>WHAT THEY SAY</h3>
                <h2>What Our Customers <br>Say About Us</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio, commodi maiores qui quasi tenetur doloremque!</p>
                <h5><img src="public/img/pic-1.png" alt="" width="60px"><a href="#">John Cooper</a></h5>
                <h5><img src="public/img/pic-2.png" alt="" width="60px"><a href="#">John Cooper</a></h5>
                <div class="rating">
                    <i class="fa-solid fa-star checked"></i>
                    <i class="fa-solid fa-star checked"></i>
                    <i class="fa-solid fa-star checked"></i>
                    <i class="fa-solid fa-star checked"></i>
                    <i class="fa-solid fa-star checked"></i>
                </div>
            </div>
        </div>
    </section>
    <!-- Review Section End -->
    <!-- Contact Start -->
    <?php
    include_once "./includes/contact.php";
    ?>
    <!-- Contact End -->
    <!-- Footer Start -->
    <?php
    include_once "./includes/footer.php";
    ?>
    <!-- Footer End -->
    <!-- BOOTSTRAP CDN LINK -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- BOOTSTRAP CDN LINK -->
</body>

</html>