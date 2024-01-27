<!-- Add the error message display in the HTML if registration fails -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Registration Form</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <?php require 'connection/registrationfunction.php' ?>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-secondary">
        <a class="navbar-brand" href="#">Alumni System</a>
        <button class="navbar-toggler btn btn-primary" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2>Register</h2>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($registrationError)) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $registrationError; ?>
                        </div>
                        <?php endif; ?>

                        <form action="registration.php" method="post">
                            <div class="form-group">
                                <label for="registerUsername">Username:</label>
                                <input type="text" class="form-control" id="registerUsername" name="registerUsername"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="registerPassword">Password:</label>
                                <input type="password" class="form-control" id="registerPassword"
                                    name="registerPassword" required>
                            </div>
                            <button type="submit" class="btn btn-success" name="register">Register</button><br>
                            <center>
                                <p>Do you have an account?</p>
                                <button type="button" class="btn btn-primary ml-auto"
                                    onclick="window.location.href='/alumnisystem'">Login</button>
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>

</html>