<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    
    require 'connection.php';
    $program_id = $_GET["id"];

    // Delete the program name from the database
    $sql = "DELETE FROM program_name WHERE id=$program_id";

    if ($connection->query($sql) === TRUE) {
        // Redirect to the page with the program names table
        header("Location: ../dashboard.php");
        exit();
    } else {
        echo "Error deleting record: " . $connection->error;
    }

    $connection->close();
}
?>