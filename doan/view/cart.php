<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'delete') {
        if (isset($_POST['delete_index'])) {
            $deleteIndex = $_POST['delete_index'];
            if (isset($_SESSION['cart'][$deleteIndex])) {
                unset($_SESSION['cart'][$deleteIndex]);
                $_SESSION['cart'] = array_values($_SESSION['cart']);
                echo 'success';
                exit;
            } else {
                http_response_code(400);
                echo 'Error: Product does not exist in cart';
                exit;
            }
        } else {
            http_response_code(400);
            echo 'Error: Invalid delete request';
            exit;
        }
    }
    if (isset($_POST['action']) && $_POST['action'] === 'update_quantity') {
        if (isset($_POST['update_index']) && isset($_POST['new_quantity'])) {
            $updateIndex = $_POST['update_index'];
            $newQuantity = $_POST['new_quantity'];
            if (isset($_SESSION['cart'][$updateIndex])) {
                $_SESSION['cart'][$updateIndex]['quantity'] = $newQuantity;
                echo 'success';
                exit;
            } else {
                http_response_code(400);
                echo 'Error: Product does not exist in cart';
                exit;
            }
        } else {
            http_response_code(400);
            echo 'Error: Invalid update request';
            exit;
        }
    }
    $expectedFields = ['Id', 'Name', 'Price', 'quantity'];
    $isDataComplete = true;

    foreach ($expectedFields as $field) {
        if (!isset($_POST[$field])) {
            $isDataComplete = false;
            break;
        }
    }

    if ($isDataComplete) {
        $Id = $_POST['Id'];
        $Name = $_POST['Name'];
        $Price = $_POST['Price'];
        $quantity = $_POST['quantity'];

        $cartItem = [
            'id' => $Id,
            'name' => $Name,
            'price' => $Price,
            'quantity' => $quantity
        ];
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        $_SESSION['cart'][] = $cartItem;
        echo 'success';
        exit;
    } else {
        http_response_code(400);
        echo 'Error: Incomplete data';
        exit;
    }
}
?>

<body>
    <?php include_once "./includes/header.php"; ?>
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
    <div class="container mt-5">
        <h2 class="mb-4">Shopping Cart</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">#</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $index = 0;
                foreach ($_SESSION['cart'] as $item) {
                ?>
                    <tr>
                        <td><?php echo $index++; ?></td>
                        <td><?php echo $item['name']; ?></td>
                        <td><?php echo $item['price']; ?></td>
                        <td>
                            <input type="number" class="form-control quantity-input" style="width: 10%;" value="<?php echo $item['quantity']; ?>">
                        </td>
                        <td>
                            <button class="btn btn-sm btn-primary update-quantity" data-index="<?php echo $item['quantity']; ?>">
                                Update
                            </button>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-danger delete-product" data-index="<?php echo $index; ?>">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                <?php
                    $index++;
                }
                ?>
            </tbody>
        </table>

        <div class="text-end">
            <h4>Total:
                <?php
                $total = 0;
                foreach ($_SESSION['cart'] as $item) {
                    $productTotal = $item['price'] * $item['quantity'];
                    $total += $productTotal;
                }
                ?>
                <td><strong>$<?php echo $total; ?></strong></td>
            </h4>
            <button class="btn btn-primary">Checkout</button>
        </div>
    </div>
    <?php include_once "./includes/footer.php" ?>
    <!-- BOOTSTRAP CDN LINK -->
    <!-- Include jQuery first -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    </script>

    <!-- Then load Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Followed by your custom scripts -->
    <script src="./public/js/total.js"></script>
    <script src="./public/js/cart.js"></script>

</body>

</html>