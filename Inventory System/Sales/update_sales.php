<?php
include "../db-conn.php"; // Include the correct file path for db-conn.php

if(isset($_POST['update_data_btn']))
{
    $id = $_POST['sales_id'];

    $Product = $_POST['editProduct'];
    $Customer = $_POST['editCustomer'];
    $User = $_POST['editUser'];
    $Date = $_POST['editDate'];
    $Quantity = $_POST['editQuantity'];

    $query = "UPDATE sales SET product_ID='$Product', customer_ID='$Customer', User_id='$User', date_of_sale='$Date', quantity_sold='$Quantity' WHERE sales_ID ='$id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Update successful, show modal confirmation
        echo "successful";
        exit();
    } else {
        echo "Failed: " . mysqli_error($conn);
    }
} else {
    echo "Failed to connect to the database.";
}
?>
