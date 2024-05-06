<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

if (isset($_POST['selected_students'])) {
    $selected_students = $_POST['selected_students'];
    foreach ($selected_students as $studentid) {
        // Assuming studentid is sanitized properly before building the query
        $sql = "DELETE FROM student WHERE studentid = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $studentid);
        $stmt->execute();
    }
    echo "<script>alert('Selected records have been deleted successfully.'); window.location.href='students.php';</script>";
} else {
    echo "<script>alert('No records selected for deletion.'); window.location.href='students.php';</script>";
}

?>
