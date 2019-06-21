<?php
include('php/cek_akses.php');     
include ('../config/koneksi.php');
include('combo-ps-edit.php');

$id=$_GET['id'];
$sql="SELECT * FROM tb_matkul,tb_jadwal,tb_dosen,tb_jurusan 
      WHERE tb_jurusan.kd_jurusan=tb_jadwal.kd_jurusan AND tb_matkul.kd_matkul=tb_jadwal.kd_matkul AND tb_dosen.id_dosen=tb_jadwal.kd_dosen  
      AND id_jadwal='$id' ";
$query=mysqli_query($koneksi,$sql);
$r=mysqli_fetch_assoc($query);  
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
      <a href="index_user.php">Home</a>
    </li>
    <li class="breadcrumb-item active">Data Jadwal Perkuliahan</li>
  </ol>
    
  <div class="card mb-3">
    <div class="card-header"><i class="fa fa-table"></i> Edit Jadwal Perkuliahan</div>
      <div class="card-body">
      <form name="form1" action="php/jadwal/edit_jadwal.php" method="POST">
        <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
        <tbody>
        <input type="hidden" name="id" value="<?php echo $id; ?>">  

<!--end triple combo box -->
        <tr>
          <td>Dosen </td>
          <td class="form-row">
            <div class="col-md-5">
              <select class="form-control" name="dosen">
                <option value="" selected></option>
                  <?php
                    $sql3 = "SELECT * FROM tb_dosen ORDER BY id_dosen ASC";
                    $query3 = mysqli_query($koneksi,$sql3);
                    while ($d3 =mysqli_fetch_array($query3)){
                       echo '<option value="'.$d3['id_dosen'].'" >'.$d3['dosen'].'</option>';   
                    }
                  ?>
              </select>  
            </div>
            <div class="col-md-5">
              <input class="form-control" type="text" disabled value="<?php echo $r['dosen'];?>">
            </div>
          </td>
        </tr>
<!--Jika Ingin Mrngganti Matkul-->
        <tr>
          <td colspan="2"><font color="red"><i>* Kosongkan form data matakuliah, jika anda tidak ingin mengubah Matakuliah !</i>
            </font><br>
            <font color="blue"><i>NB : Anda hanya boleh menukar Matakuliah dengan bobot SKS yang sama !</i></font></td>
        </tr>
        <tr>
          <td width="150px">Jurusan *</td>
          <td class="form-row">
          <div class="col-md-5">
            <select class="form-control" name='jur' onchange='showJurusan()' >
            <option value='' selected>-- Pilih Jurusan --</option>
            <?php
              $sql = "SELECT * FROM tb_jurusan order by id_jurusan asc";
              $jurusan = mysqli_query($koneksi,$sql);
              while($hasil = mysqli_fetch_array($jurusan)){
                echo '<option value="'.$hasil[kd_jurusan].'">'.$hasil[kd_jurusan].' - '.$hasil[jurusan].'</option>';
              }
            ?>
          </select>  
          </div>
          <div class="col-md-5">
            <input class="form-control" type="text" disabled value="<?php echo $r['jurusan'];?>">  
          </div>              
          </td>
        </tr>
        <tr>
          <td>Semester *</td>
          <td class="form-row">
          <div class="col-md-2">
            <select class="form-control" name='smt' onchange='showJurusan()' >
              <option value=''>-Pilih Smt-</option>
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
          <div class="col-md-1">
            <input class="form-control" type="text" disabled value="<?php echo $r['semester'];?>">  
          </div>              
          </td>
        </tr>
        <tr>
          <td>Matakuliah *</td>
          <td>
            <select class="form-control col-md-7" name='mtk' id='mat' >
              <option value=''><?php echo $r['matkul'];?></option>
            </select>    
          </td>
        </tr>
        <tr>
          <td>Kelas *</td>
          <td class="form-row">
            <div class="col-md-2">
              <select class="form-control " name="kelas">
                <option value="" selected>-Pilih Kelas-</option>
                  <?php
                    $sqlkls = "SELECT * FROM tb_kelas ORDER BY kd_kelas ASC";
                    $querykls = mysqli_query($koneksi,$sqlkls);
                    while ($d1 =mysqli_fetch_array($querykls)){
                       echo '<option value="'.$d1['kelas'].'" >'.$d1['kelas'].'</option>';   
                    }
                  ?>
              </select>  
            </div>
            <div class="col-md-1">
              <input class="form-control" type="text" name="kls" readonly value="<?php echo $r['kelas'];?>">    
            </div>
          </td>
        </tr>
<!--END OPTIon triple combobox-->
        <tr>
          <td>Jam Masuk </td>
          <td>
            <input class="form-control col-md-1" type="text" name="waktu1" readonly value="<?php echo date('H:i',strtotime($r['waktu1'])); ?>">  
          </td>
        </tr>
        <tr>
          <td>Jam Keluar </td>
          <td>
            <input class="form-control col-md-1" type="text" name="waktu2" readonly value="<?php echo date('H:i',strtotime($r['waktu2'])); ?>">  
          </td>
        </tr>

      <tr>
          <td>Hari </td>
          <td>
              <input class="form-control col-sm-2" type="text" name="hari" readonly value="<?php echo $r['hari']; ?>">             
          </td>
        </tr>

        <tr>
          <td>Ruang </td>
          <td>
            <input class="form-control col-sm-2" type="text" name="ruang" readonly value="<?php echo $r['kd_ruang']; ?>">     
          </td>
        </tr>

        <tr>
          <td colspan=3>
          <input type="submit" name="tambah" value="Save" class="btn btn-large btn-primary" />&nbsp;&nbsp;&nbsp;
          <input type="reset" name="reset" value="Reset" class="btn btn-large btn-warning" />&nbsp;&nbsp;&nbsp;
          <a href="index_user.php?page=dt_jadwal" class="btn btn-large btn-danger"><i class="fa fa-times"></i> Back</a></td>
        </tr>
        </tbody>
      </table>
     </form>

    </div>
  </div>
</div>  

  
