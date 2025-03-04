<?php 
session_start();

include ('connection.php');

if((isset($_POST['place_order']))){
    //1. get user info and store it in database
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $order_cost = $_SESSION['total'];
    $order_status = 'on_hold';
    $user_id = 1;
    $order_date = date('Y-m-d H:i:s');
   
    if ($conn) {
        $stms = $conn->prepare("INSERT INTO orders (order_cost, order_status, user_id, user_phone, user_city, user_address, order_date) 
                        VALUES (?, ?, ?, ?, ?, ?, ?); ");
    } else {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $stms->bind_param("isiisss", $order_cost, $order_status, $user_id, $phone, $city, $address, $order_date);

    $stms->execute();

    //2. issue new order and store order info in database
    $order_id = $stms->insert_id;


    //3. get products from session
    $_SESSION['cart'];
    foreach($_SESSION['cart'] as $key => $value) {
        $product = $_SESSION['cart'][$key];
        $product_id = $product['product_id'];
        $product_name = $product['product_name'];
        $product_image = $product['product_image'];
        $product_price = $product['product_price'];
        $product_quantity = $product['product_quantity'];
        
        //4. store each single item in order_items database
        $stmt1 = $conn->prepare("INSERT INTO order_items (order_id, product_id, product_name, product_image, product_price, product_quantity, user_id, order_date) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?); ");
        $stmt1->bind_param("iissiiis", $order_id, $product_id, $product_name, $product_image,$product_price,$product_quantity, $user_id, $order_date);
        $stmt1->execute();
    }
    
   
    

    //5. clear cart --> delay until payment is done
    //unset($_SESSION['cart']);

    //6. redirect to thank you page
    header('Location: ../payment.php?order_status=order placed successfully');
    
}   



?>