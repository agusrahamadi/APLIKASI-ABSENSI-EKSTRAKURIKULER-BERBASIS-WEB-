<?php
$server ='localhost';
$user   ='u8110790_db_smp_plus';
$password ='metalbest149';
$database ='u8110790_db_smp_plus';

$mysqli = mysqli_connect($server, $user, $password, $database) or (mysqli_error($mysqli));
if (mysqli_connect_errno($mysqli)){
    echo 'koneksi ke databese belum berhasil'. mysqli_errno($mysqli);
    
}
 else {
   // echo 'Koneksi Berhasil';
}
