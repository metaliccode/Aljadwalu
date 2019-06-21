<?php
include('php/cek_akses.php');
include('../config/koneksi.php');

//jum dosen
$sql="SELECT count(id_dosen) as jumd from tb_dosen ";
$jumd=mysqli_query($koneksi,$sql);
$r=mysqli_fetch_assoc($jumd); 
//jum jurusan
$sql1="SELECT count(id_jurusan) as jumj from tb_jurusan ";
$jumj=mysqli_query($koneksi,$sql1);
$r1=mysqli_fetch_assoc($jumj); 
//jum matkul
$sql2="SELECT count(id_matkul) as jummk from tb_matkul ";
$jummk=mysqli_query($koneksi,$sql2);
$r2=mysqli_fetch_assoc($jummk);
//jum matkul
$sql3="SELECT count(id_jadwal) as jumjad from tb_jadwal ";
$jumjad=mysqli_query($koneksi,$sql3);
$r3=mysqli_fetch_assoc($jumjad);
?>
<!--fluid-->
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">Home</a>
        </li>
        <li class="breadcrumb-item active">Selamat Datang Admin Sistem Penjadwalan STAI AL-JAWAMI </li>
        <li class="breadcrumb-item active"><b><?=$_SESSION['status'];?></b></li>
      </ol>

<div class="card mb-3">
  <div class="card-header"><i class="fa fa-table"></i> 
    Spesifikasi Jumlah Data Sistem Penjadwalan STAI Aljawami
  </div>
      <div class="card-body">

<!-- Icon Cards-->
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-graduation-cap"></i>
              </div>
              <div class="mr-5"><?php echo $r['jumd'];?> Data Dosen!</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href=<?php echo"?page=dt_dosen_r";?>>
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-warning o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-table"></i>
              </div>
              <div class="mr-5"><?php echo $r1['jumj'];?> Data Jurusan!</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href=<?php echo"?page=dt_jurusan";?> >
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-success o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-book"></i>
              </div>
              <div class="mr-5"><?php echo $r2['jummk'];?> Data Matakuliah!</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href=<?php echo"?page=dt_matkul_r";?> >
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-danger o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-calendar"></i>
              </div>
              <div class="mr-5"><?php echo $r3['jumjad'];?> Data Jadwal Kuliah!</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href=<?php echo"?page=dt_jadwal_r";?>>
              <span class="float-left">View Details</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
      </div>
<!--end icon card-->
	</div>

    </div>

