<?php	
include('../../../config/koneksi.php');
include('../cek_akses.php');

if(isset($_POST['tambah'])){
    
$status         = $_SESSION['status'];

$nama 		= addslashes(strip_tags ($_POST['nama']));
$kd_jurusan = addslashes(strip_tags ($_POST['kd_jurusan']));  
$username 	= addslashes(strip_tags ($_POST['username'])); 
$password 	= addslashes(strip_tags ($_POST['password'])); 
$password2 	= addslashes(strip_tags ($_POST['password2'])); 
$level      = addslashes(strip_tags ($_POST['level'])); 
 
if ($nama&&$username&&$kd_jurusan&&$password&&$password2&&$level) { 
	//berfunsgi untuk mengecek form tidak boleh lebih dari 10 char 
 	if (strlen($username) > 10){
 		echo "<script>alert('username tidak boleh lebih dari 10 karakter!');window.history.back()</script>";
	}else {
	    
	    //password harus 6-25 karakter
	    if (strlen($password) > 25 || strlen($password2) < 6){
	 		echo "<script>alert('password harus 6-25 karakter!');window.history.back()</script>";
    	}else {

    	//cek pas1 & pass2
        if ($password == $password2){
            $sql = "SELECT * FROM tb_admin WHERE username = '$username' ";
            $query = mysqli_query($koneksi,$sql);
            $cek = mysqli_num_rows($query);
        
        //cek username yang sama
            if ($cek == 0) {
                $password = md5($password);
	 			$sql1 = "INSERT INTO tb_admin SET id_admin='', kd_jurusan='$kd_jurusan', nama_admin='$nama', username='$username', password='$password', level='$level' ";
	 			$query1 = mysqli_query($koneksi,$sql1); 
	 			
                if ($status == "Root") {
                    echo "<script>alert('Data Berhasil Ditambahkan !');window.location='../../index.php?page=dt_admin_r';</script>";
                }else{
                    echo "<script>alert('Data Berhasil Ditambahkan !');window.location='../../index_user.php?page=dt_admin';</script>";
                }
            }else {
	 			echo "<script>alert('Username sudah terdaftar !');window.history.back()</script>";
            }

        }else {
	 		echo "<script>alert('Password yang anda masukan tidak sama !');window.history.back()</script>";
        	}
        }

    }

}else {
	echo "<script>alert('Tolong penuhi form pendaftaran!');window.history.back()</script>";
}

}else{
	echo '<script>window.history.back()</script>';
}
?>



