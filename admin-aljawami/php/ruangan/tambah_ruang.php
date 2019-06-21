<?php

if(isset($_POST['tambah'])){
	
	include('../../../config/koneksi.php');
	
	$kd_ruang 		= addslashes(strip_tags ($_POST['kd_ruang'])); 
	$nama_ruang 	= addslashes(strip_tags ($_POST['nama_ruang'])); 

	if ($kd_ruang&&$nama_ruang) {

	$sql = "INSERT INTO tb_ruangan SET id_ruang='', kd_ruang='$kd_ruang', nama_ruang='$nama_ruang' ";
	$simpan=mysqli_query($koneksi,$sql);

		if($simpan){
				echo "<script>alert('Data Berhasil Ditambahkan !');window.location='../../index.php?page=dt_ruangan';</script>";
			}else{
				echo "<script>alert('Data Gagal Ditambahkan, Kode ruangan tidak unique !');window.history.back()</script>";	
			}

	}else{
		echo "<script>alert('Data masih belum lengkap !');window.history.back()</script>";
	}		

}else{	
	echo '<script>window.history.back()</script>';

}
?>