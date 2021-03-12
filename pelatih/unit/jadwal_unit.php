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
                <li>Jadwal</li>
		<li>Data Jadwal</li>
            </ul><!-- /.breadcrumb -->
	</div>
        <div class="page-content">
            <div class="page-header">
                <h1>Data Jadwal
                </h1>
            </div>
            <h1>
                    <a href="?unit=jadwal_unit&act=input">
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
                                        <th style="text-align: center">Tanggal</th>
                                        <th style="text-align: center">Jam</th>
                                        <th style="text-align: center">Nama Extrakuliler</th>
                                        <th style="text-align: center">pelatih 1</th>
                                        <th style="text-align: center">pelatih 2</th>
                                        <th style="text-align: center">pelatih 3</th>
                                        <th style="text-align: center">pelatih 4</th>
                                        <th style="text-align: center">Aksi</th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; 
                                    $qdatagrid =" SELECT 
                            t_jadwal.kd_jadwal, t_jadwal.tgl,t_jadwal.jam,t_jadwal.kd_eskul,
                            t_eskul.kd_eskul, t_eskul.kd_pelatih1, t_eskul.kd_pelatih2, t_eskul.kd_pelatih3, t_eskul.kd_pelatih4,  t_eskul.nm_eskul,
                            t_pelatih.kd_pelatih,t_pelatih.nm_pelatih
                            FROM 
                                t_jadwal
                                    JOIN t_eskul ON t_jadwal.kd_eskul = t_eskul.kd_eskul
                                 JOIN t_pelatih ON t_eskul.kd_pelatih1 = t_pelatih.kd_pelatih
                                 ";
                                    $rdatagrid = mysqli_query($mysqli, $qdatagrid);
                                    while($ddatagrid=mysqli_fetch_assoc($rdatagrid)) {
                                        echo "
                                        <tr>
                                             <td style= text-align:center>$no</td>
                                             <td style= text-align:center>$ddatagrid[tgl]</td>
                                             <td style= text-align:left  >$ddatagrid[jam]</td>
                                             <td style= text-align:center>$ddatagrid[nm_eskul]</td>
                                             <td style= text-align:left  >$ddatagrid[nm_pelatih]</td>
                                             <td style= text-align:left  >$ddatagrid[kd_pelatih2]</td>
                                             <td style= text-align:left  >$ddatagrid[kd_pelatih3]</td>
                                             <td style= text-align:left  >$ddatagrid[kd_pelatih4]</td>
                                             <td style=text-align:center>
                                                 <a href=?unit=jadwal_unit&act=update&kd_jadwal=$ddatagrid[kd_jadwal] class='btn btn-sm btn-warning glyphicon glyphicon-pencil' ></a> 
                                                 <a href=?unit=jadwal_unit&act=delete&kd_jadwal=$ddatagrid[kd_jadwal] class='btn btn-sm btn-danger glyphicon glyphicon-trash' onclick='return confirm(\"Yakin Akan Menghapus Data?\")'></a>    
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
              <li>Jadwal</li>
							<li>Tambah Jadwal Baru</li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">
						<div class="page-header"><h1>Tambah Jadwal Baru</h1></div>
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
                  <form class="form-horizontal" id="tambah_kat" nama="tambah_kat" method="post" action="?unit=jadwal_unit&act=inputact" enctype="multipart/form-data" >    
                         <!--  <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Kode Kategori</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="kode_kat" value="<?php echo "$newID"; ?>" readonly="readonly"  id="kode_kat" required="required" autofocus="autofocus" />
                            </div>
                       </div>-->
                       
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Tanggal</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="date" name="tgl" id="tgl" required="required" autofocus="autofocus"  placeholder="Tanggal" />
                            </div>
                       </div>
                       
                      <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Jam</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="time" name="jam" id="jam" required="required"  placeholder="Jam" />
                            </div>
                       </div>
                       
                      
                       
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Nama Extrakuliler</label>
                            <div class="col-sm-9">
                                 <select name="kd_eskul" id="kd_eskul" required>
                                    <option value=""></option> 
                                    <option value="">-</option> 
                                   <?php
                                    $qcombo = 
                                    "
                                    SELECT * FROM t_eskul
                                    ";
                                    $rcombo = mysqli_query($mysqli,$qcombo);
                                    while($dcombo = mysqli_fetch_assoc($rcombo)) {
                                        echo "
                                        <option value=$dcombo[kd_eskul]>$dcombo[nm_eskul]</option> 
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
                        <button type="button" name="kembali" class="btn btn-info" onclick="window.location='adminmainapp.php?unit=jadwal_unit&act=datagrid'">kembali</button>
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
      
             $tgl = $_POST['tgl'];
             $jam = $_POST['jam'];
             $kd_eskul = $_POST['kd_eskul'];
             $qinput = "
          INSERT INTO t_jadwal
          ( tgl, jam, kd_eskul)
          VALUES
          ( '$tgl', '$jam', '$kd_eskul')
        ";

        $cek = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM t_jadwal WHERE nip = '$nip'"));
        
        if ($cek > 0) {
          echo "<script> alert('Data nip Sudah Ada');
              document.location='adminmainapp.php?unit=jadwal_unit&act=input';
              </script>";
          } else {
          mysqli_query($mysqli,$qinput);
          echo "<script> alert('Data Tersimpan');
              document.location='adminmainapp.php?unit=jadwal_unit&act=datagrid';
              </script>";
          exit();
         }
        break;
    
        case "update":
        $kd_jadwal= $_GET['kd_jadwal'];
        $qupdate = "SSELECT 
                            t_jadwal.kd_jadwal, t_jadwal.tgl,t_jadwal.jam,t_jadwal.kd_eskul,
                            t_eskul.kd_eskul, t_eskul.kd_pelatih1, t_eskul.kd_pelatih2, t_eskul.kd_pelatih3, t_eskul.kd_pelatih4,  t_eskul.nm_eskul,
                            t_pelatih.kd_pelatih,t_pelatih.nm_pelatih
                            FROM 
                                t_jadwal
                                    JOIN t_eskul ON t_jadwal.kd_eskul = t_eskul.kd_eskul
                                 JOIN t_pelatih ON t_eskul.kd_pelatih1 = t_pelatih.kd_pelatih
                                 WHERE t_jadwal.kd_jadwal = '$kd_jadwal'";
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
              <li>Jadwal</li>
							<li>Edit Jadwal </li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">
						<div class="page-header"><h1>Edit Jadwal </h1></div>
						<div class="row">
							<div class="col-xs-12">
                                                            
                 
                                      
               
                      <form class="form-horizontal"method="post" action="adminmainapp.php?unit=jadwal_unit&act=updateact" enctype="multipart/form-data" >    
                      
                       
                       
                      <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Tanggal</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="date" name="tgl" id="tgl" required="required" value="<?php echo $dupdate['tgl'] ?>"autofocus="autofocus"  placeholder="Tanggal" />
                            <input class="col-xs-10 col-sm-5" type="hidden" name="kd_jadwal" id="kd_jadwal" required="required" value="<?php echo $dupdate['kd_jadwal'] ?>"autofocus="autofocus"  placeholder="Tanggal" />
                            </div>
                       </div>
                       
                      <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Jam</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="time" name="jam" id="tgl" value="<?php echo $dupdate['tgl'] ?>" required="required"  placeholder="Jam" />
                            </div>
                       </div>
                       
                      
                       
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Nama Extrakuliler</label>
                            <div class="col-sm-9">
                                 <select name="kd_eskul" id="kd_eskul" required>
                                    <option value=""></option> 
                                    <option value="">-</option> 
                                   <?php
                                        $qcombo = 
                                        "
                                        SELECT * FROM t_eskul
                                        ";
                                        $rcombo = mysqli_query($mysqli,$qcombo);
                                        while($dcombo = mysqli_fetch_assoc($rcombo)) {
                                            if($dcombo['kd_eskul'] == $dupdate['kd_eskul']) {
                                                echo "
                                                <option value=$dcombo[kd_eskul] selected=selected>$dcombo[nm_eskul]</option> 
                                                ";                                
                                            }
                                            else {
                                                echo "
                                                <option value=$dcombo[kd_eskul]>$dcombo[nm_eskul]</option> 
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
                       <button type="button" name="kembali" class="btn btn-info" onclick="window.location='adminmainapp.php?unit=jadwal_unit&act=datagrid'">kembali</button>
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
             $kd_jadwal = $_POST['kd_jadwal'];
             $tgl = $_POST['tgl'];
             $jam = $_POST['jam'];
             $kd_eskul= $_POST['kd_eskul'];
        $qupdate = "
          UPDATE t_jadwal SET
            tgl = '$tgl',
            jam = '$jam',
            kd_eskul = '$kd_eskul'
          WHERE
            kd_jadwal = '$kd_jadwal'
        ";
        $rupdate = mysqli_query($mysqli,$qupdate);
        header("location:?unit=jadwal_unit&act=datagrid");
                 break;
    
        case "delete":
              $kd_jadwal = $_GET['kd_jadwal'];
        $qdelete = "
          DELETE  FROM t_jadwal
       
          WHERE
            kd_jadwal = '$kd_jadwal'
        ";

        $rdelete = mysqli_query($mysqli,$qdelete);
        header("location:?unit=jadwal_unit&act=datagrid");
        break;
}