<?php

include('connection.php'); // Ensure database connection

$stmt = $conn->prepare("SELECT * FROM product where product_category='coats' LIMIT 4"); // ✅ Use $stmt, not $start

if ($stmt) {
    $stmt->execute();  // ✅ Execute $stmt
    $coats_products = $stmt->get_result(); // ✅ Fetch results
} else {
    die("SQL Error: " . $conn->error); // ✅ Show error if query fails
}

?>
