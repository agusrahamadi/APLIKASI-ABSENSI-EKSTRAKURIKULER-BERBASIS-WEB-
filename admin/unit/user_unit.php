<?php
$act = $_GET['act'];
switch($act){
    case "datagrid":
        ?>
<?php
include("../admin/leftbar.php");
?> 
			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="adminmainapp.php?unit=dashboard">Dashboard</a>
							</li>
              <li>user</li>
							<li>Data user</li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">
						<div class="page-header"> 
              <h1>Data user
              </h1>
            </div>
                <h1>
                <a href="?unit=user_unit&act=input">
                  <button class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah Data</button>
                </a>
              </h1>
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<div class="row">
                  <div class="box box-primary">
                    <div class="box-body table-responsive padding">
                      
                      <table id="datatable" class="table table-striped table-bordered table-hover">
                        <thead>
                          <tr>
                            <th style="text-align: center">No</th>
                            <th style="text-align: center">Username</th>
                            <th style="text-align: center">Password</th>
                            <th style="text-align: center">NamaLengkap</th>
                            <th style="text-align: center">Email</th>
                            <th style="text-align: center">Is Level</th>

                            <th style="text-align: center">Masuk</th>
                            <th style="text-align: center">Keluar</th>
                            <th style="text-align: center">Status</th>
                            <th style="text-align: center">Aksi 1</th>
                            <th style="text-align: center">Aksi 2</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $no=1; 
                          $qdatagrid =" SELECT * FROM usertb ";
                            $rdatagrid = mysqli_query($mysqli, $qdatagrid);
                            while($ddatagrid=mysqli_fetch_assoc($rdatagrid)) {
                              $st="";
                            if($ddatagrid['blokir']=='N')
                            {
                                    $st= '<span class="label label-info">Aktif</span>';
                            }
                            else if ($ddatagrid['blokir']=='Y')
                            {
                                    $st= '<span class="label label-danger">Blokir</span>';
                            }
                            else if($ddatagrid['blokir']=='A')
                            {
                                    $st='<span class="label label-warning">Menunggu</span>';
                            }
                                echo "
                                <tr>
                                     <td style= text-align:center >$no</td>
                                     <td style= text-align:left  >$ddatagrid[username]</td>
                                        <td style= text-align:center>$ddatagrid[password]</td>
                                        <td style= text-align:center>$ddatagrid[namalengkap]</td>
                                        <td style= text-align:center>$ddatagrid[email]</td>
                                      <td style= text-align:center>$ddatagrid[islevel]</td>
                                      <td style= text-align:center>$ddatagrid[jammasuk]</td>
                                      <td style= text-align:center>$ddatagrid[jamkeluar]</td>
                                       <td style= text-align:center>$st</td>
                                     <td style=text-align:center>
                                         <a href=?unit=user_unit&act=aktif&userid=$ddatagrid[userid] class=' btn-sm btn-info glyphicon glyphicon-ok' onclick='return confirm(\"Anda Aktifkan?\")'></a>
                                            <a href=?unit=user_unit&act=blokir&userid=$ddatagrid[userid] class=' btn-sm btn-danger glyphicon glyphicon-off' onclick='return confirm(\"Anda Blokir?\")'></a>
                                    </td> 
                                     <td style=text-align:center>
                                         <a href=?unit=user_unit&act=update&userid=$ddatagrid[userid] class='btn btn-sm btn-warning glyphicon glyphicon-pencil' ></a> 
                                         <a href=?unit=user_unit&act=delete&userid=$ddatagrid[userid] class='btn btn-sm btn-danger glyphicon glyphicon-trash' onclick='return confirm(\"Yakin Akan Menghapus Data?\")'></a>    
                                     </td>                
                                </tr>
                                ";
                                $no++;
                             }
                             ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
								</div><!-- /.row -->
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

					<?php
            include("../admin/footer.php");
            ?>
      <!-- DATA TABLES SCRIPT -->
      <script src="../css/backend/js/jquery.dataTables.min.js" type="text/javascript"></script>
      <script src="../css/backend/js/jquery.dataTables.bootstrap.min.js" type="text/javascript"></script>
      <script type="text/javascript">
      function confirmDialog() {
       return confirm('Apakah anda yakin?')
      }
        $('#datatable').dataTable({
          "lengthMenu": [[10, 25, 50, 100, 500, 1000, -1], [10, 25, 50, 100, 500, 1000, "Semua"]]
        });
      </script>
	</body>
</html>
        <?php
        
        break;
    
        case "input":
            ?>

<?php
include("../admin/leftbar.php");
?>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Dashboard</a>
							</li>
              <li>user</li>
							<li>Tambah user Baru</li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">
						<div class="page-header"><h1>Tambah user Baru</h1></div>
						<div class="row">
							<div class="col-xs-12">
                                                            
<form method="post" action="?unit=user_unit&act=inputact" enctype="multipart/form-data" >
                  
                  <div class="form-group">
                      <label for="username">Username</label><br>
                    <input type="text" name="username" id="nama" required />
                    <br><br>
                      
                                                            
                   <label for="password">Password</label><br>
                      <input  type="text" name="password" id="password" required />
                    <br><br>
                    
                     <label for="namalengkap">Nama Lengkap</label><br>
                      <input  type="text" name="namalengkap" id="namalengkap" required />
                    <br><br>
                    
                    <label for="email">Email</label><br>
                      <input  type="email" name="email" id="email" required />
                    <br><br>
               
                                                            
                  <label for="islevel">Level</label><br>
                    <select name="islevel" id="islevel" required>
                        <option value=""></option>
                        <option value="admin">Admin</option>
                        <option value="oprator">Oprator</option>
                    </select><br><br>
                    
                  <button type="submit" name="submit" class="btn btn-success">Simpan</button>
                  <button type="reset" name="reset" class="btn btn-danger">Reset</button>
                  <button type="button" name="kembali" class="btn btn-info" onclick="window.location='adminmainapp.php?unit=user_unit&act=datagrid'">kembali</button>
                   </div>                                                        
                 </form>

             

                   
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
                
			</div><!-- /.main-content -->
		<?php
            include("../admin/footer.php");
            ?>
            <script src="../css/backend/js/jquery.validate.min.js"></script>
	</body>
</html>
<?php
        break;
    
        case "inputact":
         $username = $_POST['username'];
        $password = md5($_POST['password']);
        $namalengkap = $_POST['namalengkap'];
        $email = $_POST['email'];
        $islevel = $_POST['islevel'];
        $qinput = "
          INSERT INTO usertb
          (
            username,
            password,
            namalengkap,
            email,
            islevel
          )
          VALUES
          (
            '$username',
            '$password',
            '$namalengkap',
            '$email',
            '$islevel'
          )
        ";
        
         $cek = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM usertb WHERE username = '$username'"));
        
        if (!preg_match('/^\S+@[\w\d.-]{2,}\.[\w]{2,6}$/iU',$_POST['email'])) {
          echo "<script> alert('Perbaiki Email Anda');
              document.location='adminmainapp.php?unit=user_unit&act=input';
              </script>";
          } else {
          mysqli_query($mysqli,$qinput);
          echo "<script> alert('Data Tersimpan');
              document.location='adminmainapp.php?unit=user_unit&act=datagrid';
              </script>";
          exit();
         }
        break;    
    
        case "update":
            $userid = $_GET['userid'];
        $qupdate = "SELECT * FROM  usertb WHERE userid = '$userid'";
        $rupdate = mysqli_query($mysqli, $qupdate);
        $dupdate = mysqli_fetch_assoc($rupdate);
            ?>
<?php
include("../admin/leftbar.php");
?>


			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Dashboard</a>
							</li>
              <li>Pengaturan Admin</li>
							<li>Edit Pengaturan Admin</li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">
						<div class="page-header"><h1>Edit Pengaturan Admin</h1></div>
						<div class="row">
							<div class="col-xs-12">
                                                            
<form method="post" action="?unit=user_unit&act=updateact" class="form-horizontal" enctype="multipart/form-data" >
                  
					   <div class="form-group">
                      <label class="col-sm-3 control-label no-padding-right"for="username">Username</label>
                     <div class="col-sm-9">
                       <input class="col-xs-10 col-sm-5"type="text" name="username" id="username" value="<?php echo  $dupdate['username'] ?>" required />
                       <input class="col-xs-10 col-sm-5"type="hidden" name="userid" id="userid" value="<?php echo  $dupdate['userid'] ?>" required />
                       </div>
                       </div>
					   
					     <div class="form-group">
                      <label class="col-sm-3 control-label no-padding-right"for="namalengkap">Nama Lengkap</label>
                     <div class="col-sm-9">
                       <input class="col-xs-10 col-sm-5"type="text" name="namalengkap" id="namalengkap" value="<?php echo  $dupdate['namalengkap'] ?>" required />
                       </div>
                       </div>
					   
              <div class="form-group">
                      <label class="col-sm-3 control-label no-padding-right"for="username">Password</label>
                     <div class="col-sm-9">
                       <input class="col-xs-10 col-sm-5"type="text" name="password" id="password" value="<?php echo $dupdate['password'] ?>" required />
                       </div>
                       </div>
                    
                                                            
                     <div class="form-group">
                      <label class="col-sm-3 control-label no-padding-right"for="email">Email</label>
                     <div class="col-sm-9">
                       <input class="col-xs-10 col-sm-5"type="text" name="email" id="email" value="<?php echo  $dupdate['email'] ?>" required />
                       </div>
                       </div>
                                     <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">  
                  <button type="submit" name="submit" class="btn btn-success">Simpan</button>
                  <button type="reset" name="reset" class="btn btn-danger">Reset</button>
                  <button type="button" name="kembali" class="btn btn-info" onclick="window.location='adminmainapp.php?unit=dashboard'">kembali</button>
                   </div>                                                        
                   </div>                                                        
                 </form>
             

                   
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
                
			</div><!-- /.main-content -->
		<?php
            include("../admin/footer.php");
            ?>
	</body>
</html>
    
       <?php
        break;
    
            case "updateact":
         $userid = $_POST['userid'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        //echo $password . '<br />';
        $namalengkap = $_POST['namalengkap'];
        $email = $_POST['email'];
        
        $qupdate = "";
        if($password == "") {
            $qupdate = "
              UPDATE usertb SET
                username = '$username',
                namalengkap = '$namalengkap', 
                email = '$email'    
              WHERE
                userid = '$userid'
            ";            
        }
        else {
            $password = md5($password);
            $qupdate = "
              UPDATE usertb SET
                username = '$username',
                password = '$password',    
                namalengkap = '$namalengkap', 
                email = '$email'     
              WHERE
                userid = '$userid'
            ";                        
        }

        $rupdate = mysqli_query($mysqli,$qupdate);
        //echo $qupdate . '<br />';
        header("location:?unit=user_unit&act=update&userid=1");      
        break;  
    
        case "delete":
        $userid = $_GET['userid'];
        $qdelete = "
          DELETE  FROM usertb 
       
          WHERE
            userid = '$userid'
        ";
        $rdelete = mysqli_query($mysqli,$qdelete);
        header("location:?unit=user_unit&act=datagrid");
            break;

case "aktif":
      $userid = $_GET['userid'];
                $blokir = $_POST['blokir'];
        $qupdate = "
          UPDATE usertb SET
            blokir = 'N',
            batas_login = '0' 
     
          WHERE
            userid = '$userid' 
        ";
        $rupdate = mysqli_query($mysqli,$qupdate);
        header("location:?unit=user_unit&act=datagrid");


        break;
    case "blokir":
      $userid = $_GET['userid'];
                $blokir = $_POST['blokir'];
        $qupdate = "
          UPDATE usertb SET
            blokir = 'Y' 
     
          WHERE
            userid = '$userid' 
        ";
        $rupdate = mysqli_query($mysqli,$qupdate);
        header("location:?unit=user_unit&act=datagrid");


        break;
}