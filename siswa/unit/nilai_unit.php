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
                <li>Nilai</li>
		<li>Data Nilai</li>
            </ul><!-- /.breadcrumb -->
	</div>
        <div class="page-content">
            <div class="page-header">
                <h1>Data Nilai
                </h1>
            </div>
            <h1>
                    <a href="?unit=nilai_unit&act=input">
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
                                        <th style="text-align: center">Extrakuliler</th>
                                        <th style="text-align: center">Nilai</th>
                                        <th style="text-align: center">Aksi</th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; 
                                    $qdatagrid ="SELECT 
                            t_nilai.kd_nilai, t_nilai.nilai, t_nilai.kd_anggota,
                            t_eskul.kd_eskul, t_eskul.nm_eskul,
                            t_siswa.kd_siswa, t_siswa.nis, t_siswa.nm_siswa,
                             t_anggota.kd_anggota, t_anggota.kd_siswa,t_anggota.kd_eskul
                        
                            FROM 
                                t_nilai
                                    JOIN t_anggota ON t_nilai.kd_anggota = t_anggota.kd_anggota
                                    JOIN t_eskul ON t_anggota.kd_eskul = t_eskul.kd_eskul
                                     JOIN t_siswa ON t_anggota.kd_siswa = t_siswa.kd_siswa
                                 
                                 ";
                                    $rdatagrid = mysqli_query($mysqli, $qdatagrid);
                                    while($ddatagrid=mysqli_fetch_assoc($rdatagrid)) {
                                        echo "
                                        <tr>
                                             <td style= text-align:center>$no</td>
                                             <td style= text-align:center>$ddatagrid[nis]</td>
                                             <td style= text-align:left  >$ddatagrid[nm_siswa]</td>
                                             <td style= text-align:left  >$ddatagrid[nm_eskul]</td>
                                             <td style= text-align:left  >$ddatagrid[nilai]</td>
                                             <td style=text-align:center>
                                                 <a href=?unit=nilai_unit&act=update&kd_nilai=$ddatagrid[kd_nilai] class='btn btn-sm btn-warning glyphicon glyphicon-pencil' ></a> 
                                                 <a href=?unit=nilai_unit&act=delete&kd_nilai=$ddatagrid[kd_nilai] class='btn btn-sm btn-danger glyphicon glyphicon-trash' onclick='return confirm(\"Yakin Akan Menghapus Data?\")'></a>    
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
              <li>Nilai</li>
							<li>Tambah Nilai Baru</li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">
						<div class="page-header"><h1>Tambah Nilai Baru</h1></div>
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
                  <form class="form-horizontal" id="tambah_kat" nama="tambah_kat" method="post" action="?unit=nilai_unit&act=inputact" enctype="multipart/form-data" >    
                         <!--  <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Kode Kategori</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="kode_kat" value="<?php echo "$newID"; ?>" readonly="readonly"  id="kode_kat" required="required" autofocus="autofocus" />
                            </div>
                       </div>-->
                       
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">NIP</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="nip" id="nip" required="required" autofocus="autofocus"  placeholder="nip" />
                            </div>
                       </div>
                       
                      <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Nama Nilai</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="nm_Nilai" id="nm_Nilai" required="required"  placeholder="nama Nilai" />
                            </div>
                       </div>
                       
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">TTL</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="date" name="ttl" id="ttl" placeholder="yyyy-mm-dd" />
                            </div>
                       </div>
                       
                       
                       
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Jenip Kelamin</label>
                            <div class="col-sm-9">
                                <input type="radio" name="jns_kelamin" id="jns_kelamin" value="Laki-Laki" /> Laki-Laki
                               <input  type="radio" name="jns_kelamin" id="jns_kelamin" value="Perempuan" /> Perempuan
                            </div>
                       </div>
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Alamat</label>
                            <div class="col-sm-9">
                                <textarea class="col-xs-10 col-sm-5" name="alamat" id="alamat" > </textarea>
                              
                            </div>
                       </div>
                         
					  
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Eskul Dibidang</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="bidang" id="bidang" required="required"  placeholder="bidang"/>
                            </div>
                       </div>
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Priode Awal</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="periode_awal" id="periode_awal" required="required"  placeholder="periode_awal" />
                            </div>
                       </div> 
                          <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Priode Akhir</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="periode_akhir" id="periode_akhir" required="required"  placeholder="periode_awal" />
                            </div>
                       </div> 
                      
                     
                      <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                        <button type="submit" name="submit" class="btn btn-success">Simpan</button>
                        <button type="reset" name="reset" class="btn btn-danger">Reset</button>
                        <button type="button" name="kembali" class="btn btn-info" onclick="window.location='adminmainapp.php?unit=nilai_unit&act=datagrid'">kembali</button>
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
      
             $nip = $_POST['nip'];
             $nm_Nilai = $_POST['nm_Nilai'];
             $jns_kelamin = $_POST['jns_kelamin'];
             $bidang = $_POST['bidang'];
             $periode_awal = $_POST['periode_awal'];
             $periode_akhir = $_POST['periode_akhir'];
             $alamat = $_POST['alamat'];
             $ttl = $_POST['ttl'];
             $qinput = "
          INSERT INTO t_nilai
          ( nip, nm_Nilai, jns_kelamin, bidang, periode_awal, periode_akhir, alamat, ttl)
          VALUES
          ( '$nip', '$nm_Nilai', '$jns_kelamin', '$bidang', '$periode_awal', '$periode_akhir', '$alamat', '$ttl')
        ";

        $cek = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM t_nilai WHERE nip = '$nip'"));
        
        if ($cek > 0) {
          echo "<script> alert('Data nip Sudah Ada');
              document.location='adminmainapp.php?unit=nilai_unit&act=input';
              </script>";
          } else {
          mysqli_query($mysqli,$qinput);
          echo "<script> alert('Data Tersimpan');
              document.location='adminmainapp.php?unit=nilai_unit&act=datagrid';
              </script>";
          exit();
         }
        break;
    
        case "update":
        $kd_nilai= $_GET['kd_nilai'];
        $qupdate = "SELECT * FROM t_nilai WHERE kd_nilai = '$kd_nilai'";
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
              <li>Nilai</li>
							<li>Edit Nilai </li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">
						<div class="page-header"><h1>Edit Nilai </h1></div>
						<div class="row">
							<div class="col-xs-12">
                                                            
                 
                                      
               
                      <form class="form-horizontal"method="post" action="adminmainapp.php?unit=nilai_unit&act=updateact" enctype="multipart/form-data" >    
                      
                       
                       
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">nip</label>
                            <div class="col-sm-9">
                            <input class="col-xs-10 col-sm-5" type="hidden" name="kd_nilai" id="kd_nilai" required="required" autofocus="autofocus" value="<?php echo $dupdate['kd_nilai'] ?>" placeholder="nip" />
                            <input class="col-xs-10 col-sm-5" type="text" name="nip" id="nip" required="required" autofocus="autofocus" value="<?php echo $dupdate['nip'] ?>" placeholder="nip" />
                            </div>
                       </div>
                       
                      <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Nama Nilai</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="nm_Nilai" id="nm_Nilai" required="required" value="<?php echo $dupdate['nm_Nilai'] ?>"  placeholder="nama Nilai" />
                            </div>
                       </div>
                       
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">TTL</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="date" name="ttl" id="ttl" value="<?php echo $dupdate['ttl'] ?>" placeholder="yyyy-mm-dd" />
                            </div>
                       </div>
                       
                       
                       
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Jenip Kelamin</label>
                            <div class="col-sm-9">
                                <input type="radio" name="jns_kelamin" id="jns_kelamin" value="Laki-Laki" /> Laki-Laki
                               <input  type="radio" name="jns_kelamin" id="jns_kelamin" value="Perempuan" /> Perempuan
                            </div>
                       </div>
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Alamat</label>
                            <div class="col-sm-9">
                                <textarea class="col-xs-10 col-sm-5" name="alamat" id="alamat" > <?php echo $dupdate['alamat'] ?></textarea>
                              
                            </div>
                       </div>
                         
					  
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">bidang</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="bidang" id="bidang" required="required" value="<?php echo $dupdate['bidang'] ?>" placeholder="bidang"/>
                            </div>
                       </div>
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">periode_awal</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="periode_awal" id="periode_awal" required="required" value="<?php echo $dupdate['periode_awal'] ?>" placeholder="periode_awal" />
                            </div>
                       </div> 
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">periode_akhir</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="periode_akhir" id="periode_akhir" required="required" value="<?php echo $dupdate['periode_akhir'] ?>" placeholder="periode_akhir" />
                            </div>
                       </div>
                       
                       
                         <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                        <button type="submit" name="submit" class="btn btn-success">Simpan</button>
                        <button type="reset" name="reset" class="btn btn-danger">Reset</button>
                       <button type="button" name="kembali" class="btn btn-info" onclick="window.location='adminmainapp.php?unit=nilai_unit&act=datagrid'">kembali</button>
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
             $kd_nilai = $_POST['kd_nilai'];
             $nip = $_POST['nip'];
             $nm_Nilai = $_POST['nm_Nilai'];
             $jns_kelamin = $_POST['jns_kelamin'];
             $bidang = $_POST['bidang'];
             $periode_awal = $_POST['periode_awal'];
             $periode_akhir = $_POST['periode_akhir'];
             $alamat = $_POST['alamat'];
             $ttl = $_POST['ttl'];
        $qupdate = "
          UPDATE t_nilai SET
            nip = '$nip',
            nm_Nilai = '$nm_Nilai',
            jns_kelamin = '$jns_kelamin',
            bidang = '$bidang',
            periode_awal = '$periode_awal',
            periode_akhir = '$periode_akhir',
            alamat = '$alamat',
            ttl = '$ttl'
          WHERE
            kd_nilai = '$kd_nilai'
        ";
        $rupdate = mysqli_query($mysqli,$qupdate);
        header("location:?unit=nilai_unit&act=datagrid");
                 break;
    
        case "delete":
              $kd_nilai = $_GET['kd_nilai'];
        $qdelete = "
          DELETE  FROM t_nilai
       
          WHERE
            kd_nilai = '$kd_nilai'
        ";

        $rdelete = mysqli_query($mysqli,$qdelete);
        header("location:?unit=nilai_unit&act=datagrid");
        break;
}