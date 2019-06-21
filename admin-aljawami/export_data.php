<?php
include('php/cek-akses.php');
include('../config/koneksi.php');
$kd_jurusan = $_SESSION['kd_jurusan'];
//jum jurusan
$sql1="SELECT * from tb_jurusan WHERE kd_jurusan='$kd_jurusan' ";
$jur=mysqli_query($koneksi,$sql1);
$dt=mysqli_fetch_assoc($jur); 

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
      <a href="index_user.php">Home</a>
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
                <input class="form-control" type="text" name="jurusan" value="<?php echo $dt['jurusan'];?>" readonly>
              </div>
              <div class="col-md-2">
                <label >Semester</label>
               <select class="form-control" name='semester'>
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
              </div>
              <div class="col-md-2">
                <label >Hari</label>
                <select class="form-control" name="hari">
                  <option value="">-- Pilih Hari --</option>
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

  <div class="card-header">Data Seluruh Jadwal Perkuliahan </div>
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
              <th>Jurusan</th>
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
              <th>Jurusan</th>
              <th>Semester</th>
              <th>Kelas</th>
              
          </tfoot>
        
        <tbody>
        
        <?php
        include('../config/koneksi.php');
          $sql = "SELECT * FROM tb_matkul,tb_jadwal,tb_dosen,tb_jurusan 
                  WHERE tb_jurusan.kd_jurusan=tb_jadwal.kd_jurusan AND tb_matkul.kd_matkul=tb_jadwal.kd_matkul AND tb_dosen.id_dosen=tb_jadwal.kd_dosen
                  AND tb_jadwal.kd_jurusan='$kd_jurusan'  
                  ORDER BY jurusan ASC";
          $query = mysqli_query($koneksi,$sql);
          if(mysqli_num_rows($query)==0){  
            //jika data kosong, maka akan menampilkan row kosong
            echo '<tr><td colspan="6">Tidak ada data!</td></tr>';
          }else{ 
            $no = 1;  
            while ($data =mysqli_fetch_assoc($query)){ ?>
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
                <td><?php echo $data['jurusan'];?></td>
                <td><?php echo $data['semester'];?></td>
                <td><?php echo $data['kelas'];?></td>
              </tr>
        <?php 
            $no++;
            }
          }  
        ?>

        </tbody>
      </table>
    </div> 
    
  </div>
</div>
      


</div>


