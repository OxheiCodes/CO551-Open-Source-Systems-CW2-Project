<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Assign Module</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php
include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

// Check if the user is logged in
if (isset($_SESSION['id'])) {

   echo template("templates/partials/header.php");
   echo template("templates/partials/nav.php");

   // Check if a module has been selected
   if (isset($_POST['selmodule'])) {
      // Check if the module is already assigned to prevent duplicate entries
      $checkSql = "SELECT * FROM studentmodules WHERE studentid = '" . $_SESSION['id'] . "' AND modulecode = '" . $_POST['selmodule'] . "';";
      $checkResult = mysqli_query($conn, $checkSql);
      if (mysqli_num_rows($checkResult) > 0) {
          // Inform user that the module is already assigned
          $data['content'] .= "<p>You are already assigned to the module " . $_POST['selmodule'] . ".</p>";
      } else {
          // Insert the module assignment since it does not exist
          $sql = "INSERT INTO studentmodules VALUES ('" . $_SESSION['id'] . "', '" . $_POST['selmodule'] . "');";
          $result = mysqli_query($conn, $sql);
          if ($result) {
              $data['content'] .= "<p>The module " . $_POST['selmodule'] . " has been assigned to you.</p>";
          } else {
              $data['content'] .= "<p>Error assigning module: " . mysqli_error($conn) . "</p>";
          }
      }
   } else {
       // If no module has been selected, display the module selection form
       $sql = "SELECT * FROM module";
       $result = mysqli_query($conn, $sql);
       $data['content'] .= "<form name='frmassignmodule' action='' method='post'>";
       $data['content'] .= "Select a module to assign<br/>";
       $data['content'] .= "<select name='selmodule'>";
       while ($row = mysqli_fetch_array($result)) {
           $data['content'] .= "<option value='" . $row['modulecode'] . "'>" . $row['name'] . "</option>";
       }
       $data['content'] .= "</select><br/>";
       $data['content'] .= "<input type='submit' name='confirm' value='Save' />";
       $data['content'] .= "</form>";
   }

   // Render the template with content
   echo template("templates/default.php", $data);

} else {
    // Redirect to login page if not logged in
    header("Location: index.php");
}

echo template("templates/partials/footer.php");
?>
</body>
</html>
