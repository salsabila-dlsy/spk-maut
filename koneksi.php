<?php

/*
* To change this template, choose Tools | Templates
* and open the template in the editor.
*/
    $host   ="localhost";
    $user ="root";
    $password ="";
    $db ="spk_maut"; 
    
    $config =  mysqli_connect($host, $user, $password,$db);
    if(mysqli_connect_errno())
    {
    echo'Koneksi gagal:'.mysqli_connect_error();
    }
    else {
    }
    error_reporting(0);
    
?>
