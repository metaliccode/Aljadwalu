<?php
include('php/cek-akses.php');
include('../config/koneksi.php');
?>   

<link href="../dt/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="../dt/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
<!--<script src="../dt/js/jquery-1.12.3.min.js"></script>-->
<script src="../dt/js/jquery.dataTables.min.js"></script>
<script src="../dt/js/dataTables.buttons.min.js"></script>
<script src="../dt/js/jszip.min.js"></script>
<script src="../dt/js/pdfmake.min.js"></script>
<script src="../dt/js/vfs_fonts.js"></script>
<script src="../dt/js/buttons.html5.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable( {
        //dom: '<"bottom"i>Bfrtip<"top"flp><"clear">',
        //dom : '<"top"fB>rt<"bottom"pl><"clear">',
        dom : '<"top"Bf>rt<"bottom"lip><"clear">',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    } );
} );
</script>

<div class="container-fluid">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="index.php">Home</a>
    </li>
    <li class="breadcrumb-item active">Export Data Jadwal</li>
  </ol>
  
<div class="card mb-3">
  <div class="card-header"><i class="fa fa-table"></i> 
    SEARCH DATA BY
  </div>
  <div class="card-body">
      <form method="POST" action="<?php echo"?page=ex_perjurusan";?>" >
        <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label>Jurusan</label>
                <select name='jurusan' class="form-control">
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
                <label >Semester</label>
               <select class="form-control" name='semester'>
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
              <div class="col-md-2">
                <label >Hari</label>
                <select class="form-control" name="hari">
                  <option value="" selected>-- Pilih Hari --</option>
                  <option value="Senin">Senin</option>
                  <option value="Selasa">Selasa</option>
                  <option value="Rabu">Rabu</option>
                  <option value="Kamis">Kamis</option>
                  <option value="Jumat">Jumat</option>
                  <option value="Sabtu">Sabtu</option>
                  <option value="Minggu">Minggu</option>
                </select>
              </div>
            </div>
            
              <button class="btn btn-primary col-md-2" style="margin-top: 20px; margin-bottom: 0px;" name="cari">Search</button>

          </div>
      </form>        
  </div>

  <div class="card-header">Hasil Pencarian Jadwal Berdasarkan (Jur/smt/hari) : <?php echo $_POST['jurusan']; ?> / <?php echo $_POST['semester']; ?> / <?php echo $_POST['hari']; ?> 
      <a class="btn btn-danger btn-block col-md-3" href="index.php?page=export_data_r" style="font-size: 14px;float: right;margin-bottom: 0px;"><i class="fa fa-table"></i> View All Data to Export</a>
  </div>
    <div class="card-body">

     <div class="table-responsive">  
        <table id="example" class="display" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>No</th>
              <th>Hari</th>
              <th>Waktu</th>
              <th>Matakuliah</th>
              <th>SKS</th>
              <th>Dosen</th>
              <th>Ruang</th>
              <!--<th>Jurusan</th>-->
              <th>Semester</th>
              <th>Kelas</th>

            </tr>
          </thead>
          <tfoot>
              <th>No</th>
              <th>Hari</th>
              <th>Waktu</th>
              <th>Matakuliah</th>
              <th>SKS</th>
              <th>Dosen</th>
              <th>Ruang</th>
              <!--<th>Jurusan</th>-->
              <th>Semester</th>
              <th>Kelas</th>
              
          </tfoot>
        
        <tbody>
        
