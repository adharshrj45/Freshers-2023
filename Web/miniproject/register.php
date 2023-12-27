<?php
// Establish a connection to the MySQL database
$servername = "localhost";
$username = "root";
$password = "";  // Your MySQL password
$dbname = "yokoso";  // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $passwords = $_POST["passwords"];
    $confirm_password = $_POST["confirm_password"];

    // Perform password matching validation
    if ($passwords !== $confirm_password) {
        echo "Passwords do not match";
    } else {
        // Hash the password before storing it in the database
        $hashed_password = password_hash($passwords, PASSWORD_DEFAULT);

        // Insert data into the users table
        $sql = "INSERT INTO registration (first_name, last_name, email, passwords) 
                VALUES ('$first_name', '$last_name', '$email', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            // Redirect to login.html upon successful registration
            header("Location: login.html");
            exit(); // Ensure no further code execution after redirection
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
