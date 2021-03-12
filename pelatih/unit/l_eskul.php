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
		<h5 align="center">DATA EXTRAKULILER </h5>
		<table  border="1" style="font-size: 8px; border-collapse: collapse; width: 100%;">
			<thead>
			<tr>
		
			<td style="text-align: center">No.</td>
        <td style="text-align: center">Nama Extrakuliler</td>
        <td style="text-align: center">Bidang</td>
        <td style="text-align: center">Nama Pelatih 1</td>
        <td style="text-align: center">Nama Pelatih 2</td>
        <td style="text-align: center">Nama Pelatih 3</td>
        <td style="text-align: center">Nama Pelatih 4</td>
			</tr>
			</thead>
		 <?php
		 $no=1;
         require_once '../../lib/koneksi.php';  
   
        $qupdate = " SELECT t_eskul.kd_eskul, t_eskul.nm_eskul, t_eskul.bidang, t_eskul.kd_pelatih1, t_eskul.kd_pelatih2, t_eskul.kd_pelatih3, t_eskul.kd_pelatih4, 
                           t_pelatih.kd_pelatih, t_pelatih.nm_pelatih 
                           FROM t_eskul INNER JOIN 
                           t_pelatih ON t_eskul.kd_pelatih1 =t_pelatih.kd_pelatih";
        $rupdate = mysqli_query($mysqli, $qupdate);
        while($dupdate = mysqli_fetch_assoc($rupdate)){
       		?>
			<tbody>
<tr>
<td align="center">&nbsp;<?php echo $no ?>&nbsp;</td>
<td style="width:100px;" align="center">&nbsp;<?php echo $dupdate['nm_eskul']; ?>&nbsp;</td>
<td style="width:100px;" align="center">&nbsp;<?php echo $dupdate['bidang']; ?>&nbsp;</td>
<td style="width:50px;" align="center">&nbsp;<?php echo $dupdate['nm_pelatih']; ?>&nbsp;</td>
<td style="width:50px;" align="center">&nbsp;<?php echo $dupdate['kd_pelatih2']; ?>&nbsp;</td>
<td style="width:100px;" align="center">&nbsp;<?php echo $dupdate['kd_pelatih3']; ?>&nbsp;</td>
<td style="width:50px;" align="center">&nbsp;<?php echo $dupdate['kd_pelatih4']; ?>&nbsp;</td>
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