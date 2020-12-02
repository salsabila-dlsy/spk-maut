<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
error_reporting(0);
include 'koneksi.php';
session_start();
  if (!isset($_SESSION['admin'])){
      header("Location: index.php");
  }
$get=$_GET['page'];
 
if ($get=='dashboard')
{
   include ('master/dashboard.php');
}

if ($get=='')
{
   include ('master/dashboard.php');
}

if ($get=='penduduk')
{
  include ('master/penduduk.php');
}

if ($get=='grafik')
{
  include ('master/grafik.php');
}

if ($get=='kriteria')
{
  include ('master/kriteria.php');
}

if ($get=='subkriteria')
{
  include ('master/subkriteria.php');
}

if ($get=='nilai')
{
  include ('master/nilai.php');
}

if ($get=='laporan')
{
  include ('master/laporan.php');
}

if ($get=='nilaidosen')
{
  include ('master/nilaidosen.php');
}

if ($get=='maut')
{
  include ('master/maut.php');
}

if ($get=='perhitungan')
{
  include ('master/perhitungan.php');
}

if ($get=='mahasiswa')
{
  include ('master/mahasiswa.php');
}

if ($get=='dashboard1')
{
   include ('kepegawaian/dashboard.php');
}

if ($get=='1')
{
   include ('kepegawaian/dashboard.php');
}
if ($get=='perhitungan1')
{
  include ('kepegawaian/perhitungan.php');
}

?>