<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

// Check if the form data is posted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $studentId = $_POST['studentid'];
    $fieldsToUpdate = [];
    
    // Collect form data, excluding studentid and image fields
    foreach ($_POST as $key => $value) {
        if ($key != 'studentid' && $key != 'image') {
            $fieldsToUpdate[$key] = $value;
        }
    }

    // Initialize the SQL parts for updating student details
    $sqlSetParts = [];
    foreach ($fieldsToUpdate as $field => $value) {
        $sqlSetParts[] = "$field = ?";
    }

    // File upload logic
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowedTypes = ['jpg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif'];
        $fileType = mime_content_type($_FILES['image']['tmp_name']);
        
        if (in_array($fileType, $allowedTypes)) {
            $fileExt = array_search($fileType, $allowedTypes);
            $imagePath = 'uploads/' . $studentId . '.' . $fileExt;
            
            // Create the uploads directory if it doesn't exist
            if (!file_exists('uploads')) {
                mkdir('uploads', 0777, true);
            }
            // Move the uploaded file
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

    // Finalize and prepare the SQL statement for updating student details
    $sql = "UPDATE student SET " . implode(", ", $sqlSetParts) . " WHERE studentid = ?";
    $stmt = $conn->prepare($sql);
    $types = str_repeat('s', count($fieldsToUpdate)) . 's';
    $params = array_merge(array_values($fieldsToUpdate), [$studentId]);
    $stmt->bind_param($types, ...$params);

    // Execute the update
    if ($stmt->execute()) {
        echo "Student updated successfully.";
    } else {
        echo "Error updating record: " . $stmt->error;
    }
    
    // Close the prepared statement
    $stmt->close();
}

// Redirect back to the student list page
header("Location: students.php");
exit();

?>



