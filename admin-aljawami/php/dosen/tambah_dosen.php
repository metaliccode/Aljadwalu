<?php
if(isset($_POST['tambah'])){
	
	include('../../../config/koneksi.php');
	include('../cek_akses.php');

	$status	= $_SESSION['status'];
	
	$nip 			= $_POST['nip']; 
	$nama_dosen 	= addslashes(strip_tags ($_POST['nama_dosen'])); 
	//$d_prodi	 	= $_POST['d_prodi'];
	$kd_jurusan	 	= $_POST['kd_jurusan'];
	$email	 		= $_POST['email'];
	$no_hp 			= $_POST['no_hp']; 

	if ($nip&&$nama_dosen&&$kd_jurusan) {	
	$sql = "INSERT INTO tb_dosen SET id_dosen='', nip='$nip', dosen='$nama_dosen', kd_jurusan='$kd_jurusan', email='$email', no_hp='$no_hp' ";
	$simpan=mysqli_query($koneksi,$sql);

		if($simpan){
				if ($status == "Root") {
					echo "<script>alert('Data Berhasil Ditambahkan !');window.location='../../index.php?page=dt_dosen_r';</script>";
				}else{
					echo "<script>alert('Data Berhasil Ditambahkan !');window.location='../../index_user.php?page=dt_dosen';</script>";
				}
			}else{
				echo "<script>alert('Data Gagal Ditambahkan, No nip tidak unique !');window.history.back()</script>";	
			}

	}else{
		echo "<script>alert('Data masih belum lengkap !');window.history.back()</script>";
	}		

}else{	
	echo '<script>window.history.back()</script>';

}
?>