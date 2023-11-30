<?php
include "../db-conn.php"; // Include your database connection file

if (isset($_GET['productID'])) {
    $productID = $_GET['productID'];

    $result = mysqli_query($conn, "SELECT `quantity` FROM `products` WHERE `product_ID` = '$productID'");
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        echo $row['quantity'];
    } else {
        echo "Error fetching product quantity";
    }
} else {
    echo "Invalid request";
}
?>
