<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch and sanitize input data
    $studentid = $conn->real_escape_string($_POST['studentid']);
    $password = $conn->real_escape_string($_POST['password']);
    // Assume password will be hashed before storage
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $dob = $conn->real_escape_string($_POST['dob']);
    $firstname = $conn->real_escape_string($_POST['firstname']);
    $lastname = $conn->real_escape_string($_POST['lastname']);
    $house = $conn->real_escape_string($_POST['house']);
    $town = $conn->real_escape_string($_POST['town']);
    $county = $conn->real_escape_string($_POST['county']);
    $country = $conn->real_escape_string($_POST['country']);
    $postcode = $conn->real_escape_string($_POST['postcode']);
    $imagePath = ''; // Initialize image path

    // Handle the file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $uploadDir = 'uploads/';
        $fileName = basename($_FILES['image']['name']);
        $targetFilePath = $uploadDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        
        // Allow certain file formats
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($fileType, $allowTypes)) {
            // Upload file to server
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
                // File upload success, get the uploaded file path
                $imagePath = $targetFilePath;
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.";
        }
    }

    // Prepare SQL statement to insert data including image path
    $stmt = $conn->prepare("INSERT INTO student (studentid, password, dob, firstname, lastname, house, town, county, country, postcode, image_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssss", $studentid, $hashedPassword, $dob, $firstname, $lastname, $house, $town, $county, $country, $postcode, $imagePath);
    
    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
} else {
    echo "Invalid request method.";
}

?>

