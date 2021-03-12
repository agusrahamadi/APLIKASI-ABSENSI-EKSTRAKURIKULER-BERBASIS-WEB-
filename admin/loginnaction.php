<?php
session_start();
require_once '../lib/koneksi.php';
$username = $_POST['username'];
$password = md5($_POST['password']);



$qlogin =
"
   SELECT
    *
   FROM
    usertb
   WHERE
    username = '$username'
    AND
    password = '$password'
";
$rlogin = mysqli_query($mysqli, $qlogin);
$jumlahbaris = mysqli_num_rows($rlogin);
if ($jumlahbaris > 0 ){
    $dlogin = mysqli_fetch_assoc($rlogin);
    $_SESSION['userid'] = $dlogin ['userid'];
    $_SESSION['username'] = $dlogin ['username'];
    $_SESSION['islevel'] = $dlogin ['islevel'];
        date_default_timezone_set("Asia/Brunei");
        $tanggalsekarang = date("Y-m-d H:i:s");
        $zupdate = 
                "
                UPDATE usertb SET
                jammasuk ='$tanggalsekarang'
                WHERE
                userid = '".$_SESSION['userid']."'
                ";  
      $rupdate = mysqli_query($mysqli,$zupdate);
    header('location:adminmainapp.php?unit=dashboard');
}
 else {
      $qdatagrid =" UPDATE usertb SET batas_login = batas_login + 1 where username='$username' ";
                            $rdatagrid = mysqli_query($mysqli, $qdatagrid);
                                
          
            $c =" SELECT batas_login from usertb where username = '$username' ";
                            $r = mysqli_query($mysqli, $c);
                            $a = mysqli_fetch_assoc($r);



        $b = $a['batas_login'];


        if ($b > 5) {

        $mdatagrid =" UPDATE usertb SET blokir = 'Y' where username='$username' ";
                            $zdatagrid = mysqli_query($mysqli, $mdatagrid);

            echo "<script type=text/javascript>


              alert('Username $username Telah Di Blokir, Silahkan kirim Pesan Email ke admin@gmail.com untuk proses lebih lanjut');


              window.location = './'


              </script>";

        } else {


            echo "<script type=text/javascript>


              alert('Username Atau Password Tidak Benar, Anda Sudah $b Kali Mencoba');


              window.location.href='./'


              </script>";


        }
    
}




?>