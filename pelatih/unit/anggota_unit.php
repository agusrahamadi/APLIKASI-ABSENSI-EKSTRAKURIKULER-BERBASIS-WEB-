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
                <li>Anggota</li>
		<li>Data Anggota</li>
            </ul><!-- /.breadcrumb -->
	</div>
        <div class="page-content">
            <div class="page-header">
                <h1>Data Anggota
                </h1>
            </div>
            <h1>
                    <a href="?unit=anggota_unit&act=input">
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
                                        <th style="text-align: center">Nama Pelatih1</th>
                                        <th style="text-align: center">Nama Pelatih2</th>
                                        <th style="text-align: center">Nama Pelatih3</th>
                                        <th style="text-align: center">Nama Pelatih4</th>
                                        <th style="text-align: center">Nis</th>
                                        <th style="text-align: center">Nama Siswa</th>
                                        <th style="text-align: center">TTL</th>
                                        <th style="text-align: center">Jenip Kelamin</th>
                                        <th style="text-align: center">Alamat</th>
                                        <th style="text-align: center">Kelas</th>
                                        <th style="text-align: center">Angkatan</th>
                                        <th style="text-align: center">Status</th>
                                        <th style="text-align: center">Aksi</th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; 
                                    $qdatagrid =" SELECT 
                            t_anggota.kd_anggota, t_anggota.kd_siswa,t_anggota.kd_eskul,
                            t_eskul.kd_eskul, t_eskul.kd_pelatih1, t_eskul.kd_pelatih2, t_eskul.kd_pelatih3, t_eskul.kd_pelatih4,  t_eskul.nm_eskul, 
                            t_siswa.kd_siswa, t_siswa.nis, t_siswa.nm_siswa, t_siswa.ttl, t_siswa.jns_kelamin, t_siswa.alamat, t_siswa.kelas,
                            t_siswa.angkatan, t_siswa.status,
                            t_pelatih.kd_pelatih,t_pelatih.nm_pelatih
                            FROM 
                                t_anggota
                                    JOIN t_eskul ON t_anggota.kd_eskul = t_eskul.kd_eskul
                                    JOIN t_siswa ON t_anggota.kd_siswa = t_siswa.kd_siswa
                                 JOIN t_pelatih ON t_eskul.kd_pelatih1 = t_pelatih.kd_pelatih
                                
                                    ";
                                    $rdatagrid = mysqli_query($mysqli, $qdatagrid);
                                    while($ddatagrid=mysqli_fetch_assoc($rdatagrid)) {
                                        echo "
                                        <tr>
                                             <td style= text-align:center>$no</td>
                                             <td style= text-align:center>$ddatagrid[nm_eskul]</td>
                                             <td style= text-align:left  >$ddatagrid[nm_pelatih]</td>
                                             <td style= text-align:left  >$ddatagrid[kd_pelatih2]</td>
                                             <td style= text-align:left  >$ddatagrid[kd_pelatih3]</td>
                                             <td style= text-align:left  >$ddatagrid[kd_pelatih4]</td>
                                             <td style= text-align:center>$ddatagrid[nis]</td>
                                             <td style= text-align:left  >$ddatagrid[nm_siswa]</td>
                                             <td style= text-align:left  >$ddatagrid[ttl]</td>
                                             <td style= text-align:left  >$ddatagrid[jns_kelamin]</td>
                                             <td style= text-align:left  >$ddatagrid[alamat]</td>
                                             <td style= text-align:left  >$ddatagrid[kelas]</td>
                                             <td style= text-align:left  >$ddatagrid[angkatan]</td>
                                             <td style= text-align:left  >$ddatagrid[status]</td>
                                             <td style=text-align:center>
                                                 <a href=?unit=anggota_unit&act=update&kd_anggota=$ddatagrid[kd_anggota] class='btn btn-sm btn-warning glyphicon glyphicon-pencil' ></a> 
                                                 <a href=?unit=anggota_unit&act=delete&kd_anggota=$ddatagrid[kd_anggota] class='btn btn-sm btn-danger glyphicon glyphicon-trash' onclick='return confirm(\"Yakin Akan Menghapus Data?\")'></a>    
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
              <li>Anggota</li>
							<li>Tambah Anggota Baru</li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">
						<div class="page-header"><h1>Tambah Anggota Baru</h1></div>
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
                  <form class="form-horizontal" id="tambah_kat" nama="tambah_kat" method="post" action="?unit=anggota_unit&act=inputact" enctype="multipart/form-data" >    
                         <!--  <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Kode Kategori</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="kode_kat" value="<?php echo "$newID"; ?>" readonly="readonly"  id="kode_kat" required="required" autofocus="autofocus" />
                            </div>
                       </div>-->
                       
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Pilih Extrakuliler</label>
                            <div class="col-sm-9"> 
                            <input class="col-xs-10 col-sm-5" type="button" value="Pilih Extrakuliler"  style="width: 300px; margin-left: 0px; margin-top: 0px; height: 32px; padding-top: 0px;" onclick="window.open('unit/w_eskul.php', 'winpopup', 'toolbar=no,statusbar=no,menubar=no,left=500,top=70,resizable=no,scrollbars=yes,width=410,height=610');" />
                         <input class="col-xs-10 col-sm-5" type="hidden" name="kd_eskul" id="kd_eskul" required="required"  placeholder="nama Siswa" />
                            </div>
                       </div>
                      
                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Nama Extrakuliler</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="nm_eskul" id="nm_eskul" required="required"  placeholder="nama Eskul" />
                            </div>
                       </div>
                       
                      <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Pilih Siswa</label>
                            <div class="col-sm-9"> 
                            <input class="col-xs-10 col-sm-5" type="button" value="Pilih Siswa"  style="width: 300px; margin-left: 0px; margin-top: 0px; height: 32px; padding-top: 0px;" onclick="window.open('unit/w_siswa.php', 'winpopup', 'toolbar=no,statusbar=no,menubar=no,left=500,top=70,resizable=no,scrollbars=yes,width=410,height=610');" />
                
                            </div>
                       </div>
                        
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">NIS</label>
                            <div class="col-sm-9"> 
                            <input class="col-xs-10 col-sm-5" type="hidden" name="kd_siswa" id="kd_siswa" required="required"  placeholder="nama Siswa" />
                            
                                <input class="col-xs-10 col-sm-5" type="text" name="nis" id="nis" required="required"  placeholder="nama Siswa" />
                            </div>
                       </div>
                       
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Nama Siswa</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="nm_siswa" id="nm_siswa" required="required"  placeholder="nama Siswa" />
                            </div>
                       </div>
                       
                       
                       
                            
                       
                      <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                        <button type="submit" name="submit" class="btn btn-success">Simpan</button>
                        <button type="reset" name="reset" class="btn btn-danger">Reset</button>
                        <button type="button" name="kembali" class="btn btn-info" onclick="window.location='adminmainapp.php?unit=anggota_unit&act=datagrid'">kembali</button>
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
      
             $kd_siswa = $_POST['kd_siswa'];
             $kd_eskul = $_POST['kd_eskul'];
             $qinput = "
          INSERT INTO t_anggota
          ( kd_siswa, kd_eskul)
          VALUES
          ( '$kd_siswa', '$kd_eskul')
        ";

        $cek = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM t_anggota WHERE kd_siswa = '$kd_siswa' AND kd_eskul = '$kd_eskul'"));
        
        if ($cek > 0) {
          echo "<script> alert('Data Sudah Ada');
              document.location='adminmainapp.php?unit=anggota_unit&act=input';
              </script>";
          } else {
          mysqli_query($mysqli,$qinput);
          echo "<script> alert('Data Tersimpan');
              document.location='adminmainapp.php?unit=anggota_unit&act=datagrid';
              </script>";
          exit();
         }
        break;
    
        case "update":
        $kd_anggota= $_GET['kd_anggota'];
        $qupdate = "SELECT 
                            t_anggota.kd_anggota, t_anggota.kd_siswa,t_anggota.kd_eskul,
                            t_eskul.kd_eskul, t_eskul.kd_pelatih1, t_eskul.kd_pelatih2, t_eskul.kd_pelatih3, t_eskul.kd_pelatih4,  t_eskul.nm_eskul, 
                            t_siswa.kd_siswa, t_siswa.nis, t_siswa.nm_siswa, t_siswa.ttl, t_siswa.jns_kelamin, t_siswa.alamat, t_siswa.kelas,
                            t_siswa.angkatan, t_siswa.status,
                            t_pelatih.kd_pelatih,t_pelatih.nm_pelatih
                            FROM 
                                t_anggota
                                    JOIN t_eskul ON t_anggota.kd_eskul = t_eskul.kd_eskul
                                    JOIN t_siswa ON t_anggota.kd_siswa = t_siswa.kd_siswa
                                 JOIN t_pelatih ON t_eskul.kd_pelatih1 = t_pelatih.kd_pelatih
                                 WHERE t_anggota.kd_anggota = '$kd_anggota'";
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
              <li>Anggota</li>
							<li>Edit Anggota </li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">
						<div class="page-header"><h1>Edit Anggota </h1></div>
						<div class="row">
							<div class="col-xs-12">
                                                            
                 
                                      
               
                      <form class="form-horizontal"method="post" action="adminmainapp.php?unit=anggota_unit&act=updateact" enctype="multipart/form-data" >    
                      
                       
                       
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Pilih Extrakuliler</label>
                            <div class="col-sm-9"> 
                            <input class="col-xs-10 col-sm-5" type="button" value="Pilih Extrakuliler"  style="width: 300px; margin-left: 0px; margin-top: 0px; height: 32px; padding-top: 0px;" onclick="window.open('unit/w_eskul.php', 'winpopup', 'toolbar=no,statusbar=no,menubar=no,left=500,top=70,resizable=no,scrollbars=yes,width=410,height=610');" />
                         <input class="col-xs-10 col-sm-5" type="hidden" name="kd_eskul" id="kd_eskul" required="required" value="<?php echo $dupdate['kd_eskul'] ?>" placeholder="nama Siswa" />
                          <input class="col-xs-10 col-sm-5" type="hidden" name="kd_anggota" id="kd_anggota" required="required" value="<?php echo $dupdate['kd_anggota'] ?>" placeholder="nama Siswa" />
                            </div>
                       </div>
                      
                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Nama Extrakuliler</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="nm_eskul" id="nm_eskul" required="required" value="<?php echo $dupdate['nm_eskul'] ?>" placeholder="nama Eskul" />
                            </div>
                       </div>
                       
                      <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Pilih Siswa</label>
                            <div class="col-sm-9"> 
                            <input class="col-xs-10 col-sm-5" type="button" value="Pilih Siswa"  style="width: 300px; margin-left: 0px; margin-top: 0px; height: 32px; padding-top: 0px;" onclick="window.open('unit/w_siswa.php', 'winpopup', 'toolbar=no,statusbar=no,menubar=no,left=500,top=70,resizable=no,scrollbars=yes,width=410,height=610');" />
                
                            </div>
                       </div>
                        
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">NIS</label>
                            <div class="col-sm-9"> 
                            <input class="col-xs-10 col-sm-5" type="hidden" name="kd_siswa" id="kd_siswa" required="required" value="<?php echo $dupdate['kd_siswa'] ?>" placeholder="nama Siswa" />
                            
                                <input class="col-xs-10 col-sm-5" type="text" name="nis" id="nis" required="required" value="<?php echo $dupdate['nis'] ?>" placeholder="nama Siswa" />
                            </div>
                       </div>
                       
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Nama Siswa</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="nm_siswa" id="nm_siswa" required="required" value="<?php echo $dupdate['nm_siswa'] ?>" placeholder="nama Siswa" />
                            </div>
                       </div>
                       
                       
                       
                            
                       
                       
                         <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                        <button type="submit" name="submit" class="btn btn-success">Simpan</button>
                        <button type="reset" name="reset" class="btn btn-danger">Reset</button>
                       <button type="button" name="kembali" class="btn btn-info" onclick="window.location='adminmainapp.php?unit=anggota_unit&act=datagrid'">kembali</button>
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
             $kd_anggota = $_POST['kd_anggota'];
             $kd_siswa = $_POST['kd_siswa'];
             $kd_eskul = $_POST['kd_eskul'];
        $qupdate = "
          UPDATE t_anggota SET
            kd_siswa = '$kd_siswa',
            kd_eskul = '$kd_eskul'
          WHERE
            kd_anggota = '$kd_anggota'
        ";
        $rupdate = mysqli_query($mysqli,$qupdate);
        header("location:?unit=anggota_unit&act=datagrid");
                 break;
    
        case "delete":
              $kd_anggota = $_GET['kd_anggota'];
        $qdelete = "
          DELETE  FROM t_anggota
       
          WHERE
            kd_anggota = '$kd_anggota'
        ";

        $rdelete = mysqli_query($mysqli,$qdelete);
        header("location:?unit=anggota_unit&act=datagrid");
        break;
}