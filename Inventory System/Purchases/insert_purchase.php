<?php
include "../db-conn.php";

extract($_POST);

if (isset($_POST['productSend']) && isset($_POST['supplierSend']) && 
    isset($_POST['quantitySend']) && isset($_POST['dateSend']) && isset($_POST['arrivalSend'])) {

    $sql = "INSERT INTO `purchases` (`product_ID`, `supplier_ID`, `quantity_purchased`, `date_of_purchase`, `date_of_arrival`) 
            VALUES ('$productSend', '$supplierSend', $quantitySend, STR_TO_DATE('$dateSend', '%Y-%m-%d %H:%i:%s'), STR_TO_DATE('$arrivalSend', '%Y-%m-%d %H:%i:%s'))";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // JavaScript code to close the modal
        echo "successful";
        exit();
    }
}
?>
