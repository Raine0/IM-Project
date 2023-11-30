<?php
include "../db-conn.php";

extract($_POST);

if (isset($_POST['productSend']) && isset($_POST['customerSend']) && 
    isset($_POST['userSend']) && isset($_POST['dateSend']) && isset($_POST['quantitySend'])) {

    $sql = "INSERT INTO `sales` (`product_ID`, `customer_ID`, `User_id`, `date_of_sale`, `quantity_sold`) 
            VALUES ('$productSend', '$customerSend', '$userSend', STR_TO_DATE('$dateSend', '%Y-%m-%d %H:%i:%s'), '$quantitySend')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // JavaScript code to close the modal
        echo "successful";
        exit();
    }
}
?>  
