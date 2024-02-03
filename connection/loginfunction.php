<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

    require 'connection/connection.php';

    $userN = $_POST['loginUsername'];
    $passW = $_POST['loginPassword'];

    $stmt = $connection->prepare("SELECT username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $userN);
    $stmt->execute();
    $stmt->bind_result($dbUsername, $dbPassword);
    $stmt->fetch();
    $stmt->close();

    // Check if the submitted credentials are valid
    if ($dbUsername && password_verify($passW, $dbPassword)) {
        $_SESSION["username"] = $username;
        // Successful login - Redirect or perform other actions
        header('Location: dashboard.php'); // Replace 'welcome.php' with your desired page
        exit();
    } else {
        // Invalid credentials - Show an error message
        $loginError = 'Invalid username or password';
    }

    // Close the database connection
    $connection->close();
}