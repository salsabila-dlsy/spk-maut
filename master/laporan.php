<?php 
 session_start();
 if (!isset($_SESSION['admin'])){
     header("Location: index.php");
 }
include 'theme/header.php'; ?>
<?php include 'theme/footer.php'; ?>
