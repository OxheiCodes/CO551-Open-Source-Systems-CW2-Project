<?php
include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");
echo template("templates/partials/header.php");
echo template("templates/partials/nav.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Records</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .table thead th {
            color: black; /* Ensures table headings are black */
        }
        .btn {
            padding: 0.5rem 1rem; /* Custom button sizing */
            font-size: 1rem; /* Adjust font size as needed */
        }
    </style>
    <script>
        // JavaScript function to confirm deletion
        function confirmDeletion() {
            return confirm('Are you sure you want to delete the selected records?');
        }
    </script>
</head>
<body>
    <div class="container my-4">
        <h2 class="mb-4">Student Records</h2>
        <div class="d-flex justify-content-end mb-3">
            <a href="addstudent.php" class="btn btn-primary me-2">Add</a>
            <form action="seed.php" method="post" class="d-inline-block me-2">
                <button type="submit" class="btn btn-secondary">Seed</button>
            </form>
            <button onclick="return confirmDeletion()" form="deleteForm" type="submit" class="btn btn-danger">Delete Selected</button>
        </div>
        <form id="deleteForm" method="POST" action="deleteStudents.php">
            <table class="table table-bordered table-striped text-info">
                <thead>
                    <tr>
                        <th>Select</th>
                        <th>Student ID</th>
                        <th>Password</th>
                        <th>Date of Birth</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>House</th>
                        <th>Town</th>
                        <th>County</th>
                        <th>Country</th>
                        <th>Postcode</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
    <?php
    $sql = "SELECT * FROM student";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td><input type='checkbox' name='selected_students[]' value='" . $row["studentid"] . "'></td>";
            echo "<td>" . htmlspecialchars($row["studentid"]) . "</td>";
            echo "<td>[Protected]</td>"; // Do not display passwords
            echo "<td>" . htmlspecialchars($row["dob"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["firstname"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["lastname"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["house"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["town"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["county"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["country"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["postcode"]) . "</td>";
            if (!empty($row["image_path"])) {
                echo "<td><img src='" . htmlspecialchars($row["image_path"]) . "' alt='Student Image' class='img-fluid' style='max-width: 100px;'></td>";
            } else {
                echo "<td>No image available</td>";
            }
            echo "<td><a href='editStudent.php?studentid=" . urlencode($row["studentid"]) . "' class='btn btn-sm btn-primary'>Edit</a></td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='13' class='text-center'>No records found</td></tr>";
    }
    ?>
</tbody>
            </table>
        </form>
    </div>
</body>
</html>

