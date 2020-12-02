<?php
  session_start();
  include "koneksi.php";

  $username = $_POST['username'];
  $password = $_POST['password'];

    $query3 = mysqli_query($config, "SELECT * FROM user WHERE BINARY username= BINARY '$username' AND BINARY password= BINARY '$password'");
    $cek3=mysqli_num_rows($query3);

if($cek3){
      session_start();
      $_SESSION['admin'] = $username;
      header("Location: dashboard.php");
    }
    else {
      header("Location: index.php");
    }

?>