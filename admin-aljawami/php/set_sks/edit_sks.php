<?php
if(isset($_POST['tambah'])){
	
	include('../../../config/koneksi.php');
	include('../cek_akses.php');

	$status	= $_SESSION['status'];
	$id 		= $_POST['id'];
	$lama		= $_POST['lama'];	
	
if($id&&$lama){		
	$sql = "UPDATE tb_set_sks SET lama='$lama' WHERE id_sks='$id' ";		
	$update = mysqli_query($koneksi,$sql);
	
	if($update){
			
			if ($status == "Root") {
					echo "<script>alert('Waktu PerSKS berhasil diatur !');window.location='../../index.php?page=set_sks_r';</script>";
				}else{
					echo "<script>alert('Waktu PerSKS berhasil diatur !');window.location='../../index_user.php?page=set_sks';</script>";

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