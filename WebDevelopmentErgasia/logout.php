<?php
session_start();  // Ξεκινάμε τη συνεδρία

session_unset(); 

session_destroy(); 

header("Location: login.html");
exit();
?>
