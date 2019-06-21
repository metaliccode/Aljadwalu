<?php
if(isset($_GET['id'])){
	
	include('../../../config/koneksi.php');
	include('../cek_akses.php');
	$status	= $_SESSION['status'];
	
	$id = $_GET['id'];
	
	$sql = "SELECT id_dosen FROM tb_dosen WHERE id_dosen='$id' ";
	$cek = mysqli_query($koneksi, $sql);

	if(mysqli_num_rows($cek) == 0){
		
		echo '<script>window.history.back()</script>';
	
	}else{
		
		$sql1 = "DELETE FROM tb_dosen WHERE id_dosen='$id' ";
		$del = mysqli_query($koneksi, $sql1);
		if($del){
			if ($status == "Root") {
					echo "<script>alert('Data Berhasil Dihapus !');window.location='../../index.php?page=dt_dosen_r';</script>";
				}else{
					echo "<script>alert('Data Berhasil Dihapus !');window.location='../../index_user.php?page=dt_dosen';</script>";
				}
		}else{
			echo "<script>alert('Gagal Mengahapus Data !');window.location='../../index.php?page=dt_dosen';</script>";		
		}	
	}
	
}else{
	echo '<script>window.history.back()</script>';
	
}
?>