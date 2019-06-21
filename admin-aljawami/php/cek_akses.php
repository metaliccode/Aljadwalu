<?php
session_start();

//cek apakah user sudah login
if( (!isset($_SESSION['user_admin'])AND!isset($_SESSION['user_admin'])) ){
    echo '<script language="javascript">alert("Anda harus Login Terlebih DahuLu!"); document.location="../index.html";</script>';

}

?>