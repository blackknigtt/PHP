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
                        <a class="nav-link" href="contact.php">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="cart.php"><i class="fas fa-shopping-bag"></i></a> 
                        <a href="account.html"><i class="fas fa-user"></i></a>
                    </li>   
                </ul>
            </div>
        </div>
    </nav>
    <!--Home-->

    <section id="home">
        <div class="container">
            <h5>New Arrivals</h5>
            <h1><span>Best Prices</span> This Season</h1>
            <p>E Shop offers the best products for the most affordable prices</p>
            <button>Shop Now</button>
        </div>

    </section>

    <!--brand-->

    <section id="brand" class="container">
        <div class="row">
            <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="/Assets/img/brand/brand1.png" alt="gg">
            <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="/Assets/img/brand/brand2.png" alt="gg">
            <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="Assets/img/brand/brand3.png" alt="">
            <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="Assets/img/brand/brand4.png" alt="">       
        </div>
    </section>

    <!--new-->

    <section id="new" class="w-100">
        <div class="row p-0 m-0">
            <!--one-->
            <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                <img class="img-fluid" src="Assets/img/prod/p1.png" alt="">
                <div class="details">
                    <h2>Extreamly Awesome Sheet</h2>
                    <button class="text-uppercase">SHOP NOW</button>
                </div>
            </div>
            <!--two-->
            <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                <img class="img-fluid" src="Assets/img/prod/p2.png" alt="">
                <div class="details">
                    <h2>Awesome Jacket</h2>
                    <button class="text-uppercase">SHOP NOW</button>
                </div>
            </div>
            <!--three-->
            <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                <img class="img-fluid" src="Assets/img/prod/p3.png" alt="">
                <div class="details">
                    <h2>50% OFF Watches</h2>
                    <button class="text-uppercase">SHOP NOW</button>
                </div>
            </div>
        </div>
    </section>

    <!--featured-->

    <section id="featured" class="my-5 pb-5">
        <div class="container text-center mt-5 py-5">
            <h3>Our Featured</h3>
            <hr class="mx-auto">
            <p>Here can check out new products</p>
        </div>
        <div class="row mx-auto container-fluid">
        <?php include('server/get_featured_products.php'); ?>
        <?php while($row= $featured_products->fetch_assoc()) { ?>
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid" src="Assets/img/featured/<?php echo $row['product_image']; ?>" alt="" >
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h5 class="pname"><?php echo $row['product_name'];?></h5>
                <h4 class="p-price">$ <?php echo $row['product_price']; ?></h4>
                <a href="<?php echo "single_product.php?product_id=". $row['product_id'];?>"><button class="buy-btn">Buy Now</button></a>
            </div>

            <?php } ?>
            
        </div>
    </section>

    <!--banner-->

    <section id="banner" class="my-5 py-5">
        <div class="container">
            <h4>MID SEASON'S SALE</h4>
            <h1>Autumn Collection <br> UP to 30% OFF </h1>
            <button class="text-uppercase">Shop Now</button>
        </div>
    </section>

    <!--clothes-->

    <section id="featured" class="my-5 pb-5">
        <div class="container text-center mt-5 py-5">
            <h3>Dress and Coats</h3>
            <hr class="mx-auto">
            <p>Here can check out our clothes</p>
        </div>
        <div class="row mx-auto container-fluid">

        <?php include('server/get_coats.php'); ?>

        <?php while($row= $coats_products->fetch_assoc()) { ?>

            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid" src="Assets/img/clothes/<?php echo $row['product_image'];?>" alt="">
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h5 class="pname"><?php echo $row['product_name'];?></h5>
                <h4 class="p-price"><?php echo $row['product_price'];?></h4>
                <button class="buy-btn">Buy Now</button>
            </div>

            <?php } ?>
        </div>
    </section>

    <!--shoes-->

    <section id="featured" class="my-5 pb-5">
        <div class="container text-center mt-5 py-5">
            <h3>Shoes</h3>
            <hr class="mx-auto">
            <p>Here can check out our amazing shoes</p>
        </div>
        <div class="row mx-auto container-fluid">
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid" src="Assets/img/shoes/shoe1.png" alt="">
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h5 class="pname">Sport Shoes</h5>
                <h4 class="p-price">$199.8</h4>
                <button class="buy-btn">Buy Now</button>
            </div>
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid" src="Assets/img/shoes/shoe2.png" alt="">
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h5 class="pname">Sport Shoes</h5>
                <h4 class="p-price">$199.8</h4>
                <button class="buy-btn">Buy Now</button>
            </div>
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid" src="Assets/img/shoes/shoe3.png" alt="">
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h5 class="pname">Sport Shoes</h5>
                <h4 class="p-price">$199.8</h4>
                <button class="buy-btn">Buy Now</button>
            </div>
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid" src="Assets/img/shoes/shoe4.png" alt="">
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h5 class="pname">Sport Shoes</h5>
                <h4 class="p-price">$199.8</h4>
                <button class="buy-btn">Buy Now</button>
            </div>
        </div>
    </section>

    <!--watches-->

    <section id="featured" class="my-5 pb-5">
        <div class="container text-center mt-5 py-5">
            <h3>Watches</h3>
            <hr class="mx-auto">
            <p>Here can check out our amazing watches</p>
        </div>
        <div class="row mx-auto container-fluid">
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid" src="Assets/img/watch/watch1.png" alt="">
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h5 class="pname">Rolex</h5>
                <h4 class="p-price">$199.8</h4>
                <button class="buy-btn">Buy Now</button>
            </div>
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid" src="Assets/img/watch/watch2.png" alt="">
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h5 class="pname">Seiko</h5>
                <h4 class="p-price">$199.8</h4>
                <button class="buy-btn">Buy Now</button>
            </div>
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid" src="Assets/img/watch/watch3.png" alt="">
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h5 class="pname">Cartier</h5>
                <h4 class="p-price">$199.8</h4>
                <button class="buy-btn">Buy Now</button>
            </div>
            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid" src="Assets/img/watch/watch4.png" alt="">
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h5 class="pname">Patek Philippe</h5>
                <h4 class="p-price">$199.8</h4>
                <button class="buy-btn">Buy Now</button>
            </div>
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