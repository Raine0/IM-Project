<?php
include "../db-conn.php"; // Include the correct file path for db-conn.php

if(isset($_POST['delete_data_btn']))
{
    $id = $_POST['user_id'];

    // Check if the connection was successful
    if ($conn) {
        // Set the foreign key in the sales table to NULL
        $updateSalesSql = "UPDATE sales SET User_id = NULL WHERE User_id = '$id'";
        $updateSalesResult = mysqli_query($conn, $updateSalesSql);

        if ($updateSalesResult) {
            // Update successful, continue with deleting the user
            $deleteSql = "DELETE FROM users WHERE User_id = '$id'";
            $deleteResult = mysqli_query($conn, $deleteSql);

            if ($deleteResult) {
                // Delete successful, show modal confirmation
                echo "successful";
                exit();
            } else {
                echo "Failed to delete user: " . mysqli_error($conn);
            }
        } else {
            echo "Failed to update sales: " . mysqli_error($conn);
        }
    } else {
        echo "Failed to connect to the database.";
    }
}
?>