<?php
if(isset($_POST['cari'])){
    $jurusan = $_POST['jurusan'];
    $hari       = $_POST['hari'];
    $semester   = $_POST['semester'];

  if ($jurusan){
    if($semester){
      if($hari){
        //echo "ALL";
        $sqljur = "SELECT * FROM tb_jadwal,tb_matkul,tb_dosen,tb_jurusan WHERE 
              tb_matkul.kd_matkul=tb_jadwal.kd_matkul 
          AND tb_dosen.id_dosen=tb_jadwal.kd_dosen 
          AND tb_jurusan.kd_jurusan=tb_jadwal.kd_jurusan
          AND tb_matkul.kd_matkul=tb_jadwal.kd_matkul
          AND jurusan='$jurusan'  
          AND semester='$semester' 
          AND hari='$hari' ORDER BY kelas ASC";
        $queryjur = mysqli_query($koneksi,$sqljur);
        if(mysqli_num_rows($queryjur)==0){  
          //jika data kosong, maka akan menampilkan row kosong
          echo '<tr><td colspan="6">Tidak ada data!</td></tr>';
        }else{ 
          $no = 1;  
          while ($data =mysqli_fetch_assoc($queryjur)){ ?>
            <tr>
              <td><?php echo $no;?></td>
              <td><?php echo $data['hari'];?></td>
              <?php 
                $waktu1 = date('H:i', strtotime($data['waktu1']));
                $waktu2 = date('H:i', strtotime($data['waktu2']));
              ?>
              <td><?php echo $waktu1;?> - <?php echo $waktu2;?></td>
              <td><?php echo $data['matkul'];?></td>
              <td><?php echo $data['sks'];?></td>
              <td><?php echo $data['dosen'];?></td>
              <td><?php echo $data['kd_ruang'];?></td>
              <!--<td><?php echo $data['jurusan'];?></td>-->
              <td><?php echo $data['semester'];?></td>
              <td><?php echo $data['kelas'];?></td>         
            </tr>
        <?php 
          $no++;
          }
        }
      }else{
        //echo "jurusan & Semester";
        $sqljur1 = "SELECT * FROM tb_jadwal,tb_matkul,tb_dosen,tb_jurusan WHERE
            tb_matkul.kd_matkul=tb_jadwal.kd_matkul 
        AND tb_dosen.id_dosen=tb_jadwal.kd_dosen 
        AND tb_jurusan.kd_jurusan=tb_jadwal.kd_jurusan
        AND tb_matkul.kd_matkul=tb_jadwal.kd_matkul 
        AND jurusan='$jurusan' AND semester='$semester' order by waktu1 ASC";
        $queryjur1 = mysqli_query($koneksi,$sqljur1);
        if(mysqli_num_rows($queryjur1)==0){  
          //jika data kosong, maka akan menampilkan row kosong
          echo '<tr><td colspan="6">Tidak ada data!</td></tr>';
        }else{ 
          $no = 1;  
          while ($data =mysqli_fetch_assoc($queryjur1)){ ?>
            <tr>
              <td><?php echo $no;?></td>
              <td><?php echo $data['hari'];?></td>
              <?php 
                $waktu1 = date('H:i', strtotime($data['waktu1']));
                $waktu2 = date('H:i', strtotime($data['waktu2']));
              ?>
              <td><?php echo $waktu1;?> - <?php echo $waktu2;?></td>
              <td><?php echo $data['matkul'];?></td>
              <td><?php echo $data['sks'];?></td>
              <td><?php echo $data['dosen'];?></td>
              <td><?php echo $data['kd_ruang'];?></td>
              <!--<td><?php echo $data['jurusan'];?></td>-->

              <td><?php echo $data['semester'];?></td>
              <td><?php echo $data['kelas'];?></td>          

            </tr>
        <?php 
          $no++;
          }
        }

      }

    }else if($hari){
      //echo "jurusan & hari"; 
      $sqljur = "SELECT * FROM tb_jadwal,tb_matkul,tb_dosen,tb_jurusan WHERE 
          tb_matkul.kd_matkul=tb_jadwal.kd_matkul 
      AND tb_dosen.id_dosen=tb_jadwal.kd_dosen 
      AND tb_jurusan.kd_jurusan=tb_jadwal.kd_jurusan
      AND tb_matkul.kd_matkul=tb_jadwal.kd_matkul
      AND jurusan='$jurusan' AND hari='$hari' ORDER BY kelas ASC";
        $queryjur = mysqli_query($koneksi,$sqljur);
        if(mysqli_num_rows($queryjur)==0){  
          //jika data kosong, maka akan menampilkan row kosong
          echo '<tr><td colspan="6">Tidak ada data!</td></tr>';
        }else{ 
          $no = 1;  
          while ($data =mysqli_fetch_assoc($queryjur)){ ?>
            <tr>
              <td><?php echo $no;?></td>
              <td><?php echo $data['hari'];?></td>
              <?php 
                $waktu1 = date('H:i', strtotime($data['waktu1']));
                $waktu2 = date('H:i', strtotime($data['waktu2']));
              ?>
              <td><?php echo $waktu1;?> - <?php echo $waktu2;?></td>
              <td><?php echo $data['matkul'];?></td>
              <td><?php echo $data['sks'];?></td>
              <td><?php echo $data['dosen'];?></td>
              <td><?php echo $data['kd_ruang'];?></td>
              <!--<td><?php echo $data['jurusan'];?></td>-->

              <td><?php echo $data['semester'];?></td>
              <td><?php echo $data['kelas'];?></td>                    

            </tr>
        <?php 
          $no++;
          }
        }
    }else{
      //echo "jurusan";
      $sqljur = "SELECT * FROM tb_jadwal, tb_matkul,tb_dosen,tb_jurusan WHERE
          tb_matkul.kd_matkul=tb_jadwal.kd_matkul 
      AND tb_dosen.id_dosen=tb_jadwal.kd_dosen 
      AND tb_jurusan.kd_jurusan=tb_jadwal.kd_jurusan
      AND tb_matkul.kd_matkul=tb_jadwal.kd_matkul 
      AND jurusan='$jurusan' order by semester ASC";
      $queryjur = mysqli_query($koneksi,$sqljur);
      if(mysqli_num_rows($queryjur)==0){  
        //jika data kosong, maka akan menampilkan row kosong
        echo '<tr><td colspan="6">Tidak ada data!</td></tr>';
      }else{ 
        $no = 1;  
        while ($data =mysqli_fetch_assoc($queryjur)){ ?>
          <tr>
            <td><?php echo $no;?></td>
            <td><?php echo $data['hari'];?></td>
            <?php 
              $waktu1 = date('H:i', strtotime($data['waktu1']));
              $waktu2 = date('H:i', strtotime($data['waktu2']));
            ?>
            <td><?php echo $waktu1;?> - <?php echo $waktu2;?></td>
            <td><?php echo $data['matkul'];?></td>
            <td><?php echo $data['sks'];?></td>
            <td><?php echo $data['dosen'];?></td>
            <td><?php echo $data['kd_ruang'];?></td>
              <!--<td><?php echo $data['jurusan'];?></td>-->

            <td><?php echo $data['semester'];?></td>
            <td><?php echo $data['kelas'];?></td>                    
          </tr>
      <?php 
        $no++;
        }
      }
    }


  }elseif ($semester) {
    if ($hari) {
      //echo "semester d hari";
      echo "<script>alert('Anda mencari berdasarkan Semester & Hari !');window.location='index.php?page=ex_semester_hari&smt=".$_POST['semester']."&h=".$_POST['hari']." ';</script>";
    }else{
      //echo "semester";
      echo "<script>alert('Anda mencari berdasarkan Semester !');window.location='index.php?page=ex_semester_hari&smt=".$_POST['semester']." ';</script>";
    }
  }else{
      //echo "hari";
      echo "<script>alert('Anda mencari berdasarkan hari !');window.location='index.php?page=ex_semester_hari&h=".$_POST['hari']." ';</script>";
  }

 
}else{
  echo "ERROR";
} 


            
        ?>

        </tbody>
      </table>
    </div> 
   
  </div>
</div>
      


</div>





