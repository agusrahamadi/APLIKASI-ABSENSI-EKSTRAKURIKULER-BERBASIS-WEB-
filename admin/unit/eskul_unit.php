<?php
session_start();
require_once '../lib/koneksi.php';

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
                <li>Extrakuliler</li>
		<li>Data Extrakuliler</li>
            </ul><!-- /.breadcrumb -->
	</div>
        <div class="page-content">
            <div class="page-header">
                <h1>Data Extrakuliler
                </h1>
            </div>
            <h1>
                    <a href="?unit=eskul_unit&act=input">
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
                                        <th style="text-align: center">No.</th>
                                        <th style="text-align: center">Nama Extrakuliler</th>
                                        <th style="text-align: center">Bidang</th>
                                        <th style="text-align: center">Nama Pelatih 1</th>
                                        <th style="text-align: center">Nama Pelatih 2</th>
                                        <th style="text-align: center">Nama Pelatih 3</th>
                                        <th style="text-align: center">Nama Pelatih 4</th>
                                        <th style="text-align: center">Aksi</th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; 
                                    
                                     $qdatagrid = 
                            "
                           SELECT t_eskul.kd_eskul, t_eskul.nm_eskul, t_eskul.bidang, t_eskul.kd_pelatih1, t_eskul.kd_pelatih2, t_eskul.kd_pelatih3, t_eskul.kd_pelatih4, 
                           t_pelatih.kd_pelatih, t_pelatih.nm_pelatih 
                           FROM t_eskul INNER JOIN 
                           t_pelatih ON t_eskul.kd_pelatih1 =t_pelatih.kd_pelatih";
                                
                                    $rdatagrid = mysqli_query($mysqli, $qdatagrid);
                                    while($ddatagrid=mysqli_fetch_assoc($rdatagrid)) {
                                        
                                        echo "
                                        <tr>
                                             <td style= text-align:center>$no</td>
                                             <td style= text-align:center>$ddatagrid[nm_eskul]</td>
                                             <td style= text-align:left  >$ddatagrid[bidang]</td>
                                             <td style= text-align:left  >$ddatagrid[nm_pelatih]</td>
                                             <td style= text-align:left  >$ddatagrid[kd_pelatih2]</td>
                                             <td style= text-align:left  >$ddatagrid[kd_pelatih3]</td>
                                             <td style= text-align:left  >$ddatagrid[kd_pelatih4]</td>
                                             <td style=text-align:center>
                                                 <a href=?unit=eskul_unit&act=update&kd_eskul=$ddatagrid[kd_eskul] class='btn btn-sm btn-warning glyphicon glyphicon-pencil' ></a> 
                                                 <a href=?unit=eskul_unit&act=delete&kd_eskul=$ddatagrid[kd_eskul] class='btn btn-sm btn-danger glyphicon glyphicon-trash' onclick='return confirm(\"Yakin Akan Menghapus Data?\")'></a>    
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
              <li>Extrakuliler</li>
							<li>Tambah Extrakuliler Baru</li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">
						<div class="page-header"><h1>Tambah Extrakuliler Baru</h1></div>
						<div class="row">
							<div class="col-xs-12">
             
                            <?php
				require_once '../lib/koneksi.php';
                $qupdate = "SELECT max(kode_kat) as maxKode FROM t_kategori";
                $rupdate = mysqli_query($mysqli, $qupdate);
                $dupdate = mysqli_fetch_assoc($rupdate);
                $kd_daftar = $dupdate['maxKode'];
                $a = substr($kd_daftar,4);
                $no_urut = $a + 1;
                $char = "KAT-";
                $newID = $char.sprintf("%03s",$no_urut);
                    ?>          
                  <form class="form-horizontal" id="tambah_kat" nama="tambah_kat" method="post" action="?unit=eskul_unit&act=inputact" enctype="multipart/form-data" >    
                         <!--  <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Kode Kategori</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="kode_kat" value="<?php echo "$newID"; ?>" readonly="readonly"  id="kode_kat" required="required" autofocus="autofocus" />
                            </div>
                       </div>-->
                      <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Nama Extrakuliler</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="nm_eskul" id="nm_eskul" required="required"  placeholder="nama Extrakuliler" />
                            </div>
                       </div>
                       
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Bidang</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="bidang" id="bidang" required="required"  placeholder="Bidang" />
                            </div>
                       </div>
                       
                       
                       
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Pelatih 1</label>
                            <div class="col-sm-9">
                                 <select name="kd_pelatih1" id="kd_pelatih1" required>
                                    <option value=""></option> 
                                    <option value="">-</option> 
                                   <?php
                                    $qcombo = 
                                    "
                                    SELECT * FROM t_pelatih
                                    ";
                                    $rcombo = mysqli_query($mysqli,$qcombo);
                                    while($dcombo = mysqli_fetch_assoc($rcombo)) {
                                        echo "
                                        <option value=$dcombo[kd_pelatih]>$dcombo[nm_pelatih]</option> 
                                        ";
                                    }
                                    ?>
                                </select>
                    
                             
                            </div>
                       </div>
                       
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Pelatih 2</label>
                            <div class="col-sm-9">
                                 <select name="kd_pelatih2" id="kd_pelatih2" required>
                                    <option value=""></option> 
                                    <option value="">-</option> 
                                   <?php
                                    $qcombo = 
                                    "
                                    SELECT * FROM t_pelatih
                                    ";
                                    $rcombo = mysqli_query($mysqli,$qcombo);
                                    while($dcombo = mysqli_fetch_assoc($rcombo)) {
                                        echo "
                                        <option value=$dcombo[nm_pelatih]>$dcombo[nm_pelatih]</option> 
                                        ";
                                    }
                                    ?>
                                </select>
                    
                            
                            </div>
                       </div>
                       
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Pelatih 3</label>
                            <div class="col-sm-9">
                                 <select name="kd_pelatih3" id="kd_pelatih3" required>
                                    <option value=""></option> 
                                    <option value="">-</option> 
                                   <?php
                                    $qcombo = 
                                    "
                                    SELECT * FROM t_pelatih
                                    ";
                                    $rcombo = mysqli_query($mysqli,$qcombo);
                                    while($dcombo = mysqli_fetch_assoc($rcombo)) {
                                        echo "
                                        <option value=$dcombo[nm_pelatih]>$dcombo[nm_pelatih]</option> 
                                        ";
                                    }
                                    ?>
                                </select>
                    
                            
                            </div>
                       </div>
                       
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Pelatih 4</label>
                            <div class="col-sm-9">
                                 <select name="kd_pelatih4" id="kd_pelatih4" required>
                                    <option value=""></option> 
                                    <option value="">-</option> 
                                   <?php
                                    $qcombo = 
                                    "
                                    SELECT * FROM t_pelatih
                                    ";
                                    $rcombo = mysqli_query($mysqli,$qcombo);
                                    while($dcombo = mysqli_fetch_assoc($rcombo)) {
                                        echo "
                                        <option value=$dcombo[nm_pelatih]>$dcombo[nm_pelatih]</option> 
                                        ";
                                    }
                                    ?>
                                    
                                </select>
                    
                            
                            </div>
                       </div>
                       
                      
                      
                     
                      <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                        <button type="submit" name="submit" class="btn btn-success">Simpan</button>
                        <button type="reset" name="reset" class="btn btn-danger">Reset</button>
                        <button type="button" name="kembali" class="btn btn-info" onclick="window.location='adminmainapp.php?unit=eskul_unit&act=datagrid'">kembali</button>
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
      
      
 <script  type="text/javascript">

 
  
 var frmvalidator = new Validator("tambah_kat");
 frmvalidator.addValidation("nama_kat","req","Silakan Masukkan Nama Pegawai");
 frmvalidator.addValidation("nama_kat","maxlen=35","Maksimal Karakter Nama 35 digit");
 frmvalidator.addValidation("nama_kat","alpha_s","Hanya Huruf Saja");
 frmvalidator.addValidation("nama_kat","simbol","Hanya Huruf Saja");
</script>    
	</body>
</html>
<?php
        break;
    
        case "inputact":
      
             $nm_eskul = $_POST['nm_eskul'];
             $bidang = $_POST['bidang'];
             $kd_pelatih1 = $_POST['kd_pelatih1'];
             $kd_pelatih2 = $_POST['kd_pelatih2'];
             $kd_pelatih3 = $_POST['kd_pelatih3'];
             $kd_pelatih4 = $_POST['kd_pelatih4'];
             $qinput = "
          INSERT INTO t_eskul
          ( nm_eskul, bidang, kd_pelatih1, kd_pelatih2, kd_pelatih3, kd_pelatih4)
          VALUES
          ( '$nm_eskul', '$bidang', '$kd_pelatih1', '$kd_pelatih2', '$kd_pelatih3', '$kd_pelatih4')
        ";

        $cek = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM t_eskul WHERE nm_eskul = '$nm_eskul'"));
        
        if ($cek > 0) {
          echo "<script> alert('Data Nama Eskul Sudah Ada');
              document.location='adminmainapp.php?unit=eskul_unit&act=input';
              </script>";
          } else {
          mysqli_query($mysqli,$qinput);
          echo "<script> alert('Data Tersimpan');
              document.location='adminmainapp.php?unit=eskul_unit&act=datagrid';
              </script>";
          exit();
         }
        break;
    
        case "update":
        $kd_eskul= $_GET['kd_eskul'];
        $qupdate = "SELECT * FROM t_eskul WHERE kd_eskul = '$kd_eskul'";
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
              <li>Extrakuliler</li>
							<li>Edit Extrakuliler </li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">
						<div class="page-header"><h1>Edit Extrakuliler </h1></div>
						<div class="row">
							<div class="col-xs-12">
                                                            
                 
                                      
               
                      <form class="form-horizontal"method="post" action="adminmainapp.php?unit=eskul_unit&act=updateact" enctype="multipart/form-data" >    
                      
                       
                       
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Nama Extrakuliler</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="nm_eskul" id="nm_eskul" required="required" value="<?php echo $dupdate['nm_eskul'] ?>" placeholder="nama Extrakuliler" />
                                <input class="col-xs-10 col-sm-5" type="hidden" name="kd_eskul" id="kd_eskul" required="required" value="<?php echo $dupdate['kd_eskul'] ?>"  placeholder="nama Extrakuliler" />
                            </div>
                       </div>
                       
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Bidang</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="bidang" id="bidang" required="required" value="<?php echo $dupdate['bidang'] ?>"  placeholder="Bidang" />
                            </div>
                       </div>
                       
                       
                       
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Pelatih 1</label>
                            <div class="col-sm-9">
                                 <select name="kd_pelatih1" id="kd_pelatih1" required>
                                    <option value=""></option> 
                                    <option value="">-</option> 
                                    
                                       <?php
                                        $qcombo = 
                                        "
                                        SELECT * FROM t_pelatih
                                        ";
                                        $rcombo = mysqli_query($mysqli,$qcombo);
                                        while($dcombo = mysqli_fetch_assoc($rcombo)) {
                                            if($dcombo['kd_pelatih'] == $dupdate['kd_pelatih1']) {
                                                echo "
                                                <option value=$dcombo[kd_pelatih] selected=selected>$dcombo[nm_pelatih]</option> 
                                                ";                                
                                            }
                                            else {
                                                echo "
                                                <option value=$dcombo[kd_pelatih]>$dcombo[nm_pelatih]</option> 
                                                ";                                
                                            }
                
                                        }
                                        ?>
                                   
                                </select>
                    
                             
                            </div>
                       </div>
                       
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Pelatih 2</label>
                            <div class="col-sm-9">
                                 <select name="kd_pelatih2" id="kd_pelatih2" required>
                                    <option value=""></option> 
                                    <option value="">-</option> 
                                    <?php
                                        $qcombo = 
                                        "
                                        SELECT * FROM t_eskul
                                        ";
                                        $rcombo = mysqli_query($mysqli,$qcombo);
                                        while($dcombo = mysqli_fetch_assoc($rcombo)) {
                                            if($dcombo['kd_pelatih2'] == $dupdate['kd_pelatih2']) {
                                                echo "
                                                <option value=$dcombo[kd_pelatih2] selected=selected>$dcombo[kd_pelatih2]</option> 
                                                ";                                
                                            }
                                            else {
                                                echo "
                                                <option value=$dcombo[kd_pelatih2]>$dcombo[kd_pelatih2]</option> 
                                                ";                                
                                            }
                
                                        }
                                        ?>
                                </select>
                    
                            
                            </div>
                       </div>
                       
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Pelatih 3</label>
                            <div class="col-sm-9">
                                 <select name="kd_pelatih3" id="kd_pelatih3" required>
                                    <option value=""></option> 
                                    <option value="">-</option> 
                                   <?php
                                        $qcombo = 
                                        "
                                        SELECT * FROM t_eskul
                                        ";
                                        $rcombo = mysqli_query($mysqli,$qcombo);
                                        while($dcombo = mysqli_fetch_assoc($rcombo)) {
                                            if($dcombo['kd_pelatih3'] == $dupdate['kd_pelatih3']) {
                                                echo "
                                                <option value=$dcombo[kd_pelatih3] selected=selected>$dcombo[kd_pelatih3]</option> 
                                                ";                                
                                            }
                                            else {
                                                echo "
                                                <option value=$dcombo[kd_pelatih3]>$dcombo[kd_pelatih3]</option> 
                                                ";                                
                                            }
                
                                        }
                                        ?>
                                </select>
                    
                            
                            </div>
                       </div>
                       
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Pelatih 4</label>
                            <div class="col-sm-9">
                                 <select name="kd_pelatih4" id="kd_pelatih4" required>
                                    <option value=""></option> 
                                    <option value="">-</option> 
                                    <?php
                                        $qcombo = 
                                        "
                                        SELECT * FROM t_eskul
                                        ";
                                        $rcombo = mysqli_query($mysqli,$qcombo);
                                        while($dcombo = mysqli_fetch_assoc($rcombo)) {
                                            if($dcombo['kd_pelatih4'] == $dupdate['kd_pelatih4']) {
                                                echo "
                                                <option value=$dcombo[kd_pelatih4] selected=selected>$dcombo[kd_pelatih4]</option> 
                                                ";                                
                                            }
                                            else {
                                                echo "
                                                <option value=$dcombo[kd_pelatih4]>$dcombo[kd_pelatih4]</option> 
                                                ";                                
                                            }
                
                                        }
                                        ?>
                                    
                                </select>
                    
                            
                            </div>
                       </div>
                       
                         <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                        <button type="submit" name="submit" class="btn btn-success">Simpan</button>
                        <button type="reset" name="reset" class="btn btn-danger">Reset</button>
                       <button type="button" name="kembali" class="btn btn-info" onclick="window.location='adminmainapp.php?unit=eskul_unit&act=datagrid'">kembali</button>
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
                        
.addValidation("nama_kat","simbol","Hanya Huruf Saja");
</script>
	</body>
</html>
 <?php
        break;
    
            case "updateact":
             $kd_eskul = $_POST['kd_eskul'];
             $nip = $_POST['nip'];
             $nm_Extrakuliler = $_POST['nm_Extrakuliler'];
             $jns_kelamin = $_POST['jns_kelamin'];
             $bidang = $_POST['bidang'];
             $periode_awal = $_POST['periode_awal'];
             $periode_akhir = $_POST['periode_akhir'];
             $alamat = $_POST['alamat'];
             $ttl = $_POST['ttl'];
        $qupdate = "
          UPDATE t_eskul SET
            nip = '$nip',
            nm_Extrakuliler = '$nm_Extrakuliler',
            jns_kelamin = '$jns_kelamin',
            bidang = '$bidang',
            periode_awal = '$periode_awal',
            periode_akhir = '$periode_akhir',
            alamat = '$alamat',
            ttl = '$ttl'
          WHERE
            kd_eskul = '$kd_eskul'
        ";
        $rupdate = mysqli_query($mysqli,$qupdate);
        header("location:?unit=eskul_unit&act=datagrid");
                 break;
    
        case "delete":
              $kd_eskul = $_GET['kd_eskul'];
        $qdelete = "
          DELETE  FROM t_eskul
       
          WHERE
            kd_eskul = '$kd_eskul'
        ";

        $rdelete = mysqli_query($mysqli,$qdelete);
        header("location:?unit=eskul_unit&act=datagrid");
        break;
}