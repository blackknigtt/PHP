<?php 
session_start();

include ('server/connection.php');

if(isset($_SESSION['logged_in'])){

    header ('Location: account.php');
    exit;
}
if(isset($_POST['register'])){
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if($password == $confirmPassword){
        // if password less than 8 letters   
        if(strlen($password) < 8){
            header ('Location: register.php?error=Password must be at least 8 characters long');
        } 
        // if there's no error
        else{
            //check whether there is a user with this email or not
            $stmt1 = $conn->prepare("SELECT count(*) FROM users WHERE user_email = ?");
            $stmt1->bind_param("s", $email);
            $stmt1->execute();
            $stmt1->bind_result($num_rows);
            $stmt1->store_result();
            $stmt1->fetch();
            $stmt1->close();

            if($num_rows != 0){
                header ('Location: register.php?error=Email already exists');
            } else {
                //create a new user 
                $stmt = $conn->prepare("INSERT INTO users (user_name, user_email, user_password) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $name, $email, md5($password));
                if($stmt->execute()){
                    $_SESSION['user_email'] = $email;
                    $_SESSION['user_name'] = $name;
                    $_SESSION['loggged_in'] = true; 
                    header('Location: account.php?register=You registered successfully');
                } else{
                    header('Location: register.php?error=could not create account for the moment');
                }
                
            }
        }
    } else {
        echo "Passwords do not match";
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

    <!--Register-->
    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Register</h2>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container">
            <form action="" id="register-form" method="POST" action="register.php">
                <p style="color: red;"><?php if(isset($_GET['error'])) { echo $_GET['error']; }?></p>
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" class="form-control" name="name" id="register-name" placeholder="Name" required>
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" class="form-control" name="email" id="register-email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" id="register-password" placeholder="Enter your password" required>
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control" name="confirmPassword" id="register-confirm-password" placeholder="Confirm your password" required>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn" id="register-btn" name="register" value="Register" >
                </div>
                <div class="form-group">
                    <a href="login.php" id="register-url" class="btn">Do you have an account? Login</a>
                </div>
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