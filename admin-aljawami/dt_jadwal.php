<?php
include('php/cek_akses.php');
include ('../config/koneksi.php');
include('combo-ps.php');
$kd_jurusan = $_SESSION['kd_jurusan'];
?>  

<link rel="stylesheet" type="text/css" href="../datatables/css/jquery.dataTables.css">
<!--<script type="text/javascript" src="../datatables/js/jquery.min.js"></script>
-->
<script type="text/javascript" src="../datatables/js/jquery.dataTables.min.js"></script>
<!--Time pcker-->
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

<div class="container-fluid" style="font-size: 14px;">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="index_user.php">Home</a>
    </li>
    <li class="breadcrumb-item active">Data Jadwal Perkuliahan</li>
  </ol>
  

<div class="card mb-3">
  <div class="card-header"><i class="fa fa-table"></i> 
    SEARCH DATA BY
  </div>
  <div class="card-body">
      <form method="POST" action="<?php echo"?page=j_filter";?>" >
        <div class="form-group">
            <div class="form-row">
                <?php
                  $sql1="SELECT * from tb_jurusan WHERE kd_jurusan='$kd_jurusan' ";
                  $jur=mysqli_query($koneksi,$sql1);
                  $dt=mysqli_fetch_assoc($jur); 
                ?>
                <!--<input class="form-control" type="hidden" name="jurusan" value="<?php echo $dt['kd_jurusan'];?>" readonly>-->
              <div class="col-md-5">
                <label >Jurusan</label>
                <select class="form-control" name='jurusan' required>
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
                <label >&nbsp;</label>
                <button class="btn btn-primary form-control" name="cari_jadwal">Search</button>   
              </div>
            </div>
            
                         
          </div>
      </form>        
  </div>

  <div class="card-header"><i class="fa fa-table"></i> 
    Data Tabel Jadwal Perkuliahan
  </div>
      <div class="card-body">
        <div class="table-responsive">
          <a class="btn btn-primary btn-block col-md-1" href="#tambah_data" data-toggle="modal" style="font-size: 14px;float: left;margin-bottom: 10px;"><i class="fa fa-plus"></i> Tambah</a>


        <!--<table id="dt_tabel" class="display" cellspacing="0" width="100%">
          -->
          <table id="table-sm" class="table table-bordered table-hover table-sm">
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

              <th>Opsi</th>
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
              <th>Opsi</th>
          </tfoot>
        
        <tbody>
        
        <?php
        include('../config/koneksi.php');
        //hitung page               
        $batas = 10;
        $pg = isset($_GET['pg']) ? $_GET['pg']:"";
        if (empty($pg)) {
        $posisi = 0;
        $pg = 1;
        } else {
        $posisi = ($pg-1)*$batas; }


          $sql = "SELECT * FROM tb_matkul,tb_jadwal,tb_dosen,tb_jurusan 
                  WHERE tb_jurusan.kd_jurusan=tb_jadwal.kd_jurusan AND tb_matkul.kd_matkul=tb_jadwal.kd_matkul AND tb_dosen.id_dosen=tb_jadwal.kd_dosen
                  AND tb_jadwal.kd_jurusan='$kd_jurusan'  
                  ORDER BY id_jadwal DESC limit $posisi, $batas";
          $query = mysqli_query($koneksi,$sql);
          if(mysqli_num_rows($query)==0){  
            //jika data kosong, maka akan menampilkan row kosong
            echo '<tr><td colspan="6">Tidak ada data!</td></tr>';
          }else{ 
            $no = 1;  
            while ($data =mysqli_fetch_assoc($query)){ ?>
              <tr>
                <td class="color-blue-grey-lighter" align="center"><?php echo $no;?></td>
                <td align="center"><?php echo $data['hari'];?></td>
                <?php 
                  $waktu1 = date('H:i', strtotime($data['waktu1']));
                  $waktu2 = date('H:i', strtotime($data['waktu2']));
                ?>
                <td><?php echo $waktu1;?> - <?php echo $waktu2;?></td>
                <td><?php echo $data['matkul'];?></td>
                <td align="center"><?php echo $data['sks'];?></td>
                <td><?php echo $data['dosen'];?></td>
                <td align="center"><?php echo $data['kd_ruang'];?></td>
                <td><?php echo $data['jurusan'];?></td>
                <td align="center"><?php echo $data['semester'];?></td>
                <td align="center"><?php echo $data['kelas'];?></td>
                <td ><?php 
                  echo ' <a class="btn btn-danger fa fa-pencil" data-toggle="tooltip" data-placement="bottom" title="Hapus" href="index_user.php?page=f_edit_jadwal&id='.$data['id_jadwal'].'" </a> ';

                  echo ' <a class="btn btn-warning fa fa-trash" data-toggle="tooltip" data-placement="bottom" title="Hapus" href="php/jadwal/hapus_jadwal.php?id='.$data['id_jadwal'].'" onclick="return confirm(\'Apakah Anda Yakin Ingin Mengahapus Data ini?\')"></a> ';
                    ?>
                </td>

              </tr>
        <?php 
            $no++;
            }
          }  
        ?>

        </tbody>
      </table>

      <div class="card-block">
          <div class="col-md-6">
            <?php
            //hitung jumlah data
            $sql1 = "SELECT * FROM tb_jadwal WHERE kd_jurusan='$kd_jurusan' ";
                 $query1 = mysqli_query($koneksi,$sql1);

            $jml_data = mysqli_num_rows($query1);
            //Jumlah halaman
            $JmlHalaman = ceil($jml_data/$batas); //ceil digunakan untuk pembulatan keatas
            ?>
              <span class="label label-success">Info! </span> Total  
              <span class="label label-primary">Jumlah Data = <?php echo $jml_data; ?> </span>
              <span class="label label-primary">Halaman = <?php echo $JmlHalaman; ?> </span>
          </div>
          
          <div class="col-md-6" align="right">
            <nav>
              <ul class="pagination">
                <?php
                //Jumlah halaman
                $JmlHalaman = ceil($jml_data/$batas); //ceil digunakan untuk pembulatan keatas
                  $link=$pg;
                //Navigasi ke sebelumnya
                if ($pg > 1 ) {
                $link = $pg-1;
                $prev = "<li class='page-item'>
                <a class='page-link' href='index_user.php?page=dt_jadwal&pg=$link' aria-label='Previous'>
                <span aria-hidden='true'>&laquo;</span>
                <span class='sr-only'>Previous</span>
                </a></li>";
                } else {
                $prev = "<li class='page-item disabled'>
                <a class='page-link' href='index_user.php?page=dt_jadwal&pg=$link' aria-label='Previous'>
                <span aria-hidden='true'>&laquo;</span>
                <span class='sr-only'>Previous</span>
                </a></li> ";
                }
   
                //Navigasi nomor
                $nmr = '';
                for ($i = 1; $i<= $JmlHalaman; $i++){
                if ($i == $pg){
                $nmr.= "<li class='page-item active'>
                <a class='page-link'>$i<span class='sr-only'>(current)</span></a></li>";
                } else {
                $nmr.= "<li class='page-item'><a class='page-link' href='index_user.php?page=dt_jadwal&pg=$i'>$i</a></li>";
                }
                }
 
                //Navigasi ke selanjutnya
                if ($pg < $JmlHalaman){
                $link = $pg+1;
                $next = "<li class='page-item'>
                <a class='page-link' href='index_user.php?page=dt_jadwal&pg=$link'aria-label='Next'>
                <span aria-hidden='true'>&raquo;</span>
                <span class='sr-only'>Next</span>
                </a></li>";
                } else {
                $next = " <li class='page-item disabled'>
                <a class='page-link' href='index_user.php?page=dt_jadwal&pg=$link'aria-label='Next'>
                <span aria-hidden='true'>&raquo;</span>
                <span class='sr-only'>Next</span>
                </a></li>";
                }
 
                //Tampilkan navigasi
                echo $prev . $nmr . $next;
                ?>
              </ul>
            </nav>
          </div>
        </div><!--.card-block-->




    </div>
  </div>
