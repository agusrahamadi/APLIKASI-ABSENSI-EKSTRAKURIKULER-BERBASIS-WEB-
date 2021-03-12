<title>Data Pasien</title>
    <link href="css/bootstrap.css" rel="stylesheet" />
	<body style="
    background-color: #fff;
">

<div id="content2" style="overflow: scroll; margin-top: 0px;">   
<table class="table table-bordered" border='1' align='center' width='400' class="scroll" style="margin: auto; margin-left: 4px; margin-top: 0px;">
        <tr style="background-color:#dbd9de;">
				
	<th><center>NIS SISWA</center></th>
	<th><center>NAMA SISWA</center></th>
	</tr>

<?php
require_once '../../lib/koneksi.php';           
$query = "SELECT * FROM t_siswa";
$exe = mysqli_query($mysqli, $query);                   
while($row = mysqli_fetch_assoc($exe)){
$b = $row['nis'];
$c = $row['nm_siswa'];
$d = $row['kd_siswa'];
?>
<tr id="tabel1" align="center" >			
<td><a href="#" style="text-decoration: none;"
onclick="window.opener.document.getElementById('nis').value = '<?php echo $b;?>';
	window.opener.document.getElementById('nm_siswa').value = '<?php echo $c;?>';
	window.opener.document.getElementById('kd_siswa').value = '<?php echo $d;?>';
	 window.close();"><?php echo $b;?></a></td>
<td align="left"><a href="#" style="text-decoration: none;"
onclick="window.opener.document.getElementById('nis').value = '<?php echo $b;?>';
	window.opener.document.getElementById('nm_siswa').value = '<?php echo $c;?>';
	window.opener.document.getElementById('kd_siswa').value = '<?php echo $d;?>';
	 window.close();"><?php echo $c;?></a></td>
</tr>
</br>
<?php
}
?>
</html>
