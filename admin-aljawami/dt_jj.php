<?php
include('php/cek_akses.php');
include ('../config/koneksi.php');
include('combo-ps.php');
$kd_jurusan = $_SESSION['kd_jurusan'];
?>  

<link rel="stylesheet" type="text/css" href="../datatables/css/jquery.dataTables.css">
<script type="text/javascript" src="../datatables/js/jquery.min.js"></script>

<script type="text/javascript" src="../datatables/js/jquery.dataTables.min.js"></script>
<!--Time pcker-->
<link rel="stylesheet" href="../vendor/timepicker/css/jquery-ui.css" type="text/css" />
<link rel="stylesheet" href="../vendor/timepicker/css/jquery.ui.timepicker.css?v=0.3.3" type="text/css" />
<script type="text/javascript" src="../vendor/timepicker/js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="../vendor/timepicker/js/jquery-ui.js"></script> 
<script type="text/javascript" src="../vendor/timepicker/js/jquery.ui.timepicker.js?v=0.3.3"></script>


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
                <input class="form-control" type="hidden" name="jurusan" value="<?php echo $dt['kd_jurusan'];?>" readonly>
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
          <a class="btn btn-warning btn-block col-md-2" href="#set_sks" data-toggle="modal" style="font-size: 14px;float: right;margin-bottom: 20px;"><i class="fa fa-hourglass-half"></i> Set Lama SKS</a>


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
                  echo " <a href='#edit_modal' class='btn btn-danger fa fa-pencil' data-toggle='modal' data-placement='bottom' title='Edit' data-id=".$data['id_jadwal']."></a>";
                  
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


<!--Edit-->
<div class="modal fade" id="edit_modal" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header breadcrumb">
                <h5><i class="fa fa-table"> Edit Form Data Jadwal</i></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>                    
            </div>
            <div class="modal-body">
                <div class="hasil-data"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
            </div>
        </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#edit_modal').on('show.bs.modal', function (e) {
            var idx = $(e.relatedTarget).data('id');
            
            $.ajax({
                type : 'post',
                url : 'tambah_j.php',
                data :  'idx='+ idx,
                success : function(data){
                $('.hasil-data').html(data);
                }
            });
         });
    });
  </script>

</div>


