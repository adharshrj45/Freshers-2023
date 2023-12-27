<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'studentform';

// Create a connection
$connection = new mysqli($host, $username, $password, $database);

// Check the connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $firstName = $_POST['FirstName'];
    $lastName = $_POST['LastName'];
    $email = $_POST['EmailID'];
    $age = $_POST['Age'];
    $gender = $_POST['Gender'];
    $mobileNumber = $_POST['MobileNumber'];

    // Handle file upload
    $imagePath = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $imageFileName = $_FILES['image']['name'];
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imagePath = 'uploads/' . $imageFileName; // Store the image in a directory named 'uploads'
        move_uploaded_file($imageTmpName, $imagePath);
    }

    // Insert data into the database, including the image path
    $sql = "INSERT INTO student (FirstName, LastName, EmailID, Age, Gender, MobileNumber, ImagePath) 
            VALUES ('$firstName', '$lastName', '$email', '$age', '$gender', '$mobileNumber', '$imagePath')";

    if ($connection->query($sql) === TRUE) {
        echo "Record inserted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
        
    }
}

// Close the connection
$connection->close();
?>
