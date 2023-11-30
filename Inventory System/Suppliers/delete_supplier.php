<?php
include "../db-conn.php"; // Include the correct file path for db-conn.php

if(isset($_POST['delete_data_btn']))
{
    $id = $_POST['supplier_id'];

    // Check if the connection was successful
    if ($conn) {
        // Set the foreign key in the purchases table to NULL
        $updatePurchasesSql = "UPDATE purchases SET supplier_ID = NULL WHERE supplier_ID = '$id'";
        $updatePurchasesResult = mysqli_query($conn, $updatePurchasesSql);

        if ($updatePurchasesResult) {
            // Update successful, continue with deleting the supplier
            $deleteSql = "DELETE FROM suppliers WHERE supplier_id = '$id'";
            $deleteResult = mysqli_query($conn, $deleteSql);

            if ($deleteResult) {
                // Delete successful, show modal confirmation
                echo "successful";
                exit();
            } else {
                echo "Failed to delete supplier: " . mysqli_error($conn);
            }
        } else {
            echo "Failed to update purchases or sales: " . mysqli_error($conn);
        }
    } else {
        echo "Failed to connect to the database.";
    }
}
?>
