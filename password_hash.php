<?php

include "_includes/functions.inc";

// call this script with the password URL parameter to generate a hash

if ($_GET["password"]) {
   $pass = $_GET["password"];
   echo password_hash($pass, PASSWORD_DEFAULT);
}

?>
