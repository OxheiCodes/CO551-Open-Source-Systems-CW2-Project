<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

// Assuming all fields except image are text inputs
$studentId = $_POST['studentid'];
$fieldsToUpdate = [];

foreach ($_POST as $key => $value) {
    if ($key != 'studentid') { // Skip studentid in update query
        $fieldsToUpdate[$key] = $conn->real_escape_string($value);
    }
}

// Prepare the SQL statement dynamically
$sql = "UPDATE student SET ";
$sqlSetParts = [];
foreach ($fieldsToUpdate as $field => $value) {
    $sqlSetParts[] = "$field = ?";
}
$sql .= implode(", ", $sqlSetParts);
$sql .= " WHERE studentid = ?";

$stmt = $conn->prepare($sql);

// Dynamically bind parameters
$types = str_repeat('s', count($fieldsToUpdate) + 1); // All fields are strings, +1 for studentid
$values = array_merge(array_values($fieldsToUpdate), [$studentId]);
$stmt->bind_param($types, ...$values);

if ($stmt->execute()) {
    echo "Student updated successfully.";
} else {
    echo "Error updating record: " . $stmt->error;
}

$stmt->close();

// Handle the file upload separately...
// You'll need to implement file upload logic here.

header("Location: students.php"); // Redirect back to the students list
?>

