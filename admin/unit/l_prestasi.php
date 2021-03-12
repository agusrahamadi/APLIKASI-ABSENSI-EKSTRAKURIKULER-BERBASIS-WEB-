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
		<h5 align="center">DATA PRESTASI </h5>
		<table  border="1" style="font-size: 8px; border-collapse: collapse; width: 100%;">
			<thead>
			<tr>
		
              
                <td style="text-align: center">No.</td>
                <td style="text-align: center">Prestasi Lomba</td>
                <td style="text-align: center">Nis</td>
                <td style="text-align: center">Nama Siswa</td>
                <td style="text-align: center">Juara Ke</td>
			</tr>
			</thead>
		 <?php
		 $no=1;
         require_once '../../lib/koneksi.php';  
   
        $qupdate = " SELECT 
                            t_prestasi.kd_prestasi, t_prestasi.kd_siswa, t_prestasi.kd_event,t_prestasi.juara,
                            t_event.kd_event, t_event.lmb_event, 
                            t_siswa.kd_siswa, t_siswa.nis, t_siswa.nm_siswa, t_siswa.ttl, t_siswa.jns_kelamin, t_siswa.alamat, t_siswa.kelas,
                            t_siswa.angkatan, t_siswa.status
                            FROM 
                                t_prestasi
                                    JOIN t_event ON t_prestasi.kd_event = t_event.kd_event
                                    JOIN t_siswa ON t_prestasi.kd_siswa = t_siswa.kd_siswa";
        $rupdate = mysqli_query($mysqli, $qupdate);
        while($dupdate = mysqli_fetch_assoc($rupdate)){
       		?>
			<tbody>
<tr>
<td align="center">&nbsp;<?php echo $no ?>&nbsp;</td>
<td style="width:50px;" align="center">&nbsp;<?php echo $dupdate['lmb_event']; ?>&nbsp;</td>
<td style="width:50px;" align="center">&nbsp;<?php echo $dupdate['nis']; ?>&nbsp;</td>
<td style="width:50px;" align="center">&nbsp;<?php echo $dupdate['nm_siswa']; ?>&nbsp;</td>
<td style="width:50px;" align="center">&nbsp;<?php echo $dupdate['juara']; ?>&nbsp;</td>
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
 $html2pdf = new HTML2PDF('I','A5', 'fr', false, 'ISO-8859-15');
 $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
 ob_end_clean();
 $html2pdf->Output();
 }
 catch(HTML2PDF_exception $e) { echo $e; }
?>
</html>