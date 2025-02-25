<?php 

session_start();
include('server/connection.php');

if(!isset($_SESSION['logged_in'])) {
    header('location: login.php');
    exit();
}

if(isset($_GET['logout'])){
    if(isset($_SESSION['logged_in'])) {
        unset($_SESSION['logged_in']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        header('location: login.php');
        exit;
    }
}

if(isset($_POST['change_password'])){
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $user_email = $_SESSION['user_email'];

    if($password !== $confirmPassword) {
        header('location: account.php?error=passwords do not match');
    } elseif (strlen($password) < 8){
        header('location: account.php?error=password do must be atleast 6 characters');
    } else {

        $hashed_password = md5($password);
        $stmt = $conn->prepare("UPDATE users SET user_password=? WHERE user_email=?");
        $stmt->bind_param('ss', $hashed_password, $user_email);

       if($stmt->execute()) {
        header('location: account.php?success=password has been updated successfully');
       }else{
        header('location: account.php?error=could not update the password');
       }
        
    }
}




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
                        <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
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
                        <i class="fas fa-shopping-bag"></i>
                        <i class="fas fa-user"></i>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!--account-->
    <section class="my-5 py-5">
        <div class="row container mx-auto">
            <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
                <h3 class="font-awesome-bold">Account</h3>
                <p style="color: green;"><?php if(isset($_GET['message'])) { echo $_GET['message']; }?></p>
                <p style="color: green;"><?php if(isset($_GET['register'])) { echo $_GET['register']; }?></p>
                <hr class="mx-auto">
                <div class="account-info">
                    <p>Name <span><?php if(isset($_SESSION['user_name'])){ echo $_SESSION['user_name'];}?></span></p>
                    <p>Email <span><?php if(isset($_SESSION['user_email'])){ echo $_SESSION['user_email'];}?></span></p>
                    <p><a href="#orders" id="orders-btn">Your orders</a></p>
                    <p><a href="account.php?logout=1" id="logout-btn">Logout</a></p>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 col-sm-12">
                <form action="account.php" method="POST" id="account-form">
                    <p style="color: green; text: center;"><?php if(isset($_GET['success'])) { echo $_GET['success']; }?></p>
                    <p style="color: red; text: center;"><?php if(isset($_GET['error'])) { echo $_GET['error']; }?></p>
                    <h3>Change Password</h3>
                    <hr class="mx-auto">
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" class="form-control" id="account-password" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <label for="">Confirm Password</label>
                        <input type="password" class="form-control" id="account-password-confirm" name="confirmPassword" placeholder="Password" required>
                    </div>
                    <div class="face-group">
                        <input type="submit" class="btn" value="Change Password" id="change-pass-btn" name="change_password">
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!--orders-->
    <section id="orders" class="orders container my-5 py-3">
        <div class="container mt-5">
            <h2 class="font-weight-bold text-center">Your Orders</h2>
            <hr class="mx-auto">
        </div>
        <table class="w-100 mt-5 pt-5">
            <tr>
                <th>Product</th>
                <th>Date</th>
            </tr>
            <tr>
                <td>
                   <div class="product-info">
                    <img src="Assets/img/featured/<?php echo $value['product_image'];?>" alt="">
                    <div>
                        <p class="mt-3"><?php echo $value['product_name'];?></p>
                    </div>
                   </div>
                </td>
                
                <td>
                    <span><?php echo $value['product_date'];?></span>
                </td>
            </tr>
        </table>


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