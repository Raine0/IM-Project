<?php
include "../db-conn.php"; // Include the correct file path for db-conn.php

if(isset($_POST['update_data_btn']))
{
    $id = $_POST['product_id'];

    $name = $_POST['editName'];
    $category = $_POST['editCategory'];
    $brand = $_POST['editBrand'];
    $cost = $_POST['editCost'];
    $price = $_POST['editPrice'];
    $quantity = $_POST['editQuantity'];

    $query = "UPDATE products SET Name='$name', Category='$category', Brand='$brand', Cost='$cost', Price='$price', Quantity='$quantity' WHERE Product_id ='$id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Delete successful, show modal confirmation
        echo "successful";
        exit();
    } else {
        echo "Failed: " . mysqli_error($conn);
    }
} else {
    echo "Failed to connect to the database.";
}
?>
