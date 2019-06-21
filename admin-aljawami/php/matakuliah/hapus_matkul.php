<?php
if(isset($_GET['id'])){
	
	include('../../../config/koneksi.php');
	include('../cek_akses.php');

	$status	= $_SESSION['status'];
	$id = $_GET['id'];
	
	$sql = "SELECT id_matkul FROM tb_matkul WHERE id_matkul='$id' ";
	$cek = mysqli_query($koneksi, $sql);

	if(mysqli_num_rows($cek) == 0){
		
		echo '<script>window.history.back()</script>';
	
	}else{
		
		$sql1 = "DELETE FROM tb_matkul WHERE id_matkul='$id' ";
		$del = mysqli_query($koneksi, $sql1);
		if($del){
			if ($status == "Root") {
					echo "<script>alert('Data Berhasil Dihapus !');window.location='../../index.php?page=dt_matkul_r';</script>";
				}else{
					echo "<script>alert('Data Berhasil Dihapus !');window.location='../../index_user.php?page=dt_matkul';</script>";
				}
		}else{
			echo "<script>alert('Gagal Mengahapus Data !');window.history.back()</script>";		
		}	
	}
	
}else{
	echo '<script>window.history.back()</script>';
	
}
?>