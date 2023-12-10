<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
        $servername = "localhost";
        $username = "root";
        $password = "";  
        $dbname = "yokoso"; 

        
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

       
        $email = $_POST['email'];
        $passwords = $_POST['passwords'];

        $stmt = $conn->prepare("SELECT * FROM registration WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if (password_verify($passwords, $row['passwords'])) {
              
                header("Location: home.html");
                exit(); 
            } else {
              
                echo "Incorrect password!";
            }
        } else {
         
            echo "User not found!";
        }

    
        $stmt->close();
        $conn->close();
    }
?>
