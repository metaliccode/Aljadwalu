<?php
if(isset($_POST['tambah'])){
	
	include('../../../config/koneksi.php');
	$id 			= $_POST['id'];
	$kd_jurusan		= $_POST['kd_jurusan'];
	$nama_jurusan	= $_POST['nama_jurusan'];	
	
if($kd_jurusan&&$nama_jurusan){		
	$sql = "UPDATE tb_jurusan SET kd_jurusan='$kd_jurusan', jurusan='$nama_jurusan' WHERE id_jurusan='$id' ";		
	$update = mysqli_query($koneksi,$sql);
	
	if($update){
			echo "<script>alert('Data Berhasil Disimpan !');window.location='../../index.php?page=dt_jurusan';</script>";
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