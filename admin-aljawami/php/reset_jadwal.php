<?php
include ('../../config/koneksi.php');
include('cek_akses.php');

$status		= $_SESSION['status'];
$kd_jurusan= $_POST['kd_jurusan'];

if(isset($_POST['reset'])){

$sql1 = "DELETE FROM tb_jadwal WHERE kd_jurusan='$kd_jurusan' ";
$del = mysqli_query($koneksi,$sql1);

	if($del){
			//echo "<script>alert('Sistem Penjadwalan Semester ini Berhasil Di Reset !');window.location='../index.php?dt_jadwal';</script>";
		
			if ($status == "Root") {
				echo "<script>alert('Sistem Penjadwalan Semester ini Berhasil Di Reset !');window.location='../index.php?page=dt_jadwal_r';</script>";
			}else{
				echo "<script>alert('Sistem Penjadwalan Semester ini Berhasil Di Reset !');window.location='../index_user.php?page=dt_jadwal';</script>";
			}

		}else{
			echo "<script>alert('Gagal Mereset Sistem Penjadwalan !');window.history.back()</script>";	
		}

}else{	
	echo "<script>window.history.back()</script>";
}

?>
