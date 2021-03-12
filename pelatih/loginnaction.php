<?php
session_start();
require_once '../lib/koneksi.php';
$username = $_POST['nip'];
$password ='827ccb0eea8a706c4c34a16891f84e7b';
$qlogin =
"
   SELECT
    *
   FROM
    t_pelatih
   WHERE
    nip = '$username'
    AND
    katasandi = '$password'
";
$rlogin = mysqli_query($mysqli, $qlogin);
$jumlahbaris = mysqli_num_rows($rlogin);
if ($jumlahbaris > 0 ){
    $dlogin = mysqli_fetch_assoc($rlogin);
    $_SESSION['kd_pelatih'] = $dlogin ['kd_pelatih'];
    $_SESSION['nip'] = $dlogin ['nip'];
    header('location:adminmainapp.php?unit=dashboard');
}
 else {
     header('location:login.php');
}





?>