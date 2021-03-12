<?php
session_start();
 
if (!empty($_SESSION['username'])) {
    header('location:login.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Form Login User</title>
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/font-awesome.min.css" rel="stylesheet">
		
        <link href="../css/prettyPhoto.css" rel="stylesheet">
        <link href="../css/price-range.css" rel="stylesheet">
        <link href="../css/animate.css" rel="stylesheet">
	<link href="../css/main.css" rel="stylesheet">
        <link href="../css/responsive.css" rel="stylesheet">
		
	    <script language="javascript">
              function validasi(form) {
                if (form.username.value == "" && form.password.value == "") {
                alert("Silakan Masukan Username Dan Password Anda");
                form.user.focus();
                return(false);
              }
                if (form.username.value == "") {
                alert("Silakan Masukan Username Anda");
                form.user.focus();
                return(false);
              }
                if (form.password.value == "") {
                alert("Silakan Masukan Password Anda");
                form.pass.focus();
                return(false);
              }       
                return(true);
              }
        </script> 	
    </head>
	
    <body style="">
       <section id="form"><!--form-->
    <div class="container " >
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="login-form"><!--login form-->
                    <h2 class="text-center">APLIKASI EKSTRAKURIKULER BERBASIS WEB <br> DI SMP PLUS CITRA MADINATUL ILMI  <br>(Login Admin)</h2>
					
                    <form method="post" action="loginnaction.php" onsubmit="return validasi(this)">
                        <input type="text" name="username" id="username" placeholder="Name" autofocus="autofocus" />
                        <input type="password" name="password" id="password" placeholder="Password" />
                        <button  class="col-lg-8 col-lg-offset-2" type="submit" class="btn btn-default">Masuk</button>
                    </form>
                </div><!--/login form-->
            </div>
			
        </div>
    </div>
</section><!--/form-->
    </body>


</html>
