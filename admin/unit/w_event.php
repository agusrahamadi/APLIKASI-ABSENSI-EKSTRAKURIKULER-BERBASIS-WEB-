<title>Data Pasien</title>
    <link href="css/bootstrap.css" rel="stylesheet" />
	<body style="
    background-color: #fff;
">

<div id="content2" style="overflow: scroll; margin-top: 0px;">   
<table class="table table-bordered" border='1' align='center' width='400' class="scroll" style="margin: auto; margin-left: 4px; margin-top: 0px;">
        <tr style="background-color:#dbd9de;">
				
	<th><center>NAMA EVENT</center></th>
	</tr>

<?php
require_once '../../lib/koneksi.php';           
$query = "SELECT * FROM t_event";
$exe = mysqli_query($mysqli, $query);                   
while($row = mysqli_fetch_assoc($exe)){
$c = $row['lmb_event'];
$d = $row['kd_event'];
?>
<tr id="tabel1" align="center" >			
<td><a href="#" style="text-decoration: none;"
onclick="
	window.opener.document.getElementById('lmb_event').value = '<?php echo $c;?>';
	window.opener.document.getElementById('kd_event').value = '<?php echo $d;?>';
	 window.close();"><?php echo $c;?></a></td>
</tr>
</br>
<?php
}
?>
</html>
