<!DOCTYPE html>
<?php 
ob_start();
?>
<page>
		<style type="text/css">
		table#barang{
			border: 2px solid darkgrey;
		}
		th{
			border-bottom: 2px solid darkgrey;
		}
		td.table-td{
			border-bottom: 2px solid darkgrey;
			border-right: 0.5px solid darkgrey;
		}
		</style>
		
		<table border="0" align="center" style="font-size: 16px; border-collapse: collapse; width: 100%;">
			<tr>
				<td style="font-size: 14px; width: 90%;" align="center;"><b>SEKOLAH MENENGAH PERTAMA</b></td>
			
				</tr>
		<tr><td style="font-size: 14px; width: 90%;" align="center;"><b>PLUS CITRA MADINATUL ILMI</b></td></tr>
			
			<tr><td style="font-size: 10px; width: 92%;" align="center;">Tanjung Rema, Kec.Gambut ,Kab. Banjar, Prov. Kalimantan Selatan, Kode Pos : 70722</td></tr>
		</table>
		<hr>
		<h5 align="center">DATA ANGGOTA </h5>
		<table  border="1" style="font-size: 8px; border-collapse: collapse; width: 100%;">
			<thead>
			<tr>
		
		<td style="text-align: center">No.</td>
        <td style="text-align: center">Nama Extrakuliler</td>
        <td style="text-align: center">Nama Pelatih1</td>
        <td style="text-align: center">Nama Pelatih2</td>
        <td style="text-align: center">Nama Pelatih3</td>
        <td style="text-align: center">Nama Pelatih4</td>
        <td style="text-align: center">Nis</td>
        <td style="text-align: center">Nama Siswa</td>
        <td style="text-align: center">TTL</td>
        <td style="text-align: center">Jenip Kelamin</td>
        <td style="text-align: center">Alamat</td>
        <td style="text-align: center">Kelas</td>
        <td style="text-align: center">Angkatan</td>
        <td style="text-align: center">Status</td>
			</tr>
			</thead>
		 <?php
		 $no=1;
         require_once '../../lib/koneksi.php';  
   
        $qupdate = " SELECT 
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
        $rupdate = mysqli_query($mysqli, $qupdate);
        while($dupdate = mysqli_fetch_assoc($rupdate)){
       		?>
			<tbody>
<tr>
<td align="center">&nbsp;<?php echo $no ?>&nbsp;</td>
<td style="width:50px;" align="center">&nbsp;<?php echo $dupdate['nm_eskul']; ?>&nbsp;</td>
<td style="width:50px;" align="center">&nbsp;<?php echo $dupdate['nm_pelatih']; ?>&nbsp;</td>
<td style="width:50px;" align="center">&nbsp;<?php echo $dupdate['kd_pelatih2']; ?>&nbsp;</td>
<td style="width:50px;" align="center">&nbsp;<?php echo $dupdate['kd_pelatih3']; ?>&nbsp;</td>
<td style="width:50px;" align="center">&nbsp;<?php echo $dupdate['kd_pelatih4']; ?>&nbsp;</td>
<td style="width:50px;" align="center">&nbsp;<?php echo $dupdate['nis']; ?>&nbsp;</td>
<td style="width:50px;" align="center">&nbsp;<?php echo $dupdate['nm_siswa']; ?>&nbsp;</td>
<td style="width:50px;" align="center">&nbsp;<?php echo $dupdate['ttl']; ?>&nbsp;</td>
<td style="width:50px;" align="center">&nbsp;<?php echo $dupdate['jns_kelamin']; ?>&nbsp;</td>
<td style="width:50px;" align="center">&nbsp;<?php echo $dupdate['alamat']; ?>&nbsp;</td>
<td style="width:50px;" align="center">&nbsp;<?php echo $dupdate['kelas']; ?>&nbsp;</td>
<td style="width:50px;" align="center">&nbsp;<?php echo $dupdate['angkatan']; ?>&nbsp;</td>
<td style="width:50px;" align="center">&nbsp;<?php echo $dupdate['status']; ?>&nbsp;</td>
</tr>
</tbody>

<?php $no++; } ?>
		</table>
       
		
<p></p>
	


		
		
		<br />
        <p></p>
		<?php
		
        ?>
		
</page>
<?php
    $content = ob_get_clean();

// conversion HTML => PDF
 require_once(dirname(__FILE__).'../../../html2pdf/html2pdf.class.php');
 try
 {
 $html2pdf = new HTML2PDF('L','A5', 'fr', false, 'ISO-8859-15');
 $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
 ob_end_clean();
 $html2pdf->Output();
 }
 catch(HTML2PDF_exception $e) { echo $e; }
?>
</html>