<?php

// Initialize variables
$registrationError = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {


    $user = $_POST['registerUsername'];
    $pass = $_POST['registerPassword'];
    $hashedPassword = password_hash($pass, PASSWORD_BCRYPT);
    require 'connection/connection.php';

    // Use prepared statements to prevent SQL injection
    $stmt = $connection->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $user, $hashedPassword);

    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "<script>alert('Register Succesfully!')</script>";
        header('Location: index.php'); // Redirect to the login page
        exit();
    } else {
        // Registration failed - Show an error message
        $registrationError = 'Registration failed. Please try again.';
    }

    // Close the prepared statement
    $connection->close();

    // Close the database connection
    $connection->close();
}