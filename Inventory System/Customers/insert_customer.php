<?php
include "../db-conn.php";

extract($_POST);

if (isset($_POST['nameSend']) && isset($_POST['addressSend']) && 
    isset($_POST['phoneSend']) && isset($_POST['emailSend'])) {

    $sql = "INSERT INTO `customers` (`name`, `address`, `phone_number`, `email`) 
            VALUES ('$nameSend', '$addressSend', '$phoneSend', '$emailSend')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // JavaScript code to close the modal
        echo "<script>
                document.getElementById('createModal').modal('hide');
              </script>";
        exit();
    }
}
?>