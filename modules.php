<!DOCTYPE html>
<html lang="en">
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


   // check logged in
   if (isset($_SESSION['id'])) {

      echo template("templates/partials/header.php");
      echo template("templates/partials/nav.php");

      // Build SQL statement that selects a student's modules using prepared statements
$stmt = $conn->prepare("SELECT m.modulecode, m.name, m.level FROM studentmodules sm JOIN module m ON m.modulecode = sm.modulecode WHERE sm.studentid = ?");
$stmt->bind_param("s", $_SESSION['id']); // 's' specifies the variable type => 'string'

$stmt->execute();
$result = $stmt->get_result();

// prepare page content
$data['content'] .= "<table border='1'>";
$data['content'] .= "<tr><th colspan='3' align='center'>Modules</th></tr>";
$data['content'] .= "<tr><th>Code</th><th>Name</th><th>Level</th></tr>";
// Display the modules within the HTML table
while ($row = $result->fetch_assoc()) {
    $data['content'] .= "<tr><td>" . htmlspecialchars($row['modulecode']) . "</td>";
    $data['content'] .= "<td>" . htmlspecialchars($row['name']) . "</td>";
    $data['content'] .= "<td>" . htmlspecialchars($row['level']) . "</td></tr>";
}
$data['content'] .= "</table>";


      // render the template
      echo template("templates/default.php", $data);

   } else {
      header("Location: index.php");
   }

   echo template("templates/partials/footer.php");

?>
</body>
</html>

