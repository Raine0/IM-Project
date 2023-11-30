<?php
include "../db-conn.php"; // Include the correct file path for db-conn.php


if(isset($_POST['delete_data_btn']))
{
    $id = $_POST['purchase_id'];

    // Check if the connection was successful
    if ($conn) {
        $sql = "DELETE FROM `purchases` WHERE purchase_ID = '$id'";
        $result = mysqli_query($conn, $sql);

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
}
?>
