<?php
if(isset($_POST['tambah'])){
	
	include('../../../config/koneksi.php');
	$id 			= $_POST['id'];
	$kd_kelas		= $_POST['kd_kelas'];
	$kelas      	= $_POST['kelas'];	
	
if($kd_kelas&&$kelas){		
	$sql = "UPDATE tb_kelas SET kd_kelas='$kd_kelas', kelas='$kelas' WHERE id_kelas='$id' ";		
	$update = mysqli_query($koneksi,$sql);
	
	if($update){
			echo "<script>alert('Data Berhasil Disimpan !');window.location='../../index.php?page=dt_kelas';</script>";
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