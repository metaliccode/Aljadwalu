<?php
include('../../config/koneksi.php');
IF(ISSET($_POST['login'])){

$user = $_POST['username'];
$pass = md5($_POST['password']);
//$pass = $_POST['password'];

$sql = "SELECT * FROM tb_admin WHERE username='$user' AND password='$pass' ";
$login=mysqli_query($koneksi,$sql);
$ketemu=mysqli_num_rows($login);
$dt=mysqli_fetch_array($login);

if($ketemu>0){
	session_start();
	$_SESSION['nama_admin'] 	= $dt['nama_admin'];
	$_SESSION['user_admin']		= $dt['username'];
	$_SESSION['status'] 		= $dt['level'];
	$_SESSION['id_admin']		= $dt['id_admin'];
	$_SESSION['kd_jurusan'] 	= $dt['kd_jurusan'];

    if($_SESSION['status'] == "Root") {
        header('location: ../index.php?page=home_r');
    }else {
        header('location: ../index_user.php?page=home');
    }
	
	
}else{
	echo "<script language=\"javascript\">alert(\"Password atau Username Salah !!!\");window.history.back()</script>";
}

}
?>
