<?php

// Load file koneksi.php
include('../../config/koneksi.php');
$status			= $_SESSION['status'];

if(isset($_POST['import'])){ // Jika user mengklik tombol Import
	$nama_file_baru = 'data.xlsx';

	// Load librari PHPExcel nya
	require_once 'PHPExcel/PHPExcel.php';

	$excelreader = new PHPExcel_Reader_Excel2007();
	$loadexcel = $excelreader->load('tmp/'.$nama_file_baru); // Load file excel yang tadi diupload ke folder tmp
	$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

	$numrow = 1;
	foreach($sheet as $row){
		// Ambil data pada excel sesuai Kolom
		$kd_matkul = $row['A']; // Ambil data NIS
		$matkul = $row['B']; // Ambil data nama
		$sks = $row['C']; // Ambil data jenis kelamin
		$kd_jurusan = $row['D']; // Ambil data telepon
		$semester = $row['E']; // Ambil data semester

		// Cek jika semua data tidak diisi
		if(empty($kd_matkul) && empty($matkul) && empty($sks) && empty($kd_jurusan) && empty($semester) )
			continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

		// Cek $numrow apakah lebih dari 1
		// Artinya karena baris pertama adalah nama-nama kolom
		// Jadi dilewat saja, tidak usah diimport
		if($numrow > 1){
			// Buat query Insert
			$sql = "INSERT INTO tb_matkul SET id_matkul='', kd_matkul='$kd_matkul', matkul='$matkul', kd_jurusan='$kd_jurusan', sks='$sks', semester='$semester' ";
			$simpan=mysqli_query($koneksi,$sql);
			
			//$query = "INSERT INTO siswa VALUES('".$nis."','".$nama."','".$jenis_kelamin."','".$telp."','".$semester."')";

			// Eksekusi $query
			//mysqli_query($connect, $query);
		}

		$numrow++; // Tambah 1 setiap kali looping
	}
}

header('location: ../index_user.php?page=dt_matkul'); // Redirect ke halaman awal

?>
