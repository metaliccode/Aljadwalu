<?php
if(isset($_POST['tambah'])){
	
	include('../../../config/koneksi.php');
	
	$kd_jurusan 	= addslashes(strip_tags ($_POST['kd_jurusan'])); 
	$nama_jurusan 	= addslashes(strip_tags ($_POST['nama_jurusan'])); 

	if ($kd_jurusan&&$nama_jurusan) {

	$sql = "INSERT INTO tb_jurusan SET id_jurusan='', kd_jurusan='$kd_jurusan', jurusan='$nama_jurusan' ";
	$simpan=mysqli_query($koneksi,$sql);

		if($simpan){
				echo "<script>alert('Data Berhasil Ditambahkan !');window.location='../../index.php?page=dt_jurusan';</script>";
			}else{
				echo "<script>alert('Data Gagal Ditambahkan, Kode jurusan tidak unique !');window.history.back()</script>";	
			}

	}else{
		echo "<script>alert('Data masih belum lengkap !');window.history.back()</script>";
	}		

}else{	
	echo '<script>window.history.back()</script>';

}
?>