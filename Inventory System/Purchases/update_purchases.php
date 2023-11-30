<?php
include "../db-conn.php"; // Include the correct file path for db-conn.php

if(isset($_POST['update_data_btn']))
{
    $id = $_POST['purchase_id'];

    $Product = $_POST['editProduct'];
    $Supplier = $_POST['editSupplier'];
    $Date = $_POST['editDate'];
    $Arrival = $_POST['editArrival'];
    $Quantity = $_POST['editQuantity'];

    $query = "UPDATE purchases SET product_ID='$Product', supplier_ID='$Supplier', date_of_purchase='$Date', date_of_arrival='$Arrival', quantity_purchased='$Quantity' WHERE purchase_ID ='$id'";
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
