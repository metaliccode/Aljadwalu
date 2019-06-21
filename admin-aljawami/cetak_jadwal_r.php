<?php
include('php/cek_akses.php');
include('../config/koneksi.php');
?>  
<link rel="stylesheet" type="text/css" href="../datatables/css/jquery.dataTables.css">
<script type="text/javascript" src="../datatables/js/jquery.min.js"></script>
<script type="text/javascript" src="../datatables/js/jquery.dataTables.min.js"></script>


<div class="container-fluid" style="font-size: 14px;">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="index.php">Home</a>
    </li>
    <li class="breadcrumb-item active">Cetak Laporan Jadwal Perkuliahan</li>
  </ol>
  
<div class="card mb-2">
  <div class="card-header"><i class="fa fa-table"></i> 
    Data Laporan Jadwal Perkuliahan
  </div>
      <div class="card-body">
        <form method="POST" action="cetak/cetak_jadwal_jurusan.php" target="_blank">
        <div class="form-group">
            <div class="form-row">
              <div class="col-md-5">
                <label>Jurusan *</label>
                <select name='jurusan' class="form-control" required>
                  <option value='' selected>-- Pilih Jurusan --</option>
                    <?php
                      $sql = "SELECT * FROM tb_jurusan order by id_jurusan asc";
                      $jurusan = mysqli_query($koneksi,$sql);
                      while($hasil = mysqli_fetch_array($jurusan)){
                        echo '<option value="'.$hasil[jurusan].'">'.$hasil[kd_jurusan].' - '.$hasil[jurusan].'</option>';
                      }
                    ?>
                </select>
              </div>
              <div class="col-md-2">
                <label >Semester *</label>
               <select class="form-control" name='semester' required>
                <option value='' selected>--</option>
                <?php
                $bulan_ini=date('n');  
                if($bulan_ini<=6){
                  //echo "Semester GENAP";
                  $genap ="Genap";
                    $sql = "SELECT * FROM tb_semester WHERE ket='$genap' order by id_smt ASC";
                    $semester = mysqli_query($koneksi,$sql);
                    while($hasil = mysqli_fetch_array($semester)){
                      echo '<option value="'.$hasil[semester].'">'.$hasil[semester].'</option>';
                  }
                }else{
                  //echo "Semester GANJIL";
                  $ganjil ="Ganjil";
                    $sql = "SELECT * FROM tb_semester WHERE ket='$ganjil' order by id_smt ASC";
                    $semester = mysqli_query($koneksi,$sql);
                    while($hasil = mysqli_fetch_array($semester)){
                      echo '<option value="'.$hasil[semester].'">'.$hasil[semester].'</option>';
                    }
                }
              ?>
              </select>
              </div>
              <div class="col-md-5">
                <label >Ketua Jurusan Tahun Ini</label>
               <select name='dosen' class="form-control">
                  <option value='' selected>-- Pilih Ketua Jurusan --</option>
                    <?php
                      $sql = "SELECT * FROM tb_dosen order by id_dosen asc";
                      $jurusan = mysqli_query($koneksi,$sql);
                      while($hasil = mysqli_fetch_array($jurusan)){
                        echo '<option value="'.$hasil[id_dosen].'">'.$hasil[dosen].'</option>';
                      }
                    ?>
                </select>
              </div>
            </div>
              <button class="btn btn-primary col-md-2" style="margin-top: 20px; margin-bottom: 0px;" type="submit" name="cetak" value="cetak">Cetak Jadwal</button>
              <br><br>
              <font color="red"><i>* Data harus diisi, tidak boleh kosong</i></font>
              <br>
              <font color="blue">NB : Silahkan isi form ketua jurusan, jika anda ingin menambahkan signature</i></font>  
              <br>  
          </form>
      </div>
</div>


</div>