</div>


<!--tambah-->
<div class="modal fade" id="tambah_data" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header breadcrumb">
          <h5><i class="fa fa-table"> Form Tambah Data Kelas Mahasiswa</i></h5> 
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <div class="modal-body" style="font-size: 16px;" >
          <div>
            <form action="php/jadwal/tambah_jadwal.php" method="POST" id='form_combo' name='form1'>
            <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
            <tbody>

            <tr>
              <td width="200px">Jurusan *</td>
              
              <td>
                <?php
                  $sql1="SELECT * from tb_jurusan WHERE kd_jurusan='$kd_jurusan' ";
                  $jur=mysqli_query($koneksi,$sql1);
                  $dt=mysqli_fetch_assoc($jur); 
                ?>
                <input class="form-control" type="hidden" name="jurusan" onchange='showJurusan()' value="<?php echo $dt['kd_jurusan'];?>" readonly>
                <input class="form-control" type="text" value="<?php echo $dt['kd_jurusan'];?> - <?php echo $dt['jurusan'];?>" readonly>  
              </td>
            </tr>

            <tr>
              <td>Semester *</td>
              <td>
                <select class="form-control" name='semester' onchange='showJurusan()' required>
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
                <select class="form-control" name='matkul' id='mat' required>
                  <option value=''>-- Pilih Mata Kuliah --</option>
                </select>    
              </td>
            </tr>  
    <!--end triple combo box -->
            
            <tr>
              <td>Dosen *</td>
              <td>
                <select class="form-control" name="dosen" required>
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
                <input class="form-control col-md-3" type="text" name="waktu1" id="jam1" required>  
              </td>
            </tr>

            <tr>
              <td>Lama Per SKS * (Menit)</td>
              <td>
                <?php
                  $s="SELECT * from tb_set_sks";
                  $sk=mysqli_query($koneksi,$s);
                  $sks=mysqli_fetch_assoc($sk); 
                ?>
                <input class="form-control col-md-3" name="lama" type="text" value="<?php echo $sks['lama'];?>" readonly>  
              </td>
            </tr>

            <tr>
              <td>Kelas *</td>
              <td>
                <select class="form-control" name="kelas" required>
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
                <select class="form-control" name="hari" required>
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
                <select class="form-control" name="ruang" required>
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
          
          
          </div>
        </div>
            
            <div class="modal-footer">
                &nbsp;&nbsp;
                <input type="submit" name="tambah" value="Save" class="btn btn-large btn-primary" />&nbsp;&nbsp;
                <input type="reset" name="reset" value="Reset" class="btn btn-large btn-warning" />&nbsp;&nbsp; 
                </form>
                <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
            </div>
        </div>
    </div>


</div>


