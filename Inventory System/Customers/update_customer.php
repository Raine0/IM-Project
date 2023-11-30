<?php
include "../db-conn.php"; // Include the correct file path for db-conn.php

if(isset($_POST['update_data_btn']))
{
    $id = $_POST['customer_id'];

    $name = $_POST['editName'];
    $address = $_POST['editAddress'];
    $number = $_POST['editNumber'];
    $email = $_POST['editEmail'];

    $query = "UPDATE customers SET name='$name', address='$address', phone_number='$number', email='$email' WHERE customer_id ='$id'";
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
