<?php
include "lib/koneksi.php";
$id=$_POST['id'];
 $qcombo = "select * from t_subkat where kd_kat='".$id."'";
                        $rcombo = mysqli_query($mysqli,$qcombo);
                        $row = mysqli_num_rows($rcombo);
                        if ($row > 0)
						{
                        while($data = mysqli_fetch_assoc($rcombo)) {
                            echo " <option value=".$data["kd_subkat"].">".$data["nama_subkat"]."</option>";

 }
}
?>