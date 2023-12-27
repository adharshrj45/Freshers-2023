<?php
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'yokoso');
    if ($conn->connect_error) {
        die('Connection Failed  :' . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("insert into contact(name, email, message) values(?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $message);
        $stmt->execute();

        if (strlen($email) != 0) {
            header("location:home.html"); // Change this line to point to your home page
        } else {
            echo "<h4>Invalid message...</h4>";
        }

        $stmt->close();
        $conn->close();
    }
?>
