<?php
include "../db-conn.php"; // Include the correct file path for db-conn.php

if (isset($_POST['delete_data_btn'])) {
    $id = $_POST['product_id'];

    // Check if the connection was successful
    if ($conn) {
        // Set the foreign key in the purchases table to NULL
        $updatePurchasesSql = "UPDATE purchases SET product_id = NULL WHERE product_id = '$id'";
        $updatePurchasesResult = mysqli_query($conn, $updatePurchasesSql);

        // Set the foreign key in the sales table to NULL
        $updateSalesSql = "UPDATE sales SET product_id = NULL WHERE product_id = '$id'";
        $updateSalesResult = mysqli_query($conn, $updateSalesSql);

        if ($updatePurchasesResult && $updateSalesResult) {
            // Update successful, continue with deleting the product
            $deleteSql = "DELETE FROM products WHERE product_id = '$id'";
            $deleteResult = mysqli_query($conn, $deleteSql);

            if ($deleteResult) {
                // Delete successful, show modal confirmation
                echo "successful";
                exit();
            } else {
                echo "Failed to delete product: " . mysqli_error($conn);
            }
        } else {
            echo "Failed to update purchases or sales: " . mysqli_error($conn);
        }
    } else {
        echo "Failed to connect to the database.";
    }
}
?>
