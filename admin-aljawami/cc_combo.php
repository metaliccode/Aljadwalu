<?php
include("../config/koneksi.php");
include("combo-ps.php");
include("combo-sks.php");

?>

<form name='form1' method='post' id='form_combo' action="show.php">
	 Pilih Jurusan: 
	 <select name='jurusan' onchange='showJurusan()'><option value=''>Pilih jurusan</option>
		<?php
			$sql = "SELECT * FROM tb_jurusan order by id_jurusan asc";
			$jurusan = mysqli_query($koneksi,$sql);
			while($hasil = mysqli_fetch_array($jurusan)){
				echo '<option value="'.$hasil[nama_jurusan].'">'.$hasil[kd_jurusan].' - '.$hasil[nama_jurusan].'</option>';
			}
		?>
	</select>
	Pilih semester:
	<select name='semester' onchange='showJurusan()'>
		<option value=''>Pilih semester</option>
		<?php
			$sql = "SELECT * FROM tb_semester order by id_smt ASC";
			$semester = mysqli_query($koneksi,$sql);
			while($hasil = mysqli_fetch_array($semester)){
				echo '<option value="'.$hasil[semester].'">'.$hasil[semester].'</option>';
			}
		?>
	</select>
	<br/> 
	pilih kota : <select name='matkul' id='mat'>
		<option value=''>pilih matkul</option>
	</select>

	SKS : <button name="submit" type="submit">Simpan</button>
		
</form>