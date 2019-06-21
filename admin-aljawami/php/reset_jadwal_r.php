<?php
include ('../../config/koneksi.php');

if(isset($_POST['reset'])){

$sql1 = "DELETE FROM tb_jadwal ";
$del = mysqli_query($koneksi,$sql1);

	if($del){
			echo "<script>alert('Sistem Penjadwalan Semester ini Berhasil Di Reset !');window.location='../index.php?dt_jadwal';</script>";
		}else{
			echo "<script>alert('Gagal Mereset Sistem Penjadwalan !');window.history.back()</script>";	
		}

}else{	
	echo "<script>window.history.back()</script>";
}

?>
