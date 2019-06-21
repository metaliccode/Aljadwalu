<?php
include('php/cek_akses.php');
?>   
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Sistem Penjadwalan Kuliah STAI Aljawami</title>
  <!--Bootstrap Css-->
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--Link FA-->
  <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!--Kostum Admin-->
  <link href="../css/bs-admin.css" rel="stylesheet">
  <!-- Bootstrap JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <link href='../images/logo.ico' rel='shortcut icon'>

</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top" >
  <!--Nav Kiri Atas-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav" style="font-size: 14px;">
    <a class="navbar-brand" href="index.php">Sistem Penjadwalan Kuliah</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Home">
          <a class="nav-link" href="index.php">
            <i class="fa fa-fw fa-home"></i>
            <span class="nav-link-text">Home</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Data Jurusan">
          <a class="nav-link" href=<?php echo"?page=dt_jurusan";?> >
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Data Jurusan</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Data Dosen">
          <a class="nav-link" href=<?php echo"?page=dt_dosen_r";?> >
            <i class="fa fa-fw fa-graduation-cap"></i>
            <span class="nav-link-text">Data Dosen</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Data Mata Kuliah">
          <a class="nav-link" href=<?php echo"?page=dt_matkul_r";?> >
            <i class="fa fa-fw fa-book"></i>
            <span class="nav-link-text">Data Matakuliah</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Data Ruangan">
          <a class="nav-link" href=<?php echo"?page=dt_ruangan";?> >
            <i class="fa fa-fw fa-building"></i>
            <span class="nav-link-text">Data Ruangan</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Data Kelas">
          <a class="nav-link" href=<?php echo"?page=dt_kelas";?> >
            <i class="fa fa-fw fa-cubes"></i>
            <span class="nav-link-text">Data Kelas</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Set SKS">
          <a class="nav-link" href=<?php echo"?page=set_sks";?> >
            <i class="fa fa-fw fa-hourglass-half"></i>
            <span class="nav-link-text">Set Lama Per SKS</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Data Jadwal Dosen">
          <a class="nav-link" href=<?php echo"?page=dt_jadwal_r";?> >
            <i class="fa fa-fw fa-calendar"></i>
            <span class="nav-link-text">Jadwal Kuliah</span>
          </a>
        </li>
        
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Laporan">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#laporan" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-print"></i>
            <span class="nav-link-text">Laporan</span>
          </a>
          <ul class="sidenav-second-level collapse" id="laporan">
            <li>
              <a href=<?php echo "?page=cetak_jadwal_r"; ?> >Cetak Data Jadwal Kuliah</a>
            </li>
            <li>
              <a href=<?php echo "?page=export_data_r";?> >Export Jadwal Perkuliahan</a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Data Admin">
          <a class="nav-link" href=<?php echo "?page=dt_admin_r";?>>
            <i class="fa fa-fw fa-user"></i>
            <span class="nav-link-text">Data Administrator</span>
          </a>
        </li>

      </ul>
      <!--end sidenav kiri-->

      <!--tombol side nav ke kiri-->
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <!--./tombol side nav ke kiri-->

      <!--NAV ATAS KANAN-->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link " data-toggle="dropdown">
            <i class="fa fa-fw fa-gears"></i>
          </a>
          <div class="dropdown-menu">
            <a class="nav-link dropdown-item text-dark" data-toggle="modal" data-target="#id_reset">Reset Sistem Penjadwalan</a>
            <!--<div class="dropdown-divider"></div>
            <a class="nav-link dropdown-item text-dark" data-toggle="modal" data-target="#id_reset_all">Reset All</a>
          -->
          </div>
        </li>

        <li class="nav-item">
          <a class="nav-link">
            Date :
            <?php 
              $tgl = date("Y-m-d");
              echo $tgl;
            ?>
          </a>
        </li>    
        <li class="nav-item">
          <a class="nav-link">
            Hai...
            <i class="fa fa-fw fa-user"></i><?=$_SESSION['nama_admin'];?><a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#logoutID">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul>
    </div>
  </nav>
  <!--End All Nav-->

  <!--Wrapper ISI Admin-->
  <div class="content-wrapper">

    <!--Isi Content-->
      <?php
          error_reporting(0);

            $page = $_GET['page'];
            if($page){
              include "$page".".php";
            }else{
              include "home_r.php";
            }
      ?>
    <!--container-fluid-->
    
  </div>
  <!--End wrapper-->
  
  <!--Footer-->
  <footer class="sticky-footer">
    <div class="container">
      <div class="text-center">
        <small>Copyright &copy Aljawawi Project 2018</small>
      </div>
    </div>
  </footer>
  <!--End Footer-->

  <!--Scroll Top-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fa fa-angle-up"></i>
  </a>

  
<!--modal Reset-->
  <div class="modal fade" id="id_reset" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Reset Sistem Penjadwalan?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Silahkan pilih reset jika anda ingin mereset sistem penjadwalan.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <form action="php/reset_jadwal_r.php" method="POST">
              <button class="btn btn-primary" type="submit" name="reset">Reset</button> 
            </form>
          </div>
        </div>
      </div>
    </div>    

<!--Logout Modal-->
  <div class="modal fade" id="logoutID" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tinggalkan akun anda?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">x</span>
          </button>
        </div>
        <div class="modal-body">Silahkan pilih logout jika anda ingin keluar dari akun ini.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="php/logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>    
  

  <!-- Kostum Javascript Untuk Semua pages nav scroll-->
  <script src="../js/bs-admin.js"></script>

  <!--</div>-->

</body>

</html>
