<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

$studentId = isset($_GET['studentid']) ? $_GET['studentid'] : '';
if ($studentId) {
    $stmt = $conn->prepare("SELECT * FROM student WHERE studentid = ?");
    $stmt->bind_param("s", $studentId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        echo "<form action='updateStudent.php' method='post' enctype='multipart/form-data'>";
        echo "<input type='hidden' name='studentid' value='" . $row['studentid'] . "'>";
        // Dynamically create form fields for all student details
        foreach ($row as $field => $value) {
            if ($field != 'studentid' && $field != 'image_path') { // Skip editing student ID and image path directly
                echo ucfirst($field) . ": <input type='text' name='$field' value='" . htmlspecialchars($value) . "' required><br>";
            }
        }
        echo "Student Image: <input type='file' name='image'><br><br>";
        echo "<input type='submit' value='Update Student'>";
        echo "</form>";
    } else {
        echo "Student not found.";
    }
    $stmt->close();
} else {
    echo "No student ID provided.";
}

?>
