<?php include("_includes/config.inc"); include("_includes/dbconnect.inc"); include("_includes/functions.inc"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php
    // check logged in
    if (isset($_SESSION['id'])) {
        echo template("templates/partials/header.php");
        echo template("templates/partials/nav.php");
    ?>
        <div class="container mt-5">
            <h2 class="text-center mb-4">My Details</h2>
            <?php
            // if the form has been submitted
            if (isset($_POST['submit'])) {
                // build an sql statement to update the student details
                $sql = "UPDATE student SET firstname ='" . $_POST['txtfirstname'] . "',";
                $sql .= "lastname ='" . $_POST['txtlastname'] . "',";
                $sql .= "house ='" . $_POST['txthouse'] . "',";
                $sql .= "town ='" . $_POST['txttown'] . "',";
                $sql .= "county ='" . $_POST['txtcounty'] . "',";
                $sql .= "country ='" . $_POST['txtcountry'] . "',";
                $sql .= "postcode ='" . $_POST['txtpostcode'] . "' ";
                $sql .= "WHERE studentid = '" . $_SESSION['id'] . "';";
                $result = mysqli_query($conn, $sql);
                $data['content'] = "<p class='text-success'>Your details have been updated</p>";
            } else {
                // Build a SQL statement to return the student record with the id that
                // matches that of the session variable using prepared statements.
                $stmt = $conn->prepare("SELECT * FROM student WHERE studentid = ?");
                $stmt->bind_param("s", $_SESSION['id']); // 's' specifies the variable type => 'string'

                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();

               // You can continue with your HEREDOC notation or any other operation with $row
              // For example, using HEREDOC to build a string with student information:
               $data['content'] = <<<EOD

                <form name="frmdetails" action="" method="post">
                    <div class="form-group">
                        <label for="txtfirstname">First Name</label>
                        <input type="text" class="form-control" id="txtfirstname" name="txtfirstname" value="{$row['firstname']}" required>
                    </div>
                    <div class="form-group">
                        <label for="txtlastname">Surname</label>
                        <input type="text" class="form-control" id="txtlastname" name="txtlastname" value="{$row['lastname']}" required>
                    </div>
                    <div class="form-group">
                        <label for="txthouse">Number and Street</label>
                        <input type="text" class="form-control" id="txthouse" name="txthouse" value="{$row['house']}" required>
                    </div>
                    <div class="form-group">
                        <label for="txttown">Town</label>
                        <input type="text" class="form-control" id="txttown" name="txttown" value="{$row['town']}" required>
                    </div>
                    <div class="form-group">
                        <label for="txtcounty">County</label>
                        <input type="text" class="form-control" id="txtcounty" name="txtcounty" value="{$row['county']}" required>
                    </div>
                    <div class="form-group">
                        <label for="txtcountry">Country</label>
                        <input type="text" class="form-control" id="txtcountry" name="txtcountry" value="{$row['country']}" required>
                    </div>
                    <div class="form-group">
                        <label for="txtpostcode">Postcode</label>
                        <input type="text" class="form-control" id="txtpostcode" name="txtpostcode" value="{$row['postcode']}" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Save</button>
                </form>
EOD;
            }
            // render the template
            echo template("templates/default.php", $data);
        ?>
        </div>
    <?php
    } else {
        header("Location: index.php");
    }
    echo template("templates/partials/footer.php");
    ?>
</body>
</html>
