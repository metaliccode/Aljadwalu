<?php
include('php/cek_akses.php');     
include ('../config/koneksi.php');
include('combo-ps.php');
?>


<link rel="stylesheet" href="../vendor/timepicker/css/jquery-ui.css" type="text/css" />
<link rel="stylesheet" href="../vendor/timepicker/css/jquery.ui.timepicker.css?v=0.3.3" type="text/css" />
<script type="text/javascript" src="../vendor/timepicker/js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="../vendor/timepicker/js/jquery-ui.js"></script> 
<script type="text/javascript" src="../vendor/timepicker/js/jquery.ui.timepicker.js?v=0.3.3"></script>
<script type="text/javascript">
  $(document).ready(function() {
      $('#jam1').timepicker({
          showPeriodLabels: false
      });
    });
</script>
<!--Content isi-->
<div class="container-fluid">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="index.php">Home</a>
    </li>
    <li class="breadcrumb-item active">Data Jadwal Perkuliahan</li>
  </ol>
    
  <div class="card mb-3">
    <div class="card-header"><i class="fa fa-table"></i> Form Data Jadwal Perkuliahan</div>
      <div class="card-body">
      <form action="php/jadwal/tambah_jadwal.php" method="POST" id='form_combo' name='form1'>
        <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
        <tbody>

        <tr>
          <td width="200px">Jurusan *</td>
          <td>
          <select class="form-control col-md-5" name='jurusan' onchange='showJurusan()' required>
            <option value='' selected>-- Pilih Jurusan --</option>
            <?php
              $sql = "SELECT * FROM tb_jurusan order by id_jurusan asc";
              $jurusan = mysqli_query($koneksi,$sql);
              while($hasil = mysqli_fetch_array($jurusan)){
                echo '<option value="'.$hasil[kd_jurusan].'">'.$hasil[kd_jurusan].' - '.$hasil[jurusan].'</option>';
              }
            ?>
          </select>  
          </td>
        </tr>

        <tr>
          <td>Semester *</td>
          <td>
            <select class="form-control col-md-1" name='semester' onchange='showJurusan()' required>
              <option value=''>--</option>
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
          </td>
        </tr>

        <tr>
          <td>Matakuliah *</td>
          <td>
            <select class="form-control col-md-7" name='matkul' id='mat' required>
              <option value=''>-- Pilih Mata Kuliah --</option>
            </select>    
          </td>
        </tr>  
<!--end triple combo box -->
        
        <tr>
          <td>Dosen *</td>
          <td>
            <select class="form-control col-md-5" name="dosen" required>
            <option value="" selected>-- Pilih Dosen --</option>
              <?php
                $sql3 = "SELECT * FROM tb_dosen ORDER BY id_dosen ASC";
                $query3 = mysqli_query($koneksi,$sql3);
                while ($d3 =mysqli_fetch_array($query3)){
                   echo '<option value="'.$d3['id_dosen'].'" >'.$d3['dosen'].'</option>';   
                }
              ?>
          </select>
          </td>
        </tr>
         <tr>
          <td>Jam Masuk *</td>
          <td>
            <input class="form-control col-md-1" type="text" name="waktu1" id="jam1" required>  
          </td>
        </tr>

        <tr>
          <td>Lama Per SKS * (Menit)</td>
          <td>
            <input class="form-control col-md-1" name="lama" type="text" required>
          </td>
        </tr>

        <tr>
          <td>Kelas *</td>
          <td>
            <select class="form-control col-md-2" name="kelas" required>
            <option value="" selected>-- Pilih Kelas --</option>
              <?php
                $sqlkls = "SELECT * FROM tb_kelas ORDER BY kd_kelas ASC";
                $querykls = mysqli_query($koneksi,$sqlkls);
                while ($d1 =mysqli_fetch_array($querykls)){
                   echo '<option value="'.$d1['kelas'].'" >'.$d1['kelas'].'</option>';   
                }
              ?>
          </select>
          </td>
        </tr>

        <tr>
          <td>Hari *</td>
          <td>
            <select class="form-control col-sm-3" name="hari" required>
              <option value="">-- Pilih Hari --</option>
              <option value="Senin">Senin</option>
              <option value="Selasa">Selasa</option>
              <option value="Rabu">Rabu</option>
              <option value="Kamis">Kamis</option>
              <option value="Jumat">Jumat</option>
              <option value="Sabtu">Sabtu</option>
              <option value="Minggu">Minggu</option>
            </select>
          </td>
        </tr>

        <tr>
          <td>Ruang *</td>
          <td>
            <select class="form-control col-md-5" name="ruang" required>
            <option value="" selected>-- Pilih Ruangan --</option>
              <?php
                $sql2 = "SELECT * FROM tb_ruangan ORDER BY id_ruang ASC";
                $query2 = mysqli_query($koneksi,$sql2);
                while ($d1 =mysqli_fetch_array($query2)){
                   echo '<option value="'.$d1['kd_ruang'].'" >'.$d1['kd_ruang'].' - '.$d1['nama_ruang'].'</option>';   
                }
              ?>
          </select>
          </td>
        </tr>

        </tbody>
      </table>
    <font color="red"><i>* Data tidak boleh kosong, harus diisi !</i></font>
    </br><br>
      &nbsp;&nbsp;
      <input type="submit" name="tambah" value="Save" class="btn btn-large btn-primary" />&nbsp;&nbsp;
      <input type="reset" name="reset" value="Reset" class="btn btn-large btn-warning" />&nbsp;&nbsp;
      <a href="index.php?page=dt_jadwal" class="btn btn-large btn-danger"><i class="fa fa-table"></i> View Data Jadwal Kuliah</a>

     </form>

    </div>
  </div>
</div>  
