<?php

if(isset($_POST['tambah'])){
	
	include('../../../config/koneksi.php');
	include('../cek_akses.php');

	$status		= $_SESSION['status'];
	$kd_jurusan = $_POST['jurusan'];
	$semester 	= $_POST['semester'];
	$kd_matkul  = $_POST['matkul'];
	//$waktu1		= $_POST['waktu1'];
	$lama		= $_POST['lama'];
	$hari		= $_POST['hari'];
	$kd_ruang	= $_POST['ruang'];
	$kd_dosen	= $_POST['dosen'];
	$kelas		= $_POST['kelas'];
	//echo $kd_jurusan."<br>".$kd_dosen."<br>". $kd_ruang."<br>". $kd_matkul."<br>". $kelas."<br>". $hari."<br>". $semester;

if ($kd_matkul) {
	
	if ($kd_jurusan&&$semester&&$lama&&$kd_ruang&&$hari) {		
		$waktu1 = date('H:i:s', strtotime($_POST['waktu1']));
		$sql = "SELECT * FROM tb_matkul WHERE kd_matkul='$kd_matkul' ";
		$query = mysqli_query($koneksi,$sql);
		$ketemu = mysqli_num_rows($query);
		$r = mysqli_fetch_array($query);
		//cek data matkul
		if ($ketemu>0) {
			$sks = $r['sks'];
			if ($sks>0){
				$hasil = $sks * $lama;
				$cc = $hasil.'minutes';	
			}else{
				$cc = $lama.'minutes';
			}  
		
		$waktu2 = date('H:i:s', strtotime($cc, strtotime($waktu1)));
		//cek hari, waktu, ruang		
		/* logika : Jika ada db(08.00-09.00) then
						08.10-09.00
						08.10-08.50
						07.50-08.50
						08.00-09.00
						08.10-09.10 //08.10 di tengah
						09.10 //ditngah jam matkul lain
						08.00-09.10 
   				*/
		$sqlwaktu = "SELECT * FROM tb_jadwal,tb_matkul,tb_jurusan WHERE tb_jurusan.kd_jurusan=tb_matkul.kd_jurusan AND tb_matkul.kd_matkul=tb_jadwal.kd_matkul 
			AND hari='$hari' AND kd_ruang='$kd_ruang' 
			AND (  (waktu1<'$waktu1' AND waktu2>'$waktu1' AND waktu1<'$waktu2' AND waktu2>='$waktu2') 
				OR (waktu1<'$waktu1' AND waktu2>'$waktu1' AND waktu1<'$waktu2' AND waktu2<='$waktu2') 
				OR (waktu1>'$waktu1' AND waktu2>'$waktu1' AND waktu1<'$waktu2' AND waktu2>='$waktu2')
				OR (waktu1='$waktu1' AND waktu2='$waktu2')
				OR (waktu1<'$waktu1' AND waktu2>'$waktu1')
				OR (waktu1<'$waktu2' AND waktu2>'$waktu2')
				OR (waktu1='$waktu1' AND waktu2<'$waktu2')
				 )";
		$querycek = mysqli_query($koneksi,$sqlwaktu);
		$kt = mysqli_num_rows($querycek);
		$ck = mysqli_fetch_array($querycek);
		if ($kt>0){
			$show = $ck['matkul'];
			$sh = $ck['kd_ruang'];
			$s = $ck['hari'];
			$jj = $ck['jurusan'];
			//echo "<script>alert('Jadwal bentrok dengan jadwal Matakuliah : $show, Jurusan : $jj di ruangan $sh pada hari $s ');window.history.back()</script>";
			if ($status == "Root") {
					echo "<script>alert('Jadwal bentrok dengan jadwal Matakuliah : $show, Jurusan : $jj di ruangan $sh pada hari $s ');window.location='../../index.php?page=dt_jadwal_r';</script>";
				}else{
					echo "<script>alert('Jadwal bentrok dengan jadwal Matakuliah : $show, Jurusan : $jj di ruangan $sh pada hari $s ');window.location='../../index_user.php?page=dt_jadwal';</script>";
				}
   		}else{
   			//cek matkul, Kelas
   			$sqlmatkul = "SELECT * FROM tb_jadwal WHERE kd_matkul='$kd_matkul' AND kelas='$kelas' ";
   			$qmat = mysqli_query($koneksi,$sqlmatkul);
   			$ktmat = mysqli_num_rows($qmat);
   			$ckmat = mysqli_fetch_array($qmat);
   			if ($ktmat>0){
   				$kls = $ckmat['kelas']; 
				//echo "<script>alert('Matakuliah sudah diambil oleh kelas ini ($kelas) !');window.history.back()</script>";
				if ($status == "Root") {
					echo "<script>alert('Matakuliah sudah diambil oleh kelas ini ($kelas) !');window.location='../../index.php?page=dt_jadwal_r';</script>";
				}else{
					echo "<script>alert('Matakuliah sudah diambil oleh kelas ini ($kelas) !');window.location='../../index_user.php?page=dt_jadwal';</script>";
				}
   			}else{
   				
   				$sqldos = "SELECT * FROM tb_jadwal,tb_dosen WHERE tb_dosen.id_dosen=tb_jadwal.kd_dosen 
	   				AND hari='$hari' AND kd_dosen='$kd_dosen'
					AND (  (waktu1<'$waktu1' AND waktu2>'$waktu1' AND waktu1<'$waktu2' AND waktu2>='$waktu2') 
					OR (waktu1<'$waktu1' AND waktu2>'$waktu1' AND waktu1<'$waktu2' AND waktu2<='$waktu2') 
					OR (waktu1>'$waktu1' AND waktu2>'$waktu1' AND waktu1<'$waktu2' AND waktu2>='$waktu2')
					OR (waktu1='$waktu1' AND waktu2='$waktu2')
					OR (waktu1<'$waktu1' AND waktu2>'$waktu1')
					OR (waktu1<'$waktu2' AND waktu2>'$waktu2')
					OR (waktu1='$waktu1' AND waktu2<'$waktu2')
					)";
	   			$qdos = mysqli_query($koneksi,$sqldos);
	   			$ktdos = mysqli_num_rows($qdos);
	   			$ckdos = mysqli_fetch_array($qdos);
	   			if ($ktdos>0){
	   				$d = $ckdos['dosen'];
					//echo "<script>alert('Dosen $d telah mengambil Matakuliah pada jam ini !');window.history.back()</script>";
	   				if ($status == "Root") {
						echo "<script>alert('Dosen $d telah mengambil Matakuliah pada jam ini !');window.location='../../index.php?page=dt_jadwal_r';</script>";
					}else{
						echo "<script>alert('Dosen $d telah mengambil Matakuliah pada jam ini !');window.location='../../index_user.php?page=dt_jadwal';</script>";
					}
	   			}else{
	   				//echo "berhasil";
	   				//input database
					$sqldb = "INSERT INTO tb_jadwal SET id_jadwal='', hari='$hari', waktu1='$waktu1', waktu2='$waktu2', kd_matkul='$kd_matkul', kd_dosen='$kd_dosen' , kd_ruang='$kd_ruang', kd_jurusan='$kd_jurusan',kelas='$kelas' ";
					
					$simpan=mysqli_query($koneksi,$sqldb);

					if($simpan){
						
							if ($status == "Root") {
								echo "<script>alert('Data Berhasil Ditambahkan !');window.location='../../index.php?page=dt_jadwal_r';</script>";
							}else{
								echo "<script>alert('Data Berhasil Ditambahkan !');window.location='../../index_user.php?page=dt_jadwal';</script>";
							}
							
					}else{
						echo "<script>alert('Data Gagal Ditambahkan !');window.history.back()</script>";	
					}
   				
   				}//end dos		
   			}//end mat
   		}
 	
		
		
		}else{	
			echo "<script>alert('Data Matakuliah tidak tersedia !');window.history.back()</script>";
		}

	}	
}else{
		echo "<script>alert('Data masih belum lengkap !');window.history.back()</script>";
	}		

}else{	
	echo '<script>window.history.back()</script>';

}


?>