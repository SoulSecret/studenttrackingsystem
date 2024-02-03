<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["editprog"])) {
    
   include 'connection.php';

    $program_id = $_POST["program_id"];
    $new_program_name = $_POST["editProgramName"];

    // Update the program name in the database
    $sql = "UPDATE program_name SET program_name='$new_program_name' WHERE id=$program_id";

    if ($connection->query($sql) === TRUE) {
        // Redirect to the page with the program names table
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error updating record: " . $connection->error;
    }

    $connection->close();
}
?>