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
                <li>Siswa</li>
		<li>Data Siswa</li>
            </ul><!-- /.breadcrumb -->
	</div>
        <div class="page-content">
            <div class="page-header">
                <h1>Data Siswa
                </h1>
            </div>
            <h1>
                    <a href="?unit=kategori_unit&act=input">
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
                                        <th style="text-align: center">Nis</th>
                                        <th style="text-align: center">Nama Siswa</th>
                                        <th style="text-align: center">TTL</th>
                                        <th style="text-align: center">Jenis Kelamin</th>
                                        <th style="text-align: center">Alamat</th>
                                        <th style="text-align: center">Kelas</th>
                                        <th style="text-align: center">Angkatan</th>
                                        <th style="text-align: center">Status</th>
                                        <th style="text-align: center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; 
                                    $qdatagrid =" SELECT * FROM t_siswa ";
                                    $rdatagrid = mysqli_query($mysqli, $qdatagrid);
                                    while($ddatagrid=mysqli_fetch_assoc($rdatagrid)) {
                                        echo "
                                        <tr>
                                             <td style= text-align:center>$no</td>
                                             <td style= text-align:center>$ddatagrid[nis]</td>
                                             <td style= text-align:left  >$ddatagrid[nm_siswa]</td>
                                             <td style= text-align:left  >$ddatagrid[ttl]</td>
                                             <td style= text-align:left  >$ddatagrid[jns_kelamin]</td>
                                             <td style= text-align:left  >$ddatagrid[alamat]</td>
                                             <td style= text-align:left  >$ddatagrid[kelas]</td>
                                             <td style= text-align:left  >$ddatagrid[angkatan]</td>
                                             <td style= text-align:left  >$ddatagrid[status]</td>
                                             <td style=text-align:center>
                                                 <a href=?unit=kategori_unit&act=update&kd_siswa=$ddatagrid[kd_siswa] class='btn btn-sm btn-warning glyphicon glyphicon-pencil' ></a> 
                                                 <a href=?unit=kategori_unit&act=delete&kd_siswa=$ddatagrid[kd_siswa] class='btn btn-sm btn-danger glyphicon glyphicon-trash' onclick='return confirm(\"Yakin Akan Menghapus Data?\")'></a>    
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
              <li>Siswa</li>
							<li>Tambah Siswa Baru</li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">
						<div class="page-header"><h1>Tambah Siswa Baru</h1></div>
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
                  <form class="form-horizontal" id="tambah_kat" nama="tambah_kat" method="post" action="?unit=kategori_unit&act=inputact" enctype="multipart/form-data" >    
                         <!--  <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Kode Kategori</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="kode_kat" value="<?php echo "$newID"; ?>" readonly="readonly"  id="kode_kat" required="required" autofocus="autofocus" />
                            </div>
                       </div>-->
                       
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">NIS</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="nis" id="nis" required="required" autofocus="autofocus"  placeholder="NIS" />
                            </div>
                       </div>
                       
                      <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Nama siswa</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="nm_siswa" id="nm_siswa" required="required"  placeholder="nama siswa" />
                            </div>
                       </div>
                       
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">TTL</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="date" name="ttl" id="ttl" placeholder="yyyy-mm-dd" />
                            </div>
                       </div>
                       
                       
                       
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Jenis Kelamin</label>
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
                          <label class="col-sm-3 control-label no-padding-right">Kelas</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="kelas" id="kelas" required="required"  placeholder="Kelas"/>
                            </div>
                       </div>
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Angkatan</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="angkatan" id="angkatan" required="required"  placeholder="Angkatan" />
                            </div>
                       </div> 
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Status</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="status" id="status" required="required"  placeholder="Status" />
                            </div>
                       </div>
                      
                     
                      <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                        <button type="submit" name="submit" class="btn btn-success">Simpan</button>
                        <button type="reset" name="reset" class="btn btn-danger">Reset</button>
                        <button type="button" name="kembali" class="btn btn-info" onclick="window.location='adminmainapp.php?unit=kategori_unit&act=datagrid'">kembali</button>
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
      
             $nis = $_POST['nis'];
             $nm_siswa = $_POST['nm_siswa'];
             $jns_kelamin = $_POST['jns_kelamin'];
             $kelas = $_POST['kelas'];
             $angkatan = $_POST['angkatan'];
             $status = $_POST['status'];
             $alamat = $_POST['alamat'];
             $ttl = $_POST['ttl'];
             $qinput = "
          INSERT INTO t_siswa
          ( nis, nm_siswa, jns_kelamin, kelas, angkatan, status, alamat, ttl)
          VALUES
          ( '$nis', '$nm_siswa', '$jns_kelamin', '$kelas', '$angkatan', '$status', '$alamat', '$ttl')
        ";

        $cek = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM t_siswa WHERE nis = '$nis'"));
        
        if ($cek > 0) {
          echo "<script> alert('Data Nis Sudah Ada');
              document.location='adminmainapp.php?unit=kategori_unit&act=input';
              </script>";
          } else {
          mysqli_query($mysqli,$qinput);
          echo "<script> alert('Data Tersimpan');
              document.location='adminmainapp.php?unit=kategori_unit&act=datagrid';
              </script>";
          exit();
         }
        break;
    
        case "update":
        $kd_siswa= $_GET['kd_siswa'];
        $qupdate = "SELECT * FROM t_siswa WHERE kd_siswa = '$kd_siswa'";
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
              <li>Siswa</li>
							<li>Edit Siswa </li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">
						<div class="page-header"><h1>Edit Siswa </h1></div>
						<div class="row">
							<div class="col-xs-12">
                                                            
                 
                                      
               
                      <form class="form-horizontal"method="post" action="adminmainapp.php?unit=kategori_unit&act=updateact" enctype="multipart/form-data" >    
                      
                       
                       
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">NIS</label>
                            <div class="col-sm-9">
                            <input class="col-xs-10 col-sm-5" type="hidden" name="kd_siswa" id="kd_siswa" required="required" autofocus="autofocus" value="<?php echo $dupdate['kd_siswa'] ?>" placeholder="NIS" />
                            <input class="col-xs-10 col-sm-5" type="text" name="nis" id="nis" required="required" autofocus="autofocus" value="<?php echo $dupdate['nis'] ?>" placeholder="NIS" />
                            </div>
                       </div>
                       
                      <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Nama siswa</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="nm_siswa" id="nm_siswa" required="required" value="<?php echo $dupdate['nm_siswa'] ?>"  placeholder="nama siswa" />
                            </div>
                       </div>
                       
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">TTL</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="date" name="ttl" id="ttl" value="<?php echo $dupdate['ttl'] ?>" placeholder="yyyy-mm-dd" />
                            </div>
                       </div>
                       
                       
                       
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Jenis Kelamin</label>
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
                          <label class="col-sm-3 control-label no-padding-right">Kelas</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="kelas" id="kelas" required="required" value="<?php echo $dupdate['kelas'] ?>" placeholder="Kelas"/>
                            </div>
                       </div>
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Angkatan</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="angkatan" id="angkatan" required="required" value="<?php echo $dupdate['angkatan'] ?>" placeholder="Angkatan" />
                            </div>
                       </div> 
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Status</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="status" id="status" required="required" value="<?php echo $dupdate['status'] ?>" placeholder="Status" />
                            </div>
                       </div>
                       
                       
                         <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                        <button type="submit" name="submit" class="btn btn-success">Simpan</button>
                        <button type="reset" name="reset" class="btn btn-danger">Reset</button>
                       <button type="button" name="kembali" class="btn btn-info" onclick="window.location='adminmainapp.php?unit=kategori_unit&act=datagrid'">kembali</button>
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
             $kd_siswa = $_POST['kd_siswa'];
             $nis = $_POST['nis'];
             $nm_siswa = $_POST['nm_siswa'];
             $jns_kelamin = $_POST['jns_kelamin'];
             $kelas = $_POST['kelas'];
             $angkatan = $_POST['angkatan'];
             $status = $_POST['status'];
             $alamat = $_POST['alamat'];
             $ttl = $_POST['ttl'];
        $qupdate = "
          UPDATE t_siswa SET
            nis = '$nis',
            nm_siswa = '$nm_siswa',
            jns_kelamin = '$jns_kelamin',
            kelas = '$kelas',
            angkatan = '$angkatan',
            status = '$status',
            alamat = '$alamat',
            ttl = '$ttl'
          WHERE
            kd_siswa = '$kd_siswa'
        ";
        $rupdate = mysqli_query($mysqli,$qupdate);
        header("location:?unit=kategori_unit&act=datagrid");
                 break;
    
        case "delete":
              $kd_siswa = $_GET['kd_siswa'];
        $qdelete = "
          DELETE  FROM t_siswa
       
          WHERE
            kd_siswa = '$kd_siswa'
        ";

        $rdelete = mysqli_query($mysqli,$qdelete);
        header("location:?unit=kategori_unit&act=datagrid");
        break;
}