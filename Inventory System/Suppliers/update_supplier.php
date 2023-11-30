<?php
include "../db-conn.php"; // Include the correct file path for db-conn.php

if(isset($_POST['update_data_btn']))
{
    $id = $_POST['supplier_id'];

    $supplier = $_POST['editSupplier'];
    $name = $_POST['editName'];
    $address = $_POST['editAddress'];
    $number = $_POST['editNumber'];
    $email = $_POST['editEmail'];

    $query = "UPDATE suppliers SET supplier_of='$supplier', name='$name', address='$address', phone_number='$number', email='$email' WHERE supplier_id ='$id'";
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
