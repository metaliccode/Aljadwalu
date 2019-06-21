<?php
error_reporting(0);
if(isset($_POST['tambah'])){
	
	include('../../../config/koneksi.php');
	include('../cek_akses.php');

	$status	   = $_SESSION['status'];
	$id 	   = $_POST['id'];
	$kd_dosen  = $_POST['dosen'];
	$hari	   = $_POST['hari'];
	$kd_jurusan= $_POST['jur'];
	//$semester = $_POST['smt'];
	$kd_matkul = $_POST['mtk'];
	//$waktu1 = $_POST['waktu1'];
	$waktu1 = date('H:i:s',strtotime($_POST['waktu1']));
	$waktu2 = date('H:i:s',strtotime($_POST['waktu2']));
	$kelas 	= $_POST['kelas'];
	$kls 	= $_POST['kls'];
	//echo $id."<br>".$kd_dosen."<br>". $hari."<br>". $kd_jurusan."<br>". $kd_matkul."<br>". $semester."<br>". $waktu2;

	if ($kd_dosen) {
		//echo "Ganti dosen";
		if ($kd_jurusan&&$kd_matkul&&$kelas) {
		//ganti dosen + Matkul +kls
			$sqlmatkulall = "SELECT * FROM tb_jadwal WHERE kd_matkul='$kd_matkul' AND kelas='$kelas' ";
   			$qmatall = mysqli_query($koneksi,$sqlmatkulall);
   			$ktmatall = mysqli_num_rows($qmatall);
   			$ckmatall = mysqli_fetch_array($qmatall);
   			if ($ktmatall>0){
   				$k = $ckmatall[''];
				echo "<script>alert('Matakuliah sudah diambil oleh kelas ini ($k) !');window.history.back()</script>";
   			}else{
   				$sqlall = "SELECT * FROM tb_jadwal,tb_dosen WHERE tb_dosen.id_dosen=tb_jadwal.kd_dosen='$kd_dosen' 
   				AND hari='$hari'
				AND (  (waktu1<'$waktu1' AND waktu2>'$waktu1' AND waktu1<'$waktu2' AND waktu2>='$waktu2') 
				OR (waktu1<'$waktu1' AND waktu2>'$waktu1' AND waktu1<'$waktu2' AND waktu2<='$waktu2') 
				OR (waktu1>'$waktu1' AND waktu2>'$waktu1' AND waktu1<'$waktu2' AND waktu2>='$waktu2')
				OR (waktu1='$waktu1' AND waktu2='$waktu2')
				OR (waktu1<'$waktu1' AND waktu2>'$waktu1')
				OR (waktu1<'$waktu2' AND waktu2>'$waktu2')
				OR (waktu1='$waktu1' AND waktu2<'$waktu2')
					) ";
				
				$queryall = mysqli_query($koneksi,$sqlall);
				$ktdosall = mysqli_num_rows($queryall);
				$ckdosall = mysqli_fetch_array($queryall);
				if ($ktdosall==0){
					//echo "tdk bentrok";
					$sqlupall = "UPDATE tb_jadwal SET kd_dosen='$kd_dosen', kd_matkul='$kd_matkul', kd_jurusan='$kd_jurusan', kelas='$kelas'  WHERE id_jadwal='$id' ";		
					$updateall = mysqli_query($koneksi,$sqlupall);

					if($updateall){
							if ($status == "Root") {
								echo "<script>alert('Data Berhasil Diupdate !');window.location='../../index.php?page=dt_jadwal_r';</script>";
							}else{
								echo "<script>alert('Data Berhasil Diupdate !');window.location='../../index_user.php?page=dt_jadwal';</script>";
							}
					}else{
						echo "<script>alert('Data Gagal Ditambahkan !');window.history.back()</script>";	
					}				
				
				}else{
					$ddd = $ckdosall['dosen'];
					echo "<script>alert('Dosen $ddd telah mengambil Matakuliah lain pada jam ini !');window.history.back()</script>";
				}
				   				
   			}//end dos		
   					
		}else if ($kd_jurusan&&$kd_matkul) {
			//ganti matkul kls tetap
			$sqlal = "SELECT * FROM tb_jadwal,tb_dosen WHERE tb_dosen.id_dosen=tb_jadwal.kd_dosen
				kd_dosen='$kd_dosen'AND 
				AND hari='$hari'
				AND (  (waktu1<'$waktu1' AND waktu2>'$waktu1' AND waktu1<'$waktu2' AND waktu2>='$waktu2') 
				OR (waktu1<'$waktu1' AND waktu2>'$waktu1' AND waktu1<'$waktu2' AND waktu2<='$waktu2') 
				OR (waktu1>'$waktu1' AND waktu2>'$waktu1' AND waktu1<'$waktu2' AND waktu2>='$waktu2')
				OR (waktu1='$waktu1' AND waktu2='$waktu2')
				OR (waktu1<'$waktu1' AND waktu2>'$waktu1')
				OR (waktu1<'$waktu2' AND waktu2>'$waktu2')
				OR (waktu1='$waktu1' AND waktu2<'$waktu2')
					) ";
				
			
			$queryal = mysqli_query($koneksi,$sqlal);
			$ktdosal = mysqli_num_rows($queryal);
			$ckdosal = mysqli_fetch_array($queryal);
			if ($ktdosal==0){
				//echo "tdk bentrok";
				$sqlupal = "UPDATE tb_jadwal SET kd_dosen='$kd_dosen', kd_matkul='$kd_matkul', kd_jurusan='$kd_jurusan'  WHERE id_jadwal='$id' ";		
				$updateal = mysqli_query($koneksi,$sqlupal);

				if($updateal){
						if ($status == "Root") {
								echo "<script>alert('Data Berhasil Diupdate !');window.location='../../index.php?page=dt_jadwal_r';</script>";
							}else{
								echo "<script>alert('Data Berhasil Diupdate !');window.location='../../index_user.php?page=dt_jadwal';</script>";
							}
				}else{
					echo "<script>alert('Data Gagal Ditambahkan !');window.history.back()</script>";	
				}				
			
			}else{
				$dd = $ckdosal['dosen'];
				echo "<script>alert('Dosen $dd telah mengambil Matakuliah lain pada jam ini !');window.history.back()</script>";
			}
				   							   		
		}else{
		//ganti dosen doang	
			$sqldd = "SELECT * FROM tb_jadwal,tb_dosen WHERE tb_dosen.id_dosen=tb_jadwal.kd_dosen
					kd_dosen='$kd_dosen' AND
	   				AND hari='$hari'
					AND (  (waktu1<'$waktu1' AND waktu2>'$waktu1' AND waktu1<'$waktu2' AND waktu2>='$waktu2') 
					OR (waktu1<'$waktu1' AND waktu2>'$waktu1' AND waktu1<'$waktu2' AND waktu2<='$waktu2') 
					OR (waktu1>'$waktu1' AND waktu2>'$waktu1' AND waktu1<'$waktu2' AND waktu2>='$waktu2')
					OR (waktu1='$waktu1' AND waktu2='$waktu2')
					OR (waktu1<'$waktu1' AND waktu2>'$waktu1')
					OR (waktu1<'$waktu2' AND waktu2>'$waktu2')
					OR (waktu1='$waktu1' AND waktu2<'$waktu2')
					) ";
				
			
			$querydd = mysqli_query($koneksi,$sqldd);
			$ktdosdd = mysqli_num_rows($querydd);
			$ckdosdd = mysqli_fetch_array($querydd);
			if ($ktdosdd==0){
				//echo "tdk bentrok";
				$sqlupdd = "UPDATE tb_jadwal SET kd_dosen='$kd_dosen' WHERE id_jadwal='$id' ";		
				$updatedd = mysqli_query($koneksi,$sqlupdd);

				if($updatedd){
						if ($status == "Root") {
								echo "<script>alert('Data Berhasil Diupdate !');window.location='../../index.php?page=dt_jadwal_r';</script>";
							}else{
								echo "<script>alert('Data Berhasil Diupdate !');window.location='../../index_user.php?page=dt_jadwal';</script>";
							}
				}else{
					echo "<script>alert('Data Gagal Ditambahkan !');window.history.back()</script>";	
				}				
			
			}else{
				//echo $kd_dosen;
				$ds = $ckdosdd['dosen'];
				echo "<script>alert('Dosen $ds telah mengambil Matakuliah pada jam ini !');window.history.back()</script>";
			}	
		}		
	

	}
//ganti matkul dosen tetap
	else if ($kd_jurusan&&$kelas&&$kd_matkul){	
		//echo "ganti matkul doang";
		$sqlmatkul = "SELECT * FROM tb_jadwal WHERE kd_matkul='$kd_matkul' AND kelas='$kelas' ";
		$qmat = mysqli_query($koneksi,$sqlmatkul);
		$ktmat = mysqli_num_rows($qmat);
		$ckmat = mysqli_fetch_array($qmat);
		if ($ktmat>0){
			$kk = $ckmat['kelas'];
		echo "<script>alert('Matakuliah sudah diambil oleh kelas ini ($kk) !');window.history.back()</script>";
		}else{
		$sqlupmat = "UPDATE tb_jadwal SET kd_matkul='$kd_matkul', kd_jurusan='$kd_jurusan', kelas='$kelas' WHERE id_jadwal='$id' ";		
		$updatemat = mysqli_query($koneksi,$sqlupmat);
			if($updatemat){
					if ($status == "Root") {
								echo "<script>alert('Data Berhasil Diupdate !');window.location='../../index.php?page=dt_jadwal_r';</script>";
							}else{
								echo "<script>alert('Data Berhasil Diupdate !');window.location='../../index_user.php?page=dt_jadwal';</script>";
							}
			}else{
				echo "<script>alert('Data Gagal Ditambahkan !');window.history.back()</script>";	
			}   				
		}//end dos					

	}
//ganti matkul tanpa kelas	
	else if ($kd_jurusan&&$kd_matkul) {
		$sqlm = "SELECT * FROM tb_jadwal WHERE kd_matkul='$kd_matkul' AND kelas='$kls' ";
		$qm = mysqli_query($koneksi,$sqlm);
		$ktm = mysqli_num_rows($qm);
		$ckm = mysqli_fetch_array($qm);
		if ($ktm>0){
			$km = $ckm['kelas'];
		echo "<script>alert('Matakuliah sudah diambil oleh kelas ini ($km) !');window.history.back()</script>";
		}else{
		$sqlupm = "UPDATE tb_jadwal SET kd_matkul='$kd_matkul', kd_jurusan='$kd_jurusan' WHERE id_jadwal='$id' ";		
		$updatem = mysqli_query($koneksi,$sqlupm);
			if($updatem){
					if ($status == "Root") {
								echo "<script>alert('Data Berhasil Diupdate !');window.location='../../index.php?page=dt_jadwal_r';</script>";
							}else{
								echo "<script>alert('Data Berhasil Diupdate !');window.location='../../index_user.php?page=dt_jadwal';</script>";
							}
			}else{
				echo "<script>alert('Data Gagal Ditambahkan !');window.history.back()</script>";	
			}   				
		}//end dos		
	}	
//jika tidak memilih	
	else{
		echo "<script>alert('Form data ada yang kosong, Jika anda tidak ingin mengedit data, silahkan pilih tombol back ');window.history.back()</script>";

	}
//end 
}

?>