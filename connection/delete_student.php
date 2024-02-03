<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['alumniIddelete'])) {
    require 'connection/connection.php';

    if ($connection) {
        $alumniId = mysqli_real_escape_string($connection, $_POST['alumniId']);

        $deleteQuery = "DELETE FROM students_form WHERE id = '$alumniId'";
        $result = mysqli_query($connection, $deleteQuery);

        if ($result) {
            // Redirect to the alumni list page after successful deletion
            header('Location: dashboard.php');
            exit();
        } else {
            // Handle the database deletion error
            echo "Error: " . mysqli_error($connection);
        }

        mysqli_close($connection);
    }
}
