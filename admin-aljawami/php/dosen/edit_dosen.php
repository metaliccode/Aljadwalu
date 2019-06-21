<?php
if(isset($_POST['tambah'])){
	
	include('../../../config/koneksi.php');
	include('../cek_akses.php');

	$status	= $_SESSION['status'];
	$id 			= $_POST['id'];
	$nip			= $_POST['nip'];
	$nama_dosen		= $_POST['nama_dosen'];
	$kd_jurusan		= $_POST['kd_jurusan'];	
	$email			= $_POST['email'];
	$no_hp 			= $_POST['no_hp'];	
	
if($nip&&$nama_dosen ){		
	$sql = "UPDATE tb_dosen SET nip='$nip', dosen='$nama_dosen', kd_jurusan='$kd_jurusan', email='$email', no_hp='$no_hp' WHERE id_dosen='$id' ";		
	$update = mysqli_query($koneksi,$sql);
	
	if($update){
			if ($status == "Root") {
					echo "<script>alert('Data Berhasil Diupdate !');window.location='../../index.php?page=dt_dosen_r';</script>";
				}else{
					echo "<script>alert('Data Berhasil Diupdate !');window.location='../../index_user.php?page=dt_dosen';</script>";
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