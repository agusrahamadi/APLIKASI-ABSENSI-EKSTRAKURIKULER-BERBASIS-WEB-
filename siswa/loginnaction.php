<?php
session_start();
require_once '../lib/koneksi.php';
$username = $_POST['nis'];
$password = md5($_POST['katasandi']);
$qlogin =
"
   SELECT
    *
   FROM
    t_siswa
   WHERE
    nis = '$username'
    AND
    katasandi = '$password'
";
$rlogin = mysqli_query($mysqli, $qlogin);
$jumlahbaris = mysqli_num_rows($rlogin);
if ($jumlahbaris > 0 ){
    $dlogin = mysqli_fetch_assoc($rlogin);
    $_SESSION['kd_siswa'] = $dlogin ['kd_siswa'];
    $_SESSION['nis'] = $dlogin ['nis'];
    $_SESSION['status'] = $dlogin ['status'];
    header('location:adminmainapp.php?unit=dashboard');
}
 else {
     header('location:login.php');
}





?>