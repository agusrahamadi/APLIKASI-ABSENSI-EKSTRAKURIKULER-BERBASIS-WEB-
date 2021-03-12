<title>NAMA ANGGOTA</title>
    <link href="css/bootstrap.css" rel="stylesheet" />
	<body style="
    background-color: #fff;
">

<div id="content2" style="overflow: scroll; margin-top: 0px;">   
<table class="table table-bordered" border='1' align='center' width='400' class="scroll" style="margin: auto; margin-left: 4px; margin-top: 0px;">
        <tr style="background-color:#dbd9de;">
				
                                        <th style="text-align: center">NIS</th>
                                        <th style="text-align: center">Nama Siswa</th>
                                        <th style="text-align: center">Kelas</th>
                                        <th style="text-align: center">Eskul</th>
	</tr>

<?php
require_once '../../lib/koneksi.php';           
$query = " SELECT 
                            t_anggota.kd_anggota, t_anggota.kd_siswa,t_anggota.kd_eskul,
                            t_eskul.kd_eskul, t_eskul.kd_pelatih1, t_eskul.kd_pelatih2, t_eskul.kd_pelatih3, t_eskul.kd_pelatih4,  t_eskul.nm_eskul, 
                            t_siswa.kd_siswa, t_siswa.nis, t_siswa.nm_siswa, t_siswa.ttl, t_siswa.jns_kelamin, t_siswa.alamat, t_siswa.kelas,
                            t_siswa.angkatan, t_siswa.status,
                            t_pelatih.kd_pelatih,t_pelatih.nm_pelatih
                            FROM 
                                t_anggota
                                    JOIN t_eskul ON t_anggota.kd_eskul = t_eskul.kd_eskul
                                    JOIN t_siswa ON t_anggota.kd_siswa = t_siswa.kd_siswa
                                 JOIN t_pelatih ON t_eskul.kd_pelatih1 = t_pelatih.kd_pelatih";
$exe = mysqli_query($mysqli, $query);                   
while($row = mysqli_fetch_assoc($exe)){
$a = $row['nis'];
$b = $row['nm_siswa'];
$c = $row['kelas'];
$d = $row['nm_eskul'];
$e= $row['kd_anggota'];
?>
<tr id="tabel1" align="center" >			
<td><a href="#" style="text-decoration: none;"
onclick="
    window.opener.document.getElementById('nis').value = '<?php echo $a;?>';
	window.opener.document.getElementById('nm_siswa').value = '<?php echo $b;?>';
	window.opener.document.getElementById('kelas').value = '<?php echo $c;?>';
	window.opener.document.getElementById('nm_eskul').value = '<?php echo $d;?>';
	window.opener.document.getElementById('kd_anggota').value = '<?php echo $e;?>';
	 window.close();"><?php echo $a;?></a></td>			
<td><a href="#" style="text-decoration: none;"
onclick="
    window.opener.document.getElementById('nis').value = '<?php echo $a;?>';
	window.opener.document.getElementById('nm_siswa').value = '<?php echo $b;?>';
	window.opener.document.getElementById('kelas').value = '<?php echo $c;?>';
	window.opener.document.getElementById('nm_eskul').value = '<?php echo $d;?>';
	window.opener.document.getElementById('kd_anggota').value = '<?php echo $e;?>';
	 window.close();"><?php echo $b;?></a></td>			
<td><a href="#" style="text-decoration: none;"
onclick="
    window.opener.document.getElementById('nis').value = '<?php echo $a;?>';
	window.opener.document.getElementById('nm_siswa').value = '<?php echo $b;?>';
	window.opener.document.getElementById('kelas').value = '<?php echo $c;?>';
	window.opener.document.getElementById('nm_eskul').value = '<?php echo $d;?>';
	window.opener.document.getElementById('kd_anggota').value = '<?php echo $e;?>';
	 window.close();"><?php echo $c;?></a></td>			
<td><a href="#" style="text-decoration: none;"
onclick="
    window.opener.document.getElementById('nis').value = '<?php echo $a;?>';
	window.opener.document.getElementById('nm_siswa').value = '<?php echo $b;?>';
	window.opener.document.getElementById('kelas').value = '<?php echo $c;?>';
	window.opener.document.getElementById('nm_eskul').value = '<?php echo $d;?>';
	window.opener.document.getElementById('kd_anggota').value = '<?php echo $e;?>';
	 window.close();"><?php echo $d;?></a></td>
</tr>
</br>
<?php
}
?>
</html>
