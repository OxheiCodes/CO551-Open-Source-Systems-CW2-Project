<?php include("_includes/config.inc"); include("_includes/dbconnect.inc"); include("_includes/functions.inc"); echo template("templates/partials/header.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Student</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .btn-primary {
            font-size: 1.2rem;
            font-weight: bold;
            padding: 0.8rem 1.5rem;
        }
    </style>
</head>
<body>
    <?php echo template("templates/partials/nav.php"); ?>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Add New Student</h2>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="process_addstudent.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="studentid">Student ID:</label>
                        <input type="text" class="form-control" id="studentid" name="studentid" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="dob">Date of Birth:</label>
                        <input type="date" class="form-control" id="dob" name="dob" required>
                    </div>
                    <div class="form-group">
                        <label for="firstname">First Name:</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" required>
                    </div>
                    <div class="form-group">
                        <label for="lastname">Last Name:</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" required>
                    </div>
                    <div class="form-group">
                        <label for="house">House:</label>
                        <input type="text" class="form-control" id="house" name="house">
                    </div>
                    <div class="form-group">
                        <label for="town">Town:</label>
                        <input type="text" class="form-control" id="town" name="town">
                    </div>
                    <div class="form-group">
                        <label for="county">County:</label>
                        <input type="text" class="form-control" id="county" name="county">
                    </div>
                    <div class="form-group">
                        <label for="country">Country:</label>
                        <input type="text" class="form-control" id="country" name="country">
                    </div>
                    <div class="form-group">
                        <label for="postcode">Postcode:</label>
                        <input type="text" class="form-control" id="postcode" name="postcode">
                    </div>
                    <div class="form-group">
                        <label for="image">Student Image:</label>
                        <input type="file" class="form-control-file" id="image" name="image">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block btn-lg">Add Student</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
