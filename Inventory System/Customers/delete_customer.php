<?php
include "../db-conn.php"; // Include the correct file path for db-conn.php

if(isset($_POST['delete_data_btn']))
{
    $id = $_POST['customer_id'];

    // Check if the connection was successful
    if ($conn) {
        // Set the foreign key in the sales table to NULL
        $updateSalesSql = "UPDATE sales SET customer_ID = NULL WHERE customer_ID = '$id'";
        $updateSalesResult = mysqli_query($conn, $updateSalesSql);

        if ($updateSalesResult) {
            // Update successful, continue with deleting the customer
            $deleteSql = "DELETE FROM customers WHERE customer_id = '$id'";
            $deleteResult = mysqli_query($conn, $deleteSql);

            if ($deleteResult) {
                // Delete successful, show modal confirmation
                echo "successful";
                exit();
            } else {
                echo "Failed to delete customer: " . mysqli_error($conn);
            }
        } else {
            echo "Failed to update sales: " . mysqli_error($conn);
        }
    } else {
        echo "Failed to connect to the database.";
    }
}
?>
