
<?php
include('php/cek_akses.php');
?>  
<link rel="stylesheet" type="text/css" href="../datatables/css/jquery.dataTables.css">
<script type="text/javascript" src="../datatables/js/jquery.min.js"></script>
<script type="text/javascript" src="../datatables/js/jquery.dataTables.min.js"></script>


<div class="container-fluid" style="font-size: 14px;">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="index.php">Home</a>
    </li>
    <li class="breadcrumb-item active">Data Matakuliah</li>
  </ol>
  
<div class="card mb-3">
  <div class="card-header"><i class="fa fa-table"></i> 
    Data Tabel Matakuliah 
  </div>
      <div class="card-body">
        <div class="table-responsive">
          <a class="btn btn-primary btn-block col-md-1" href="#tambah_data" data-toggle="modal" style="font-size: 14px;float: left;margin-bottom: 10px;"><i class="fa fa-plus"></i> Tambah</a>
          <a class="btn btn-primary btn-block col-md-1" href="import/form_import_r.php" style="font-size: 14px;float: right;margin-bottom: 20px;"><i class="fa fa-upload"></i> Import</a>
        <table id="dt_tabel" class="display" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>No</th>
              <th>Kode Matkul</th>
              <th>Matakuliah</th>
              <th>SKS</th>
              <th>Jurusan</th>
              <th>Semester</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tfoot>
              <th>No</th>
              <th>Kode Matkul</th>
              <th>Matakuliah</th>
              <th>SKS</th>
              <th>Jurusan</th>
              <th>Semester</th>
              <th>Opsi</th>
          </tfoot>
        
        <tbody>
        
        <?php
        include('../config/koneksi.php');
          $kd_jurusan = $_SESSION['kd_jurusan'];
          $sql = "SELECT * FROM tb_jurusan,tb_matkul WHERE 
            tb_jurusan.kd_jurusan=tb_matkul.kd_jurusan ORDER BY id_matkul DESC";
          $query = mysqli_query($koneksi,$sql);
          if(mysqli_num_rows($query)==0){  
            //jika data kosong, maka akan menampilkan row kosong
            echo '<tr><td colspan="6">Tidak ada data!</td></tr>';
          }else{ 
            $no = 1;  
            while ($data =mysqli_fetch_assoc($query)){ ?>
              <tr>
                <td><?php echo $no;?></td>
                <td><?php echo $data['kd_matkul'];?></td>
                <td><?php echo $data['matkul'];?></td>
                <td><?php echo $data['sks'];?></td>
                <td><?php echo $data['jurusan'];?></td>
                <td><?php echo $data['semester'];?></td>
                <td><?php 
                  echo " <a href='#edit_modal' class='btn btn-danger fa fa-pencil' data-toggle='modal' data-placement='bottom' title='Edit' data-id=".$data['id_matkul']."></a>";
                  
                  echo ' <a class="btn btn-warning fa fa-trash" data-toggle="tooltip" data-placement="bottom" title="Hapus" href="php/matakuliah/hapus_matkul.php?id='.$data['id_matkul'].'" onclick="return confirm(\'Apakah Anda Yakin Ingin Mengahapus Data ini?\')"></a> ';
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

      <script>
        $(document).ready(function() {
        $('#dt_tabel').DataTable();
        });
      </script>

    </div>
  </div>
</div>

<!--Edit-->
    <div class="modal fade" id="edit_modal" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header breadcrumb">
                    <h5><i class="fa fa-table"> Form Edit Data Matakuliah Jurusan</i></h5>
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

<!--tambah-->
<div class="modal fade" id="tambah_data" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header breadcrumb">
          <h5><i class="fa fa-table"> Form Tambah Data Matakuliah Jurusan</i></h5> 
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <div class="modal-body" style="font-size: 16px;" >
          <div>
          <form action="php/matakuliah/tambah_matkul.php" method="POST">
            <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
            <tbody>
            <tr>
              <td width="170px">Kode Matakuliah *</td>
              <td>
                <input class="form-control" name="kd_matkul" type="text" placeholder="Enter Kode Matakuliah" required>
              </td>
            </tr>
            
            <tr>
              <td>Nama Matakuliah *</td>
              <td><input class="form-control" name="nama_matkul" type="text" placeholder="Enter Nama Matakuliah" required ></td>
            </tr>
            <tr>
              <td>Jurusan *</td>
              <td>
              <select class="form-control" name="jurusan" required>
                <option value="" selected>-- Pilih Jurusan --</option>
                  <?php
                  include ('../config/koneksi.php');
                    $sql = "SELECT * FROM tb_jurusan ORDER BY id_jurusan DESC";
                    $query = mysqli_query($koneksi,$sql);
                    while ($data =mysqli_fetch_array($query)){
                       echo '<option value="'.$data['kd_jurusan'].'" >'.$data['kd_jurusan'].' - '.$data['jurusan'].'</option>';   
                    }
                  ?>
              </select>  
              </td>
            </tr>
            <tr>
              <td>SKS *</td>
              <td>
                <select class="form-control" name="sks" required>
                  <option value=0 selected>0</option>
                  <option value=2>2</option>
                  <option value=3>3</option>
                  <option value=4>4</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>Semester *</td>
              <td>
                <select class="form-control" name="semester" required>
                  <option value=1 selected>1</option>
                  <option value=2>2</option>
                  <option value=3>3</option>
                  <option value=4>4</option>
                  <option value=5>5</option>
                  <option value=6>6</option>
                  <option value=7>7</option>
                  <option value=8>8</option>
                </select>
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <font color="red"><i>* Data tidak boleh kosong, harus diisi !</i></font>
                </br>
                 
              </td>
            </tr>
          </tbody>
        </table>
      </br>
          
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

<script type="text/javascript">
    $(document).ready(function(){
        $('#edit_modal').on('show.bs.modal', function (e) {
            var idx = $(e.relatedTarget).data('id');
            
            $.ajax({
                type : 'post',
                url : 'f_edit_matkul_r.php',
                data :  'idx='+ idx,
                success : function(data){
                $('.hasil-data').html(data);
                }
            });
         });
    });
  </script>


</div>


