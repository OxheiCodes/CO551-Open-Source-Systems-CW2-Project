<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

// Check if the form data is posted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $studentId = $_POST['studentid'];
    $fieldsToUpdate = [];
    
    // Assuming the form fields match the database columns
    foreach ($_POST as $key => $value) {
        if ($key != 'studentid' && $key != 'image') {
            $fieldsToUpdate[$key] = $value;
        }
    }

    // Initialize the SQL for updating student details
    $sqlSetParts = [];
    foreach ($fieldsToUpdate as $field => $value) {
        $sqlSetParts[] = "$field = ?";
    }

    // File upload logic
    $imagePath = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowedTypes = ['jpg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif'];
        $fileType = mime_content_type($_FILES['image']['tmp_name']);
        
        if (in_array($fileType, $allowedTypes)) {
            $fileExt = array_search($fileType, $allowedTypes);
            $imagePath = 'uploads/' . $studentId . '.' . $fileExt;
            
            if (!file_exists('uploads')) {
                mkdir('uploads', 0777, true);
            }
            if (!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                die("Failed to move uploaded file.");
            }
            // Add image path to the fields to update
            $sqlSetParts[] = "image_path = ?";
            $fieldsToUpdate['image_path'] = $imagePath;
        } else {
            die("Unsupported file type.");
        }
    }

    // Finalize the SQL statement
    $sql = "UPDATE student SET " . implode(", ", $sqlSetParts) . " WHERE studentid = ?";
    
    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $types = str_repeat('s', count($fieldsToUpdate)) . 's';
    // Merge the student ID into the array of field values
$params = array_merge(array_values($fieldsToUpdate), [$studentId]);

// Bind the parameters to the statement
$stmt->bind_param($types, ...$params);

    // Execute the update
    if ($stmt->execute()) {
        echo "Student updated successfully.";
    } else {
        echo "Error updating record: " . $stmt->error;
    }
    
    // Close the statement
    $stmt->close();
}

// Redirect back to the students list
header("Location: students.php");
exit();

?>


