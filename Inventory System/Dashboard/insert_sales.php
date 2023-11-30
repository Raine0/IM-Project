<?php
include "../db-conn.php";

// Include the function definition
include "path/to/calculate_total_revenue_function.php";

extract($_POST);

if (isset($_POST['productSend']) && isset($_POST['customerSend']) && 
    isset($_POST['userSend']) && isset($_POST['dateSend']) && isset($_POST['quantitySend'])) {

    // Insert into the 'sales' table
    $sql = "INSERT INTO `sales` (`product_ID`, `customer_ID`, `User_id`, `date_of_sale`, `quantity_sold`) 
            VALUES ('$productSend', '$customerSend', '$userSend', STR_TO_DATE('$dateSend', '%Y-%m-%d %H:%i:%s'), '$quantitySend')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Call the calculate_total_revenue function and update the total_revenue field
        $calculateTotalRevenueSQL = "UPDATE `sales` 
                                     SET `total_revenue` = calculate_total_revenue('$productSend', '$quantitySend') 
                                     WHERE `product_ID` = '$productSend' AND `date_of_sale` = STR_TO_DATE('$dateSend', '%Y-%m-%d %H:%i:%s')";
        $updateResult = mysqli_query($conn, $calculateTotalRevenueSQL);

        if ($updateResult) {
            // JavaScript code to close the modal
            echo "successful";
            exit();
        } else {
            // Handle the update error
            echo "Error updating total revenue: " . mysqli_error($conn);
        }
    } else {
        // Handle the insert error
        echo "Error inserting into sales: " . mysqli_error($conn);
    }
}
?>

