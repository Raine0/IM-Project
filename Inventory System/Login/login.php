<?php
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Database connection
    $con = new mysqli("localhost", "root", "", "inventory system");
    if ($con->connect_error) {
        die("Failed to connect: " . $con->connect_error);
    } else {
        $stmt = $con->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt_result = $stmt->get_result();
        if ($stmt_result->num_rows > 0) {
            $data = $stmt_result->fetch_assoc();
            if ($data['password'] === $password) {
                // Redirect to another PHP file
                header("Location: ../Products/products.php");
                exit();
            } else {
                echo "<h2>Invalid username or password</h2>";
            }
        } else {
            echo "<h2>Invalid username or password</h2>";
        }
    }
?>
