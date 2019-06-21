<?php
if(isset($_POST['tambah'])){
	
	include('../../../config/koneksi.php');
	include('../cek_akses.php');

	$status			= $_SESSION['status'];
	$kd_matkul 		= $_POST['kd_matkul']; 
	$nama_matkul 	= addslashes(strip_tags ($_POST['nama_matkul'])); 
	$jurusan	 	= addslashes(strip_tags ($_POST['jurusan']));
	$sks	 		= $_POST['sks'];
	$semester 		= $_POST['semester']; 

	if ($kd_matkul&&$nama_matkul&&$jurusan&&$semester) {

	$sql = "INSERT INTO tb_matkul SET id_matkul='', kd_matkul='$kd_matkul', matkul='$nama_matkul', kd_jurusan='$jurusan', sks='$sks', semester='$semester' ";
	$simpan=mysqli_query($koneksi,$sql);

		if($simpan){
				if ($status == "Root") {
					echo "<script>alert('Data Berhasil Ditambahkan !');window.location='../../index.php?page=dt_matkul_r';</script>";
				}else{
					echo "<script>alert('Data Berhasil Ditambahkan !');window.location='../../index_user.php?page=dt_matkul';</script>";
				}
			}else{
				echo "<script>alert('Data Gagal Ditambahkan, Kode matakuliah tidak unique !');window.history.back()</script>";	
			}

	}else{
		echo "<script>alert('Data masih belum lengkap !');window.history.back()</script>";
	}		

}else{	
	echo '<script>window.history.back()</script>';

}
?>