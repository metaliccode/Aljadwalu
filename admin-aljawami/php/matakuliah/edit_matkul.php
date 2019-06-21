<?php
if(isset($_POST['tambah'])){
	
	include('../../../config/koneksi.php');
	include('../cek_akses.php');

	$status	= $_SESSION['status'];
	$id 			= $_POST['id'];
	$kd_matkul 		= $_POST['kd_matkul']; 
	$nama_matkul 	= addslashes(strip_tags ($_POST['nama_matkul'])); 
	$jurusan	 	= $_POST['jurusan'];
	$sks	 		= $_POST['sks'];
	$semester 		= $_POST['semester']; 

if ($kd_matkul&&$nama_matkul&&$jurusan&&$semester) {	
	$sql = "UPDATE tb_matkul SET kd_matkul='$kd_matkul', matkul='$nama_matkul', kd_jurusan='$jurusan', sks='$sks', semester='$semester' WHERE id_matkul='$id' ";		
	$update = mysqli_query($koneksi,$sql);
	
	if($update){
			if ($status == "Root") {
					echo "<script>alert('Data Berhasil Diupdate !');window.location='../../index.php?page=dt_matkul_r';</script>";
				}else{
					echo "<script>alert('Data Berhasil Diupdate !');window.location='../../index_user.php?page=dt_matkul';</script>";
				}
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