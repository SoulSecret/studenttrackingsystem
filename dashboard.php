<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["username"])) {
    // If not logged in, redirect to the login page
    header("Location: index.php");
    exit();
}

// Display the secured content
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bootstrap Navigation Bar in PHP</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <?php require 'connection/add_student.php' ?>
    <?php require 'connection/delete_student.php' ?>
    <?php require 'connection/edit_student.php' ?>
    <?php require 'connection/add_program_name.php' ?>
    <?php require 'connection/connection.php' ?>
    <?php require 'connection/edit_program.php' ?>
    <?php require 'connection/delete_program.php' ?>
</head>

<body>
    <?php include 'navigationbar.php'; ?>

    <div class="container mt-4" style="max-width: 1850px">
        <h2>Students Tracking</h2>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addAlumniModal"
            style="margin-bottom: 10px">
            Add New Student
        </button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProgramModalLabel"
            style="margin-bottom: 10px">
            Add New Program Name
        </button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mangeProgramModalLabel"
            style="margin-bottom: 10px">
            Manage Program Name
        </button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#viewSummary"
            style="margin-bottom: 10px">
            View Summary
        </button>
        <div class="form-group">
            <label for="filterProgram">Filter by Program Name:</label>
            <select id="filterProgram" class="form-control">
                <option value="">All Programs</option>
                <?php
                // Fetch program names from the database
                $queryPrograms = "SELECT * FROM program_name";
                $resultPrograms = mysqli_query($connection, $queryPrograms);

                // Loop through the results to generate options
                while ($rowProgram = mysqli_fetch_assoc($resultPrograms)) {
                    echo '<option value="' . $rowProgram["program_name"] . '">' . $rowProgram["program_name"] . '</option>';
                }
                ?>
            </select>
        </div>

        <table id="alumniTable" class="table table-bordered table-striped">
            <thead class="thead-light">
                <tr>
                    <th>Program Name</th>
                    <th>Name Of Graduate</th>
                    <th>Status<br>(Employed, Unemployed, Not tracked)</th>
                    <th>Name Of Company/<br>Type of Business</th>
                    <th>Position in Company</th>
                    <th>Tracked By:</th>
                    <th>Permanent</th>
                    <th>Related Field</th>
                    <th>More than 6 months <br> employed</th>
                    <th>Gender</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!--button type='button' class='btn btn-info' data-toggle='modal' data-target='#viewAlumniModal{$row['id']}'>
                                    View
                                </button-->
                <?php
                if ($connection) {
                    $result = mysqli_query($connection, "SELECT students_form.*, program_name.program_name FROM students_form INNER JOIN program_name ON students_form.program_name_id = program_name.id");

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "
                        <tr data-program-name='{$row['program_name']}'>
                            <td>{$row['program_name']}</td>
                            <td>{$row['fullname']}</td>
                            <td>{$row['status']}</td>
                            <td>{$row['noc_tob']}</td>
                            <td>{$row['position_in_company']}</td>
                            <td>{$row['tracked_by']}</td>
                            <td>{$row['permanent']}</td>
                            <td>{$row['related_field']}</td>
                            <td>{$row['employed_for_over_six_months']}</td>
                            <td>{$row['gender']}</td>
                            
                            <td>
                            <button type='button' class='btn btn-warning btn-sm' data-toggle='modal' data-target='#editAlumniModal{$row['id']}'>
                            Edit
                        </button>
                        <button type='button' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#deleteAlumniModal{$row['id']}'>
                            Delete
                        </button>
                        
                        
                            </td>
                        </tr>
                    ";

                        //add new student modal
                        echo "
                     <div class='modal fade mx-auto' id='viewAlumniModal{$row['id']}' tabindex='-1' role='dialog' aria-labelledby='viewAlumniModalLabel{$row['id']}' aria-hidden='true'>
                         <div class='modal-dialog' role='document'>
                             <div class='modal-content'>
                                 <div class='modal-header'>
                                     <h5 class='modal-title' id='viewAlumniModalLabel{$row['id']}'>View Student Data</h5>
                                     <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                         <span aria-hidden='true'>&times;</span>
                                     </button>
                                 </div>
                                 <div class='modal-body'>
                                     <p>Program Name: <b>{$row['program_name']}</b></p>
                                     <p>Student Name: <b>{$row['fullname']}</b></p>
                                     <p>Status: <b>{$row['status']}</b></p>
                                     <p>Name Of Company/\n
                                     Type of Business: <b>{$row['noc_tob']}</b></p>
                                     <p>Position in Company: <b>{$row['position_in_company']}</b></p>
                                     <p>Tracked By: <b>{$row['tracked_by']}</b></p>
                                     <p>Permanent: <b>{$row['permanent']}</b></p>
                                     <p>Related Field: <b>{$row['related_field']}</b></p>
                                     <p>More than 6 months employed: <b>{$row['employed_for_over_six_months']}</b></p>
                                     <p>Gender: <b>{$row['gender']}</b></p>
                                 </div>
                             </div>
                         </div>
                     </div>
                 ";
                        //delete studdent modal
                        echo "
                    <div class='modal fade' id='deleteAlumniModal{$row['id']}' tabindex='-1' role='dialog' aria-labelledby='deleteAlumniModalLabel{$row['id']}' aria-hidden='true'>
                        <div class='modal-dialog' role='document'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <h5 class='modal-title' id='deleteAlumniModalLabel{$row['id']}'>Confirm Deletion</h5>
                                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>
                                </div>
                                <div class='modal-body'>
                                    <p>Are you sure you want to delete {$row['fullname']} record?</p>
                                </div>
                                <div class='modal-footer'>
                                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancel</button>
                                    <form action='' method='POST'>
                                        <input type='hidden' name='alumniId' value='{$row['id']}'>
                                        <button type='submit' class='btn btn-danger' name='alumniIddelete'>Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                ";
                        //edit student modal
                        echo "
                <div class='modal fade' id='editAlumniModal{$row['id']}' tabindex='-1' role='dialog' aria-labelledby='editAlumniModalLabel{$row['id']}' aria-hidden='true'>
                    <div class='modal-dialog' role='document'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h5 class='modal-title' id='editAlumniModalLabel{$row['id']}'>Edit Student Data</h5>
                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>
                            <div class='modal-body'>
                                <form action='' method='POST'>
                                    <input type='hidden' name='alumniId' value='{$row['id']}'>
                                    <div class='form-group'>
                                    <label for='editAlumniPic'>Student Name:</label>
                                    <input type='text' class='form-control' name='editAlumnifname' value='{$row['fullname']}' required>
                                </div>
                                    
                                    <div class='form-group'>
                                        <label for='editAlumniProgram'>Program Name:</label><br>
                                        <select name='editAlumniProgram' style='width: 90px; height: 40px'>";

                        // Fetch data from the database for program_name
                        $queryProgram = "SELECT * FROM program_name";
                        $resultProgram = mysqli_query($connection, $queryProgram);

                        // Loop through the results to generate options
                        while ($rowProgram = mysqli_fetch_assoc($resultProgram)) {
                            $selected = ($rowProgram['id'] == $row['program_name_id']) ? 'selected' : '';
                            echo '<option value="' . $rowProgram["id"] . '" ' . $selected . '>' . $rowProgram["program_name"] . '</option>';
                        }

                        echo "</select>
                                    </div>
                                    
                                    <div class='form-group'>
                                        <label for='editAlumniStatus'>Status:</label><br>
                                        <select name='editAlumniStatus' style='width: 130px; height: 40px'>
                                            <option value='Employed' " . ($row['status'] == 'Employed' ? 'selected' : '') . ">Employed</option>
                                            <option value='Unemployed' " . ($row['status'] == 'Unemployed' ? 'selected' : '') . ">Unemployed</option>
                                            <option value='Not Tracked' " . ($row['status'] == 'Not Tracked' ? 'selected' : '') . ">Not Tracked</option>
                                        </select>
                                    </div>
                                    
                                    <div class='form-group'>
                                        <label for='editAlumniNocTob'>Name Of Company/Type of Business:</label>
                                        <input type='text' class='form-control' name='editAlumniNocTob' value='{$row['noc_tob']}' required>
                                    </div>
                                    <div class='form-group'>
                                        <label for='editAlumniPic'>Position in Company:</label>
                                        <input type='text' class='form-control' name='editAlumniPic' value='{$row['position_in_company']}' required>
                                    </div>
                                    <div class='form-group'>
                                        <label for='editAlumniTrackedBy'>Tracked By:</label>
                                        <input type='text' class='form-control' name='editAlumniTrackedBy' value='{$row['tracked_by']}' required>
                                    </div>
                                    <div class='form-group'>
                                        <label for='editAlumniPermanent'>Permanent:</label><br>
                                        <input type='radio' name='editAlumniPermanent' value='Yes' " . ($row['permanent'] == 'Yes' ? 'checked' : '') . "> Yes&nbsp;&nbsp;
                                        <input type='radio' name='editAlumniPermanent' value='No' " . ($row['permanent'] == 'No' ? 'checked' : '') . "> No&nbsp;&nbsp;
                                    </div>
                                    <div class='form-group'>
                                        <label for='editAlumniRelatedField'>Related Field:</label><br>
                                        <input type='radio' name='editAlumniRelatedField' value='Yes' " . ($row['related_field'] == 'Yes' ? 'checked' : '') . "> Yes&nbsp;&nbsp;
                                        <input type='radio' name='editAlumniRelatedField' value='No' " . ($row['related_field'] == 'No' ? 'checked' : '') . "> No&nbsp;&nbsp;
                                    </div>
                                    <div class='form-group'>
                                        <label for='editAlumniMoreThanSixMonths'>More than 6 months employed:</label><br>
                                        <input type='radio' name='editAlumniMoreThanSixMonths' value='Yes' " . ($row['employed_for_over_six_months'] == 'Yes' ? 'checked' : '') . "> Yes&nbsp;&nbsp;
                                        <input type='radio' name='editAlumniMoreThanSixMonths' value='No' " . ($row['employed_for_over_six_months'] == 'No' ? 'checked' : '') . "> No&nbsp;&nbsp;
                                    </div>
                                    <div class='form-group'>
                                        <label for='editAlumniGender'>Gender:</label><br>
                                        <input type='radio' name='editAlumniGender' value='Male' " . ($row['gender'] == 'Male' ? 'checked' : '') . "> Male&nbsp;&nbsp;
                                        <input type='radio' name='editAlumniGender' value='Female' " . ($row['gender'] == 'Female' ? 'checked' : '') . "> Female&nbsp;&nbsp;
                                    </div>
                                        <hr>
                                    <button type='submit' class='btn btn-primary' name='alumniIdedit'>Save Changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            ";
                    }


                ?>

            </tbody>
        </table>
    </div>

    <!-- Add New Students Modal -->
    <div class="modal fade" id="addAlumniModal" tabindex="-1" role="dialog" aria-labelledby="addAlumniModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAlumniModalLabel">Add New Student</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="alumniName">Program Name:</label><br>
                            <select name="prog_id" id="prog_id" style="width: 90px; height: 40px">
                                <?php
                                // Fetch data from the database
                                $query = "SELECT * FROM program_name";
                                $result = mysqli_query($connection, $query);

                                // Loop through the results to generate options
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<option value="' . $row["id"] . '">' . $row["program_name"] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <?php
                        // Function to render radio buttons
                        function renderRadioButtons($name, $options)
                        {
                            foreach ($options as $option) {
                                echo '<input type="radio" name="' . $name . '" value="' . $option . '"> ' . $option . '&nbsp;&nbsp;';
                            }
                        }
                        ?>
                        <div class="form-group">
                            <label for="alumniEmail">Full Name:</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="status">Status:</label><br>
                            <select name="status" id="status" style="width: 130px; height: 40px">
                                <option value="Employed">Employed</option>
                                <option value="Unemployed">Unemployed</option>
                                <option value="Not Tracked">Not Tracked</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="noc_tob">Name Of Company/Type of Business:</label>
                            <input type="text" class="form-control" name="noc_tob" required>
                        </div>
                        <div class="form-group">
                            <label for="pic">Position in Company:</label>
                            <input type="text" class="form-control" name="pic" required>
                        </div>
                        <div class="form-group">
                            <label for="tracked_by">Tracked By:</label>
                            <input type="text" class="form-control" name="tracked_by" required>
                        </div>
                        <div class="form-group">
                            <label for="permanent">Permanent:</label><br>
                            <?php
                            $options = array("Yes", "No");
                            renderRadioButtons("Permanent", $options);
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="related_field">Related Field:</label><br>
                            <?php
                            renderRadioButtons("Related_Field", $options);
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="more_than_six_months_employed">More than 6 months employed:</label><br>
                            <?php
                            renderRadioButtons("More_than_six_months_employed", $options);
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender:</label><br>
                            <?php
                            $genders = array("Male", "Female");
                            renderRadioButtons("gender", $genders);
                            ?>
                        </div>
                        <button type="submit" class="btn btn-primary" name="add">Add New Student</button>
                    </form>


                </div>
            </div>
        </div>
    </div>


    <!-- Add New Program Name -->
    <div class="modal fade" id="addProgramModalLabel" tabindex="-1" role="dialog" aria-labelledby="addProgramModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAlumniModalLabel">Add New Program Name</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="program_name">Program Name:</label>
                            <input type="text" class="form-control" name="program_name" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="add_program_name">Add Program Name</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- View Summary -->
    <div class="modal fade" id="viewSummary" tabindex="-1" role="dialog" aria-labelledby="viewSummary"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" style="max-width: 1200px;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAlumniModalLabel">Summary: Per Campus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Summary: PER CAMPUS</th>
                                            <th>Employed</th>
                                            <th>Unemployed</th>
                                            <th>Not Tracked</th>
                                            <th>Permanent</th>
                                            <th>Related Field</th>
                                            <th>
                                                < 6 Months</th>
                                            <th>Male</th>
                                            <th>Female</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php
                                            $conditions = [
                                                'Total' => '',
                                                'Employed' => "WHERE students_form.status = 'Employed'",
                                                'Unemployed' => "WHERE students_form.status = 'Unemployed'",
                                                'Not Tracked' => "WHERE students_form.status = 'Not Tracked'",
                                                'Permanent' => "WHERE students_form.permanent = 'Yes'",
                                                'Related Field' => "WHERE students_form.related_field = 'Yes'",
                                                'Employed for Over Six Months' => "WHERE students_form.employed_for_over_six_months = 'Yes'",
                                                'Male' => "WHERE students_form.gender = 'Male'",
                                                'Female' => "WHERE students_form.gender = 'Female'",
                                            ];

                                            foreach ($conditions as $label => $condition) {
                                                $sql = "SELECT COUNT(*) as count FROM students_form $condition";
                                                $result = mysqli_query($connection, $sql);

                                                if ($result) {
                                                    $row = mysqli_fetch_assoc($result);
                                                    $totalRows = $row['count'];
                                                    echo "<td><b>$totalRows</b></td>";
                                                } else {
                                                    echo "<td>Error: " . mysqli_error($connection) . "</td>";
                                                }
                                            }
                                            ?>
                                        </tr>

                                        <tr>
                                            <td><b>Percentage</b></td>
                                            <?php
                                            $conditions = [
                                                'Employed' => "status = 'Employed'",
                                                'Unemployed' => "status = 'Unemployed'",
                                                'Not Tracked' => "status = 'Not Tracked'",
                                                'Permanent' => "permanent = 'Yes'",
                                                'Related Field' => "related_field = 'Yes'",
                                                'Employed for Over Six Months' => "employed_for_over_six_months = 'Yes'",
                                                'Male' => "gender = 'Male'",
                                                'Female' => "gender = 'Female'",
                                            ];


                                            foreach ($conditions as $condition => $whereClause) {
                                                $sqlTotal = "SELECT COUNT(*) as total_rows FROM students_form";
                                                $resultTotal = mysqli_query($connection, $sqlTotal);

                                                $sql = "SELECT COUNT(*) as employed_rows FROM students_form WHERE $whereClause";
                                                $resultEmployed = mysqli_query($connection, $sql);

                                                if ($resultTotal && $resultEmployed) {
                                                    // Fetch the total rows count
                                                    $rowTotal = mysqli_fetch_assoc($resultTotal);
                                                    $totalRows = $rowTotal['total_rows'];

                                                    // Fetch the employed rows count
                                                    $rowEmployed = mysqli_fetch_assoc($resultEmployed);
                                                    $employedRows = $rowEmployed['employed_rows'];

                                                    // Calculate the percentage
                                                    $percentage = ($employedRows / $totalRows) * 100;
                                                    $formattedPercentage = number_format($percentage, 2);

                                                    echo "<td><b>{$formattedPercentage}%</b></td>";


                                                } else {
                                                    // Handle query error
                                                    echo "<td>Error: " . mysqli_error($connection) . "</td>";
                                                }
                                            }
                                        ?>

                                        </tr>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Manage Program Name -->
    <div class="modal fade" id="mangeProgramModalLabel" tabindex="-1" role="dialog"
        aria-labelledby="addProgramModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAlumniModalLabel">Manage Program Name</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                if ($connection->connect_error) {
                    die("Connection failed: " . $connection->connect_error);
                    }

                    // Fetch program names from the database
                    $sql = "SELECT * FROM program_name";
                    $result = $connection->query($sql);

                    // Display program names in a table with action buttons
                    if ($result->num_rows > 0) {
                        echo "<table class='table'><thead><tr><th>Program Name</th><th>Edit</th><th>Delete</th></tr></thead><tbody>";
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["program_name"] . "</td>";

                            // Edit Button and Modal
                            echo "<td><button class='btn btn-primary' data-toggle='modal' data-target='#editModal" . $row["id"] . "'>Edit</button></td>";
                            echo "<div class='modal fade' id='editModal" . $row["id"] . "' tabindex='-1' role='dialog' aria-labelledby='editModalLabel' aria-hidden='true'>";
                            echo "<div class='modal-dialog' role='document'>";
                            echo "<div class='modal-content custom-modal-content'>";
                            echo "<div class='modal-header'>";
                            echo "<h5 class='modal-title' id='editModalLabel'>Edit Program Name</h5>";
                            echo "<button type='button' class='close' aria-label='Close' onclick='closeEditModal(" . $row["id"] . ")'>";
                            echo "<span aria-hidden='true'>&times;</span>";
                            echo "</button>";
                            echo "</div>";
                            echo "<div class='modal-body'>";
                            echo "<form action='' method='post'>";
                            echo "<input type='hidden' name='program_id' value='" . $row["id"] . "'>";
                            echo "<div class='form-group'>";
                            echo "<label for='editProgramName'>Program Name:</label>";
                            echo "<input type='text' class='form-control' id='editProgramName' name='editProgramName' value='" . $row["program_name"] . "'>";
                            echo "</div>";
                            echo "<button type='submit' class='btn btn-primary' name='editprog'>Save Changes</button>";
                            echo "</form>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";

                            // Delete Button and Modal
                            echo "<td><button class='btn btn-danger' data-toggle='modal' data-target='#deleteModal" . $row["id"] . "'>Delete</button></td>";
                            echo "<div class='modal fade' id='deleteModal" . $row["id"] . "' tabindex='-1' role='dialog' aria-labelledby='deleteModalLabel' aria-hidden='true'>";
                            echo "<div class='modal-dialog' role='document'>";
                            echo "<div class='modal-content custom-modal-content'>";
                            echo "<div class='modal-header'>";
                            echo "<h5 class='modal-title' id='deleteModalLabel'>Confirm Deletion</h5>";
                            echo "<button type='button' class='close' aria-label='Close' onclick='closeDeleteModal(" . $row["id"] . ")'>";
                            echo "<span aria-hidden='true'>&times;</span>";
                            echo "</button>";
                            echo "</div>";
                            echo "<div class='modal-body'>";
                            echo "<p>Are you sure you want to delete the program: " . $row["program_name"] . "?</p>";
                            echo "</div>";
                            echo "<div class='modal-footer'>";
                            echo "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>";
                            echo "<a href='connection/delete_program.php?id=" . $row["id"] . "' class='btn btn-danger'>Delete</a>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            
                            echo "</tr>";
                        }
                        echo "</tbody></table>";
                    } else {
                        echo "0 results";
                    }


                    
                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php
                    mysqli_close($connection);
                }
?>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
    $(document).ready(function() {
        // Event handler for the program name filter
        $('#filterProgram').change(function() {
            var selectedProgram = $(this).val();

            // Show all table rows
            $('#alumniTable tbody tr').show();

            // Hide rows that don't match the selected program name
            if (selectedProgram) {
                $('#alumniTable tbody tr').not('[data-program-name="' + selectedProgram + '"]').hide();
            }
        });
    });
    </script>

    <script>
    function closeEditModal(id) {
        $('#editModal' + id).modal('hide');
    }

    function closeDeleteModal(id) {
        $('#deleteModal' + id).modal('hide');
    }
    </script>
    </script>
    <!-- Add custom style for the modal content margin -->
    <style>
    .custom-modal-content {
        margin-top: 500px;
    }
    </style>
</body>

</html>