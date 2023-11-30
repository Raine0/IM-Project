<?php
include "../db-conn.php";

extract($_POST);

if (isset($_POST['nameSend']) && isset($_POST['contactSend']) && 
    isset($_POST['emailSend']) && isset($_POST['usernameSend'])) {

    $sql = "INSERT INTO `users` (`name`, `Contact_number`, `email`, `username`) 
            VALUES ('$nameSend', '$contactSend', '$emailSend', '$usernameSend')";
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