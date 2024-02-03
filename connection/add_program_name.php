<?php
// Process the form submission and insert new program name into the database
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_program_name'])) {
    require 'connection/connection.php';

    if ($connection) {
        $program_name = mysqli_real_escape_string($connection, strtoupper($_POST['program_name']));

        // Check if the program name already exists in the database
        $checkQuery = "SELECT * FROM program_name WHERE program_name = '$program_name'";
        $checkResult = mysqli_query($connection, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            // Program name already exists, handle the duplicate entry error
            echo "Error: Program name '$program_name' already exists in the database.";
        } else {
            $program_name = strtoupper($program_name);
            // Insert the new program name into the database
            $insertQuery = "INSERT INTO program_name (program_name) VALUES ('$program_name')";
            $result = mysqli_query($connection, $insertQuery);

            if ($result) {
                // Retrieve the new program ID
                $newProgramId = mysqli_insert_id($connection);

                // Return the new program ID (you can customize this response as needed)
                //echo $newProgramId;
            } else {
                // Handle the database insertion error
                echo "Error: " . mysqli_error($connection);
            }
        }

        mysqli_close($connection);
    }
}
?>