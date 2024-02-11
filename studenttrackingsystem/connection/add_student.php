<?php
// Process the form submission and insert new alumni record into the database
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    require 'connection/connection.php';

    if ($connection) {
        // Retrieve form data
        $prog_id = mysqli_real_escape_string($connection, $_POST["prog_id"]);
        $name = mysqli_real_escape_string($connection, $_POST["name"]);
        $status = mysqli_real_escape_string($connection, $_POST["status"]);
        $noc_tob = mysqli_real_escape_string($connection, $_POST["noc_tob"]);
        $pic = mysqli_real_escape_string($connection, $_POST["pic"]);
        $tracked_by = mysqli_real_escape_string($connection, $_POST["tracked_by"]);
        $permanent = mysqli_real_escape_string($connection, $_POST["Permanent"]);
        $related_field = mysqli_real_escape_string($connection, $_POST["Related_Field"]);
        $more_than_six_months_employed = mysqli_real_escape_string($connection, $_POST["More_than_six_months_employed"]);
        $gender = mysqli_real_escape_string($connection, $_POST["gender"]);
        $sygraduate = mysqli_real_escape_string($connection, $_POST["sygraduate"]);

        $name = strtoupper($name);
        // SQL query to insert data into the student_form table
        $insertQuery = "INSERT INTO students_form (program_name_id, fullname, status, noc_tob, position_in_company, tracked_by, permanent, related_field, employed_for_over_six_months, gender, sygraduate)
            VALUES ('$prog_id', '$name', '$status', '$noc_tob', '$pic', '$tracked_by', '$permanent', '$related_field', '$more_than_six_months_employed', '$gender', '$sygraduate')";
        $result = mysqli_query($connection, $insertQuery);

        if ($result) {
            // Retrieve the new alumni ID
            $newAlumniId = mysqli_insert_id($connection);

            // Return the new alumni ID (you can customize this response as needed)
            //echo $newAlumniId;
        } else {
            // Handle the database insertion error
            echo "Error: " . mysqli_error($connection);
        }

        mysqli_close($connection);
    }
}