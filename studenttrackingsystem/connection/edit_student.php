<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['alumniIdedit'])) {
    require 'connection/connection.php';

    if ($connection) {
        $alumniId = mysqli_real_escape_string($connection, $_POST['alumniId']);
        $editAlumnifname = mysqli_real_escape_string($connection, $_POST['editAlumnifname']);
        $editAlumniProgram = mysqli_real_escape_string($connection, $_POST['editAlumniProgram']);
        $editAlumniStatus = mysqli_real_escape_string($connection, $_POST['editAlumniStatus']);
        $editAlumniNocTob = mysqli_real_escape_string($connection, $_POST['editAlumniNocTob']);
        $editAlumniPic = mysqli_real_escape_string($connection, $_POST['editAlumniPic']);
        $editAlumniTrackedBy = mysqli_real_escape_string($connection, $_POST['editAlumniTrackedBy']);
        $editAlumniPermanent = mysqli_real_escape_string($connection, $_POST['editAlumniPermanent']);
        $editAlumniRelatedField = mysqli_real_escape_string($connection, $_POST['editAlumniRelatedField']);
        $editAlumniMoreThanSixMonths = mysqli_real_escape_string($connection, $_POST['editAlumniMoreThanSixMonths']);
        $editAlumniGender = mysqli_real_escape_string($connection, $_POST['editAlumniGender']);

        $updateQuery = "UPDATE students_form SET
            program_name_id = '$editAlumniProgram',
            fullname = '$editAlumnifname',
            status = '$editAlumniStatus',
            noc_tob = '$editAlumniNocTob',
            position_in_company = '$editAlumniPic',
            tracked_by = '$editAlumniTrackedBy',
            permanent = '$editAlumniPermanent',
            related_field = '$editAlumniRelatedField',
            employed_for_over_six_months = '$editAlumniMoreThanSixMonths',
            gender = '$editAlumniGender'
            WHERE id = '$alumniId'";

        $result = mysqli_query($connection, $updateQuery);

        if ($result) {
            // Redirect to the alumni list page after a successful update
            header('Location: dashboard.php');
            exit();
        } else {
            // Handle the database update error
            echo "Error: " . mysqli_error($connection);
        }

        mysqli_close($connection);
    }
}