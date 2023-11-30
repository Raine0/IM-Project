<?php
include "../db-conn.php";

extract($_POST);

if (isset($_POST['nameSend']) && isset($_POST['categorySend']) && isset($_POST['brandSend']) && 
    isset($_POST['costSend']) && isset($_POST['priceSend']) && isset($_POST['quantitySend'])) {

    $sql = "INSERT INTO `products` (`name`, `category`, `brand`, `cost`, `price`, `quantity`) 
            VALUES ('$nameSend', '$categorySend', '$brandSend', '$costSend', '$priceSend', '$quantitySend')";
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