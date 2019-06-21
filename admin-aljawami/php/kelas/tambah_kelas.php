<?php
if(isset($_POST['tambah'])){
	
	include('../../../config/koneksi.php');
	
	$kd_kelas 	= addslashes(strip_tags ($_POST['kd_kelas'])); 
	$kelas  	= addslashes(strip_tags ($_POST['kelas'])); 

	if ($kd_kelas&&$kelas) {

	$sql = "INSERT INTO tb_kelas SET id_kelas='', kd_kelas='$kd_kelas', kelas='$kelas' ";
	$simpan=mysqli_query($koneksi,$sql);

		if($simpan){
				echo "<script>alert('Data Berhasil Ditambahkan !');window.location='../../index.php?page=dt_kelas';</script>";
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