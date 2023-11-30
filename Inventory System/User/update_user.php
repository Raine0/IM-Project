<?php
include "../db-conn.php"; // Include the correct file path for db-conn.php

if(isset($_POST['update_data_btn']))
{
    $id = $_POST['user_id'];

    $name = $_POST['editName'];
    $Contact = $_POST['editContact'];
    $Email = $_POST['editEmail'];
    $Username = $_POST['editUsername'];

    $query = "UPDATE users SET Name='$name', Contact_number='$Contact', Email='$Email', username='$Username' WHERE User_id='$id'";
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
