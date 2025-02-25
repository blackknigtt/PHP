<?php 

session_start();

if (isset($_POST['add_to_cart'])) {
    if (isset($_SESSION['cart'])) {
        $products_array_ids = array_column($_SESSION['cart'], "product_id");
        if (!in_array($_POST['product_id'], $products_array_ids)) {
            
            $product_id = $_POST['product_id'];

            $product_array = array(
                'product_id' => $_POST['product_id'],
                'product_name' => $_POST['product_name'],
                'product_price' => $_POST['product_price'],
                'product_image' => $_POST['product_image'],
                'product_quantity' => $_POST['product_quantity']
            );
            $_SESSION['cart'][$_POST['product_id']] = $product_array;
        } else {
            echo "<script>alert('Product is already added to cart')</script>";
        }
    } else {
        $product_array = array(
            'product_id' => $_POST['product_id'],
            'product_name' => $_POST['product_name'],
            'product_price' => $_POST['product_price'],
            'product_image' => $_POST['product_image'],
            'product_quantity' => $_POST['product_quantity']
        );
        $_SESSION['cart'][$_POST['product_id']] = $product_array;
    }
    
    //calculate total cart
    calculateTotalCart();


} elseif (isset($_POST['remove_product'])) {
    $product_id = $_POST['product_id'];
    unset($_SESSION['cart'][$product_id]);
    echo "<script>alert('Product has been removed')</script>";

} elseif (isset($_POST['edit_quantity'])) {
    $product_id = $_POST['product_id'];
    $product_quantity = $_POST['product_quantity'];

    $product_array = $_SESSION['cart'][$product_id];

    $product_array['product_quantity'] = $product_quantity;

    $_SESSION['cart'][$product_id] = $product_array;
    echo "<script>alert('Product quantity has been updated')</script>";
} else {
    //  header("Location: index.php");
}

/*function calculateTotalCart() {
    $total = 0;
    foreach ($_SESSION['cart'] as $key => $value) {
        $total += $value['product_price'] * $value['product_quantity'];
    }
    return $total;
}

$_SESSION['total_cart'] = calculateTotalCart(); */

function calculateTotalCart() {
    
    $total = 0;

    foreach ($_SESSION['cart'] as $key => $value) {
        $product = $_SESSION['cart'][$key];

        $price = $product['product_price'];
        $quantity = $product['product_quantity'];

        $total = $total + ($price * $quantity);
    }
    return $total;
    
}

$_SESSION['total'] = calculateTotalCart();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- CSS -->
     <link rel="stylesheet" href="Assets/CSS/Styles.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="Assets/img/logo.png" alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse nav-buttons" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="shop.html">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a href="cart.php"><i class="fas fa-shopping-bag"></i></a> 
                        <a href="account.html"><i class="fas fa-user"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!--cart-->
    <section class="cart container my-5 py-5">
        <div class="container mt-5">
            <h2 class="font-weight-bolde">Your Cart</h2>
            <hr>
        </div>
        <table class="mt-5 pt-5">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>

            <?php
            
            foreach($_SESSION['cart'] as $key => $value){

            
            ?>
            
            <tr>
                <td>
                    <div class="product-info">
                        <img src="Assets/img/featured/<?php echo $value['product_image']; ?>" alt="">
                        <div>
                            <p><?php echo $value['product_name'];?></p>
                            <small><span>$</span><?php echo $value['product_price']; ?></small>
                            <br>
                            <form action="cart.php" method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
                                <input type="submit" name="remove_product" class="remove-btn" value="remove" />
                            </form>
                        </div>
                    </div>
                </td>
                
                <td>
                    
                    <form action="cart.php" method="POST">
                        <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
                        <input type="number" name="product_quantity" value="<?php echo $value['product_quantity'];?>" >
                        <input type="submit" value="edit" class="edit-btn" name="edit_quantity">
                    </form>
                </td>

                <td>
                    <span>$</span>
                    <span class="product-price"><?php echo $value['product_price'] * $value['product_quantity'];  ?></span>
                </td>
            </tr>

            <?php } ?>
        </table>

        <div class="cart-total">
            <table>
                <!-- <tr>
                    <td>Subtotal</td>
                    <td>$155</td>
                </tr> -->
                <tr>
                    <td>Total</td>
                    <td>$ <?php echo $_SESSION['total']; ?></td>
                </tr>
            </table>
        </div>

        <div class="checkout-container">
            <form method="POST" action="checkout.php">
                <input type="submit" class="btn checkout-btn" value="Checkout" name="checkout">
            </form>
        </div>

    </section>

    <!--footer-->

    <footer class="mt-5 py-5">
        <div class="row container-fluid mx-auto pt-5">
            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <img src="Assets/img/logo.png" alt="">
                <p class="pt-3">We provide the best products for the most affordale prices</p>
            </div>
            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <h5 class="pb-2">Featured</h5>
                <ul class="text-uppercase">
                    <li><a href="#">men</a></li>
                    <li><a href="#">women</a></li>
                    <li><a href="#">boys</a></li>
                    <li><a href="#">girls</a></li>
                    <li><a href="#">new arrivals</a></li>
                    <li><a href="#">clothes</a></li>
                </ul>
            </div>
            <div class="foot-one col-lg-3 col-md-6 col-sm-12">
                <h5 class="pb-2">Contact Us</h5>
                <div>
                    <h6 class="text-uppercase">Address</h6>
                    <p>1234 Street Name, City</p>
                </div>
                <div>
                    <h6 class="text-uppercase">Phone</h6>
                    <p>123 008 1223</p>
                </div>
                <div>
                    <h6 class="text-uppercase">Email</h6>
                    <p>info@email.com</p>
                </div>
            </div>
            <div class="footer-one col-lg-3 col-md-6 col-sm-12">
                <h5 class="pb-2">Instagram</h5>
                <div class="row">
                    <img src="Assets/img/clothes/clothes1.png" alt="" class="img-fluid w-25 h-100 m-2">
                    <img src="Assets/img/clothes/clothes2.png" alt="" class="img-fluid w-25 h-100 m-2">
                    <img src="Assets/img/clothes/clothes3.png" alt="" class="img-fluid w-25 h-100 m-2">
                    <img src="Assets/img/clothes/clothes4.png" alt="" class="img-fluid w-25 h-100 m-2">
                    <img src="Assets/img/watch/watch1.png" alt="" class="img-fluid w-25 h-100 m-2">
                </div>
            </div>
        </div>

        <div class="copyright mt-5">
            <div class="row comtainer mx-auto">
                <div class="col-lg-3 col-md-5 col-sm-12 mb-4">
                    <img src="Assets/img/payment/payment.png" alt="">
                </div>
                <div class="col-lg-3 col-md-5 col-sm-12 mb-4 mb-2">
                    <p>© 2025 E Shop. All Rights Reserved</p>
                </div>
                <div class="col-lg-3 col-md-5 col-sm-12 mb-4">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <!-- Javascript -->
     <script src="Assets/JS/script.js"></script>
</body>
</html>