<?php
session_start();
if (!isset($_SESSION['username']))
{
   header("location:dashboard.php");
}
require_once '../lib/koneksi.php';
        $qupdate = "SELECT * FROM  usertb WHERE username = '".$_SESSION['username']."'";
        $rupdate = mysqli_query($mysqli, $qupdate);
        $dupdate = mysqli_fetch_assoc($rupdate);
 		date_default_timezone_set("Asia/Brunei");
        $tanggalsekarang = date("Y-m-d H:i:s");
        $zupdate = 
                "
                UPDATE usertb SET
                jamkeluar ='$tanggalsekarang'
                WHERE
                username = '".$_SESSION['username']."'
                ";  
      $rupdate = mysqli_query($mysqli,$zupdate);
session_destroy();
header("location:login.php");
