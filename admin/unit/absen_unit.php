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
                <li>Absensi</li>
		<li>Data Absensi</li>
            </ul><!-- /.breadcrumb -->
	</div>
        <div class="page-content">
            <div class="page-header">
                <h1>Data Absensi
                </h1>
            </div>
            <h1>
                    <a href="?unit=absen_unit&act=input">
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
                                        <th style="text-align: center">NIS</th>
                                        <th style="text-align: center">Nama Siswa</th>
                                        <th style="text-align: center">Kelas</th>
                                        <th style="text-align: center">Eskul</th>
                                        <th style="text-align: center">Tanggal</th>
                                        <th style="text-align: center">Kehadiran</th>
                                        <th style="text-align: center">Aksi</th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; 
                                    $qdatagrid =" SELECT 
                            t_absen.kd_absen, t_absen.tanggal, t_absen.kd_anggota,t_absen.status,
                            t_eskul.kd_eskul, t_eskul.nm_eskul,
                            t_siswa.kd_siswa, t_siswa.nis, t_siswa.nm_siswa,t_siswa.kelas,
                             t_anggota.kd_anggota, t_anggota.kd_siswa,t_anggota.kd_eskul
                        
                            FROM 
                                t_absen
                                    JOIN t_anggota ON t_absen.kd_anggota = t_anggota.kd_anggota
                                    JOIN t_eskul ON t_anggota.kd_eskul = t_eskul.kd_eskul
                                     JOIN t_siswa ON t_anggota.kd_siswa = t_siswa.kd_siswa ";
                                    $rdatagrid = mysqli_query($mysqli, $qdatagrid);
                                    while($ddatagrid=mysqli_fetch_assoc($rdatagrid)) {
                                        echo "
                                        <tr>
                                             <td style= text-align:center>$no</td>
                                             <td style= text-align:center>$ddatagrid[nis]</td>
                                             <td style= text-align:left  >$ddatagrid[nm_siswa]</td>
                                             <td style= text-align:left  >$ddatagrid[kelas]</td>
                                             <td style= text-align:left  >$ddatagrid[nm_eskul]</td>
                                             <td style= text-align:left  >$ddatagrid[tanggal]</td>
                                             <td style= text-align:left  >$ddatagrid[status]</td>
                                             <td style=text-align:center>
                                                 <a href=?unit=absen_unit&act=update&kd_absen=$ddatagrid[kd_absen] class='btn btn-sm btn-warning glyphicon glyphicon-pencil' ></a> 
                                                 <a href=?unit=absen_unit&act=delete&kd_absen=$ddatagrid[kd_absen] class='btn btn-sm btn-danger glyphicon glyphicon-trash' onclick='return confirm(\"Yakin Akan Menghapus Data?\")'></a>    
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
              <li>Absensi</li>
							<li>Tambah Absensi Baru</li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">
						<div class="page-header"><h1>Tambah Absensi Baru</h1></div>
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
                  <form class="form-horizontal" id="tambah_kat" nama="tambah_kat" method="post" action="?unit=absen_unit&act=inputact" enctype="multipart/form-data" >    
                         <!--  <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Kode Kategori</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="kode_kat" value="<?php echo "$newID"; ?>" readonly="readonly"  id="kode_kat" required="required" autofocus="autofocus" />
                            </div>
                       </div>-->
                       
                       
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Pilih Anggota</label>
                            <div class="col-sm-9"> 
                            <input class="col-xs-10 col-sm-5" type="button" value="Pilih Anggota"  style="width: 300px; margin-left: 0px; margin-top: 0px; height: 32px; padding-top: 0px;" onclick="window.open('unit/w_anggota.php', 'winpopup', 'toolbar=no,statusbar=no,menubar=no,left=500,top=70,resizable=no,scrollbars=yes,width=410,height=610');" />
                         <input class="col-xs-10 col-sm-5" type="hidden" name="kd_anggota" id="kd_anggota" required="required"  placeholder="nama Siswa" />
                            </div>
                       </div>
                      
                         <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">NIS</label>
                            <div class="col-sm-9"> 
                                <input class="col-xs-10 col-sm-5" type="text" name="nis" id="nis" required="required"  placeholder="NIS" />
                            </div>
                       </div>
                       
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Nama Siswa</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="nm_siswa" id="nm_siswa" required="required"  placeholder="nama Siswa" />
                            </div>
                       </div>
                        
                         <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">kelas</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="kelas" id="kelas" required="required"  placeholder="nama kelas" />
                            </div>
                       </div>
                       
                        
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">ESKUL</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="nm_eskul" id="nm_eskul" required="required" autofocus="autofocus"  placeholder="ESKUL" />
                            </div>
                       </div>
                       
                      <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Tanggal</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="date" name="tanggal" id="tanggal" required="required" />
                            </div>
                       </div>
                       
                      
                       
                       
                       
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Status Kehadiran</label>
                            <div class="col-sm-9">
                                <input type="radio" name="status" id="status" value="Hadir" /> Hadir
                               <input  type="radio" name="status" id="status" value="Sakit" /> Sakit
                                <input  type="radio" name="status" id="status" value="Izin" /> Izin
                            </div>
                       </div>
                     
                      <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                        <button type="submit" name="submit" class="btn btn-success">Simpan</button>
                        <button type="reset" name="reset" class="btn btn-danger">Reset</button>
                        <button type="button" name="kembali" class="btn btn-info" onclick="window.location='adminmainapp.php?unit=absen_unit&act=datagrid'">kembali</button>
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
      
             $kd_anggota = $_POST['kd_anggota'];
             $tanggal = $_POST['tanggal'];
             $status = $_POST['status'];
             $qinput = "
          INSERT INTO t_absen
          ( kd_anggota, tanggal, status)
          VALUES
          ( '$kd_anggota', '$tanggal', '$status')
        ";

        $cek = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM t_eskul WHERE nip = '$nip'"));
        
        if ($cek > 0) {
          echo "<script> alert('Data nip Sudah Ada');
              document.location='adminmainapp.php?unit=absen_unit&act=input';
              </script>";
          } else {
          mysqli_query($mysqli,$qinput);
          echo "<script> alert('Data Tersimpan');
              document.location='adminmainapp.php?unit=absen_unit&act=datagrid';
              </script>";
          exit();
         }
        break;
    
        case "update":
        $kd_absen= $_GET['kd_absen'];
        $qupdate = " SELECT 
                            t_absen.kd_absen, t_absen.tanggal, t_absen.kd_anggota,t_absen.status,
                            t_eskul.kd_eskul, t_eskul.nm_eskul,
                            t_siswa.kd_siswa, t_siswa.nis, t_siswa.nm_siswa,t_siswa.kelas,
                             t_anggota.kd_anggota, t_anggota.kd_siswa,t_anggota.kd_eskul
                        
                            FROM 
                                t_absen
                                    JOIN t_anggota ON t_absen.kd_anggota = t_anggota.kd_anggota
                                    JOIN t_eskul ON t_anggota.kd_eskul = t_eskul.kd_eskul
                                     JOIN t_siswa ON t_anggota.kd_siswa = t_siswa.kd_siswa 
                                     WHERE t_absen.kd_absen = '$kd_absen'";
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
              <li>Absensi</li>
							<li>Edit Absensi </li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">
						<div class="page-header"><h1>Edit Absensi </h1></div>
						<div class="row">
							<div class="col-xs-12">
                                                            
                 
                                      
               
                      <form class="form-horizontal"method="post" action="adminmainapp.php?unit=absen_unit&act=updateact" enctype="multipart/form-data" >    
                      
                       
                       
                      <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Pilih Anggota</label>
                            <div class="col-sm-9"> 
                            <input class="col-xs-10 col-sm-5" type="button" value="Pilih Anggota"  style="width: 300px; margin-left: 0px; margin-top: 0px; height: 32px; padding-top: 0px;" onclick="window.open('unit/w_anggota.php', 'winpopup', 'toolbar=no,statusbar=no,menubar=no,left=500,top=70,resizable=no,scrollbars=yes,width=410,height=610');" />
                         <input class="col-xs-10 col-sm-5" type="hidden" name="kd_anggota" id="kd_anggota" required="required"   value="<?php echo $dupdate['kd_anggota'] ?>"placeholder="nama Siswa" />
                         <input class="col-xs-10 col-sm-5" type="hidden" name="kd_absen" id="kd_absen" required="required"   value="<?php echo $dupdate['kd_absen'] ?>"placeholder="nama Siswa" />
                         
                            </div>
                       </div>
                      
                         <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">NIS</label>
                            <div class="col-sm-9"> 
                                <input class="col-xs-10 col-sm-5" type="text" name="nis" id="nis" required="required"  value="<?php echo $dupdate['nis'] ?>" placeholder="NIS" />
                            </div>
                       </div>
                       
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Nama Siswa</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="nm_siswa" id="nm_siswa" required="required"   value="<?php echo $dupdate['nm_siswa'] ?>" placeholder="nama Siswa" />
                            </div>
                       </div>
                        
                         <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">kelas</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="kelas" id="kelas" required="required" value="<?php echo $dupdate['kelas'] ?>"  placeholder="nama kelas" />
                            </div>
                       </div>
                       
                        
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">ESKUL</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="nm_eskul" id="nm_eskul" required="required" value="<?php echo $dupdate['nm_eskul'] ?>" autofocus="autofocus"  placeholder="ESKUL" />
                            </div>
                       </div>
                       
                      <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Tanggal</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="date" name="tanggal" id="tanggal" value="<?php echo $dupdate['tanggal'] ?>" required="required" />
                            </div>
                       </div>
                       
                      
                       
                       
                       
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Status Kehadiran</label>
                            <div class="col-sm-9">
                                <input type="radio" name="status" id="status" value="Hadir" /> Hadir
                               <input  type="radio" name="status" id="status" value="Sakit" /> Sakit
                                <input  type="radio" name="status" id="status" value="Izin" /> Izin
                            </div>
                       </div>
                       
                       
                       
                       
                       
                         <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                        <button type="submit" name="submit" class="btn btn-success">Simpan</button>
                        <button type="reset" name="reset" class="btn btn-danger">Reset</button>
                       <button type="button" name="kembali" class="btn btn-info" onclick="window.location='adminmainapp.php?unit=absen_unit&act=datagrid'">kembali</button>
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
             $kd_absen = $_POST['kd_absen'];
             $nip = $_POST['nip'];
             $nm_Absensi = $_POST['nm_Absensi'];
             $jns_kelamin = $_POST['jns_kelamin'];
             $bidang = $_POST['bidang'];
             $periode_awal = $_POST['periode_awal'];
             $periode_akhir = $_POST['periode_akhir'];
             $alamat = $_POST['alamat'];
             $ttl = $_POST['ttl'];
        $qupdate = "
          UPDATE t_eskul SET
            nip = '$nip',
            nm_Absensi = '$nm_Absensi',
            jns_kelamin = '$jns_kelamin',
            bidang = '$bidang',
            periode_awal = '$periode_awal',
            periode_akhir = '$periode_akhir',
            alamat = '$alamat',
            ttl = '$ttl'
          WHERE
            kd_absen = '$kd_absen'
        ";
        $rupdate = mysqli_query($mysqli,$qupdate);
        header("location:?unit=absen_unit&act=datagrid");
                 break;
    
        case "delete":
              $kd_absen = $_GET['kd_absen'];
        $qdelete = "
          DELETE  FROM t_eskul
       
          WHERE
            kd_absen = '$kd_absen'
        ";

        $rdelete = mysqli_query($mysqli,$qdelete);
        header("location:?unit=absen_unit&act=datagrid");
        break;
}