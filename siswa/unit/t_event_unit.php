<?php
session_start();
require_once '../lib/koneksi.php';

$act = $_GET['act'];
switch($act){
    case "datagrid":
        ?>
<?php
include("../siswa/leftbar.php");
?> 
<div class="main-content">
    <div class="main-content-inner">
	<div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="adminmainapp.php?unit=dashboard">Dashboard</a>
                </li>
                <li>Event</li>
		<li>Data Event</li>
            </ul><!-- /.breadcrumb -->
	</div>
        <div class="page-content">
            <div class="page-header">
                <h1>Data Persetujuan Event
                </h1>
            </div>
          
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
                                        <th style="text-align: center">Nama Event</th>
                                        <th style="text-align: center">Tanggal Event</th>
                                        <th style="text-align: center">Tempat Event</th>
                                        <th style="text-align: center">tingkat Event </th>
                                        <th style="text-align: center">Lomba Yang dipertandingkan</th>
                                        <th style="text-align: center">Jumlah Max Peserta</th>
                                        <th style="text-align: center">Peraturan Lomba</th>
                                        <th style="text-align: center">Hadiah</th>
                                         <th style="text-align: center">Status</th>
                                        <th style="text-align: center">Aksi </th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; 
                                    $qdatagrid =" SELECT * FROM t_event ";
                                    $rdatagrid = mysqli_query($mysqli, $qdatagrid);
                                    while($ddatagrid=mysqli_fetch_assoc($rdatagrid)) {
                                        
                                          $st="";
                            if($ddatagrid['status']=='C')
                            {
                                    $st='<span class="label label-success">Di Terima</span> '; 
                            }
                            else if ($ddatagrid['status']=='B')
                            {
                                    $st= '<span class="label label-danger">Di Tolak</span>';
                            }
                            else if($ddatagrid['status']=='A')
                            {
                                    $st='<span class="label label-warning">Menunggu</span>';
                            }
                                        echo "
                                        <tr>
                                             <td style= text-align:center>$no</td>
                                             <td style= text-align:center>$ddatagrid[nm_event]</td>
                                             <td style= text-align:left  >$ddatagrid[tgl_event]</td>
                                             <td style= text-align:left  >$ddatagrid[tmp_event]</td>
                                             <td style= text-align:left  >$ddatagrid[tkt_event]</td>
                                             <td style= text-align:left  >$ddatagrid[lmb_event]</td>
                                             <td style= text-align:left  >$ddatagrid[jml_max_lmb]</td>
                                             <td style= text-align:left  >$ddatagrid[ptr_lmb]</td>
                                             <td style= text-align:left  >$ddatagrid[hdh_event]</td>
                                             <td style= text-align:left  >$st</td>
                                            <td style=text-align:center>
                                                <a href=?unit=t_event_unit&act=lulus&kd_event=$ddatagrid[kd_event] class=' btn-sm btn-success glyphicon glyphicon-ok' onclick='return confirm(\"Diterima?\")'></a>
					<a href=?unit=t_event_unit&act=tolak&kd_event=$ddatagrid[kd_event] class=' btn-sm btn-danger glyphicon glyphicon-off' onclick='return confirm(\"Ditolak?\")'></a>
                                            <a href=?unit=t_event_unit&act=cadangan&kd_event=$ddatagrid[kd_event] class=' btn-sm btn-warning glyphicon glyphicon-refresh' onclick='return confirm(\"Menunggu?\")'></a>
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
include("../siswa/leftbar.php");
?>
			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Dashboard</a>
							</li>
              <li>Event</li>
							<li>Tambah Event Baru</li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">
						<div class="page-header"><h1>Tambah Event Baru</h1></div>
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
                  <form class="form-horizontal" id="tambah_kat" nama="tambah_kat" method="post" action="?unit=t_event_unit&act=inputact" enctype="multipart/form-data" >    
                         <!--  <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Kode Kategori</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="kode_kat" value="<?php echo "$newID"; ?>" readonly="readonly"  id="kode_kat" required="required" autofocus="autofocus" />
                            </div>
                       </div>-->
                       
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Nama Event </label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="nm_event" id="nm_event" required="required" autofocus="autofocus"  placeholder="nama Event" />
                            </div>
                       </div>
                       
                      <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Tanggal Event</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="tgl_event" id="tgl_event" required="required"  placeholder="Tanggal Event" />
                            </div>
                       </div>
                       
                         <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Tempat Event</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="tmp_event" id="tmp_event" required="required"  placeholder="Tempat Event" />
                            </div>
                       </div>
                       
                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Tinggkat</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="tkt_event" id="tkt_event" required="required"  placeholder="Tinggkat" />
                            </div>
                       </div>
                       
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Lomba yang Dipertandingkan</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="lmb_event" id="lmb_event" required="required"  placeholder="Lomba yang Dipertandingkan" />
                            </div>
                       </div>
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Jumlah Max Peserta</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="jml_max_lmb" id="jml_max_lmb" required="required"  placeholder="umlah Max Peserta" />
                            </div>
                       </div>
                       
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Peraturan Lomba</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="ptr_lmb" id="ptr_lmb" required="required"  placeholder="Peraturan Lomba" />
                            </div>
                       </div>
                      
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Hadiah Lomba</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="hdh_event" id="ptr_lhdh_eventmb" required="required"  placeholder="Hadiah Lomba" />
                            </div>
                       </div>
                      
                       
                       
                      
                      
                     
                      <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                        <button type="submit" name="submit" class="btn btn-success">Simpan</button>
                        <button type="reset" name="reset" class="btn btn-danger">Reset</button>
                        <button type="button" name="kembali" class="btn btn-info" onclick="window.location='adminmainapp.php?unit=t_event_unit&act=datagrid'">kembali</button>
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
      
            $nm_event = $_POST['nm_event'];
             $tgl_event = $_POST['tgl_event'];
             $tmp_event = $_POST['tmp_event'];
             $tkt_event = $_POST['tkt_event'];
             $lmb_event = $_POST['lmb_event'];
             $jml_max_lmb = $_POST['jml_max_lmb'];
             $ptr_lmb = $_POST['ptr_lmb'];
             $hdh_event = $_POST['hdh_event'];
             $qinput = "
          INSERT INTO t_event
          ( nm_event, tgl_event, tmp_event, tkt_event, lmb_event, jml_max_lmb, ptr_lmb, hdh_event)
          VALUES
          ( '$nm_event', '$tgl_event', '$tmp_event', '$tkt_event', '$lmb_event', '$jml_max_lmb', '$ptr_lmb', '$hdh_event')
        ";

        $cek = mysqli_num_rows(mysqli_query($mysqli,"SELECT * FROM t_event WHERE nip = '$nip'"));
        
        if ($cek > 0) {
          echo "<script> alert('Data nip Sudah Ada');
              document.location='adminmainapp.php?unit=t_event_unit&act=input';
              </script>";
          } else {
          mysqli_query($mysqli,$qinput);
          echo "<script> alert('Data Tersimpan');
              document.location='adminmainapp.php?unit=t_event_unit&act=datagrid';
              </script>";
          exit();
         }
        break;
    
        case "update":
        $kd_event= $_GET['kd_event'];
        $qupdate = "SELECT * FROM t_event WHERE kd_event = '$kd_event'";
        $rupdate = mysqli_query($mysqli, $qupdate);
        $dupdate = mysqli_fetch_assoc($rupdate);
            ?>
            
 <?php
include("../siswa/leftbar.php");
?>       

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Dashboard</a>
							</li>
              <li>Event</li>
							<li>Edit Event </li>
						</ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">
						<div class="page-header"><h1>Edit Event </h1></div>
						<div class="row">
							<div class="col-xs-12">
                                                            
                 
                                      
               
                      <form class="form-horizontal"method="post" action="adminmainapp.php?unit=t_event_unit&act=updateact" enctype="multipart/form-data" >    
                      
                       
                       
                     <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Nama Event </label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="nm_event" id="nm_event" required="required"  value="<?php echo $dupdate['nm_event'] ?>"  autofocus="autofocus"  placeholder="nama Event" />
                           <input class="col-xs-10 col-sm-5" type="hidden" name="kd_event" id="kd_event" required="required"  value="<?php echo $dupdate['kd_event'] ?>"  autofocus="autofocus"  placeholder="nama Event" />
                            </div>
                       </div>
                       
                      <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Tanggal Event</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="tgl_event" id="tgl_event" required="required" value="<?php echo $dupdate['tgl_event'] ?>"  placeholder="Tanggal Event" />
                            </div>
                       </div>
                       
                         <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Tempat Event</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="tmp_event" id="tmp_event" required="required" value="<?php echo $dupdate['tmp_event'] ?>"  placeholder="Tempat Event" />
                            </div>
                       </div>
                       
                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Tinggkat</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="tkt_event" id="tkt_event" required="required" value="<?php echo $dupdate['tkt_event'] ?>"  placeholder="Tinggkat" />
                            </div>
                       </div>
                       
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Lomba yang Dipertandingkan</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="lmb_event" id="lmb_event" required="required"value="<?php echo $dupdate['lmb_event'] ?>"   placeholder="Lomba yang Dipertandingkan" />
                            </div>
                       </div>
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Jumlah Max Peserta</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="jml_max_lmb" id="jml_max_lmb" required="required" value="<?php echo $dupdate['jml_max_lmb'] ?>"  placeholder="umlah Max Peserta" />
                            </div>
                       </div>
                       
                       <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Peraturan Lomba</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="ptr_lmb" id="ptr_lmb" required="required"  value="<?php echo $dupdate['ptr_lmb'] ?>" placeholder="Peraturan Lomba" />
                            </div>
                       </div>
                       
                         <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right">Hadiah Lomba</label>
                            <div class="col-sm-9">
                                <input class="col-xs-10 col-sm-5" type="text" name="hdh_event" id="hdh_event" required="required"  value="<?php echo $dupdate['hdh_event'] ?>" placeholder="Peraturan Lomba" />
                            </div>
                       </div>
                      
                      
                         <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                        <button type="submit" name="submit" class="btn btn-success">Simpan</button>
                        <button type="reset" name="reset" class="btn btn-danger">Reset</button>
                       <button type="button" name="kembali" class="btn btn-info" onclick="window.location='adminmainapp.php?unit=t_event_unit&act=datagrid'">kembali</button>
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
             $kd_event = $_POST['kd_event'];
             $nm_event = $_POST['nm_event'];
             $tgl_event = $_POST['tgl_event'];
             $tmp_event = $_POST['tmp_event'];
             $tkt_event = $_POST['tkt_event'];
             $lmb_event = $_POST['lmb_event'];
             $jml_max_lmb = $_POST['jml_max_lmb'];
             $ptr_lmb = $_POST['ptr_lmb'];
             $hdh_event = $_POST['hdh_event'];
        $qupdate = "
          UPDATE t_event SET
            nm_event = '$nm_event',
            tgl_event = '$tgl_event',
            tmp_event = '$tmp_event',
            tkt_event = '$tkt_event',
            lmb_event = '$lmb_event',
            jml_max_lmb = '$jml_max_lmb',
            ptr_lmb = '$ptr_lmb',
            hdh_event = '$hdh_event'
          WHERE
            kd_event = '$kd_event'
        ";
        $rupdate = mysqli_query($mysqli,$qupdate);
        header("location:?unit=t_event_unit&act=datagrid");
                 break;
    
        case "delete":
              $kd_event = $_GET['kd_event'];
        $qdelete = "
          DELETE  FROM t_event
       
          WHERE
            kd_event = '$kd_event'
        ";

        $rdelete = mysqli_query($mysqli,$qdelete);
        header("location:?unit=t_event_unit&act=datagrid");
        break;
        
                   case "lulus":
      $kd_event = $_GET['kd_event'];
                $status = $_POST['status'];
        $qupdate = "
          UPDATE t_event SET
            status = 'C' 
     
          WHERE
            kd_event = '$kd_event' 
        ";
        $rupdate = mysqli_query($mysqli,$qupdate);
        header("location:?unit=t_event_unit&act=datagrid");


        break;
    case "tolak":
      $kd_event = $_GET['kd_event'];
                $status = $_POST['status'];
        $qupdate = "
          UPDATE t_event SET
            status = 'B' 
     
          WHERE
            kd_event = '$kd_event' 
        ";
        $rupdate = mysqli_query($mysqli,$qupdate);
        header("location:?unit=t_event_unit&act=datagrid");


        break;
    case "cadangan":
      $kd_event = $_GET['kd_event'];
                $status = $_POST['status'];
        $qupdate = "
          UPDATE t_event SET
            status = 'A' 
     
          WHERE
            kd_event = '$kd_event' 
        ";
        $rupdate = mysqli_query($mysqli,$qupdate);
        header("location:?unit=t_event_unit&act=datagrid");


        break;  
        

}