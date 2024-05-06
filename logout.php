<?php

/*
   Logout user and redirect to login page
*/

   session_start();
   unset($_SESSION['id']);
   header("Location: index.php");

?>
