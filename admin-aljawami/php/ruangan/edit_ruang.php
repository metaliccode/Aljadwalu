<?php
if(isset($_POST['tambah'])){
	
	include('../../../config/koneksi.php');
	$id 			= $_POST['id'];
	$kd_ruang		= $_POST['kd_ruang'];
	$nama_ruang		= $_POST['nama_ruang'];	
	
if($kd_ruang&&$nama_ruang){		
	$sql = "UPDATE tb_ruangan SET kd_ruang='$kd_ruang', nama_ruang='$nama_ruang' WHERE id_ruang='$id' ";		
	$update = mysqli_query($koneksi,$sql);
	
	if($update){
			echo "<script>alert('Data Berhasil Disimpan !');window.location='../../index.php?page=dt_ruangan';</script>";
		}else{
			echo "<script>alert('Data Gagal Disimpan !');window.history.back()</script>";	
		}
}else{
	echo "<script>alert('Ada Form Yang kosong, Silahkan Lengkapi Terlebih Dahulu !');window.history.back()</script>";
}

}else{	

	echo '<script>window.history.back()</script>';

}
?>