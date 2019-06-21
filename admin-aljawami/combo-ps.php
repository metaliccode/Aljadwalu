<script language='javascript'>

function showJurusan(){
<?php
include("../config/koneksi.php");
//cb jurusan
$sql = "SELECT * FROM tb_jurusan ORDER BY id_jurusan ASC";
$hasil = mysqli_query($koneksi,$sql);
while ($data = mysqli_fetch_array($hasil)){
	$jurusan = $data['kd_jurusan'];

//cb semester
$sql1 = "SELECT * FROM tb_semester ORDER BY id_smt ASC";
$hasil1 = mysqli_query($koneksi,$sql1);
while ($data1 = mysqli_fetch_array($hasil1)){
	$semester = $data1['semester'];

//2 kondisi combobox logika if
echo "if( (document.form1.jurusan.value == \"".$jurusan."\") && (document.form1.semester.value == \"".$semester."\")  )";

echo "{";

//membuat option matkul
$sql2 = "SELECT * FROM tb_matkul WHERE kd_jurusan = '$jurusan' AND semester='$semester' ORDER BY id_matkul ASC";

$hasil2 = mysqli_query($koneksi,$sql2);
$content = "document.getElementById('mat').innerHTML = \"";

while ($data2 = mysqli_fetch_array($hasil2)){
	$content .= "<option value='".$data2['kd_matkul']."'>".$data2['matkul']." - (".$data2['sks']." SKS)</option>";
}

$content .= "\"";
echo $content;
echo "}\n";

} //endwhile jur	
} //endwhile smt

?>
}


</script>