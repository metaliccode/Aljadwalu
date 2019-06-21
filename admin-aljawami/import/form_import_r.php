<?php
include('../php/cek_akses_i.php');
?>  

  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>
      #loading{
    background: whitesmoke;
    position: absolute;
    top: 140px;
    left: 82px;
    padding: 5px 10px;
    border: 1px solid #ccc;
  }
  </style>
  
  <!-- Load File jquery.min.js yang ada difolder js -->
  <script src="js/jquery.min.js"></script>
  
  <script>
  $(document).ready(function(){
    // Sembunyikan alert validasi kosong
    $("#kosong").hide();
  });
  </script>


<div class="container-fluid" style="font-size: 14px;">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="../index.php">Home</a>
    </li>
    <li class="breadcrumb-item active">Import Data Mata Kuliah</li>
  </ol>
  
<div class="card mb-3">
  <div class="card-header"><i class="glyphicon glyphicon-table"></i> 
     Form Import Data
  </div>
      <div class="card-body">
        
        <!-- Buat sebuah tag form dan arahkan action nya ke file ini lagi -->
        <form method="post" action="" enctype="multipart/form-data">
          <a href="Format.xlsx" class="btn btn-default">
            <span class="glyphicon glyphicon-download"></span>
            Download Format
          </a><br><br>
          
          <!-- 
          -- Buat sebuah input type file
          -- class pull-left berfungsi agar file input berada di sebelah kiri
          -->
          <input type="file" name="file" class="pull-left">
          
          <button type="submit" name="preview" class="btn btn-success btn-sm">
            <span class="glyphicon glyphicon-eye-open"></span> Preview
          </button>
          <!-- Buat sebuah tombol Cancel untuk kemabli ke halaman awal / view data -->
          <a href="../index.php?page=dt_matkul_r" class="btn btn-danger pull-right">
            <span class="glyphicon glyphicon-remove"></span> Cancel
          </a>
        </form>
        
        <hr>
        
        <!-- Buat Preview Data -->
        <?php
        // Jika user telah mengklik tombol Preview
        if(isset($_POST['preview'])){
          //$ip = ; // Ambil IP Address dari User
          $nama_file_baru = 'data.xlsx';
          
          // Cek apakah terdapat file data.xlsx pada folder tmp
          if(is_file('tmp/'.$nama_file_baru)) // Jika file tersebut ada
            unlink('tmp/'.$nama_file_baru); // Hapus file tersebut
          
          $tipe_file = $_FILES['file']['type']; // Ambil tipe file yang akan diupload
          $tmp_file = $_FILES['file']['tmp_name'];
          
          // Cek apakah file yang diupload adalah file Excel 2007 (.xlsx)
          if($tipe_file == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"){
            // Upload file yang dipilih ke folder tmp
            // dan rename file tersebut menjadi data{ip_address}.xlsx
            // {ip_address} diganti jadi ip address user yang ada di variabel $ip
            // Contoh nama file setelah di rename : data127.0.0.1.xlsx
            move_uploaded_file($tmp_file, 'tmp/'.$nama_file_baru);
            
            // Load librari PHPExcel nya
            require_once 'PHPExcel/PHPExcel.php';
            
            $excelreader = new PHPExcel_Reader_Excel2007();
            $loadexcel = $excelreader->load('tmp/'.$nama_file_baru); // Load file yang tadi diupload ke folder tmp
            $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
            
            // Buat sebuah tag form untuk proses import data ke database
            echo "<form method='post' action='import_r.php'>";
            
            // Buat sebuah div untuk alert validasi kosong
            echo "<div class='alert alert-danger' id='kosong'>
            Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum diisi.
            </div>";
            
            echo "<table class='table table-bordered'>
            <tr>
              <th colspan='5' class='text-center'>Preview Data</th>
            </tr>
            <tr>
              <th>Kode Matakuliah</th>
              <th>Matakuliah</th>
              <th>SKS</th>
              <th>Kode Jurusan</th>
              <th>Semester</th>
              
            </tr>";
            
            $numrow = 1;
            $kosong = 0;
            foreach($sheet as $row){ // Lakukan perulangan dari data yang ada di excel
              // Ambil data pada excel sesuai Kolom
              $kd_matkul = $row['A']; // Ambil data NIS
              $matkul = $row['B']; // Ambil data nama
              $sks = $row['C']; // Ambil data jenis kelamin
              $kd_jurusan = $row['D']; // Ambil data telepon
              $semester = $row['E']; // Ambil data semester
              
              // Cek jika semua data tidak diisi
              if(empty($kd_matkul) && empty($matkul) && empty($sks) && empty($kd_jurusan) && empty($semester))
                continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
              
              // Cek $numrow apakah lebih dari 1
              // Artinya karena baris pertama adalah nama-nama kolom
              // Jadi dilewat saja, tidak usah diimport
              if($numrow > 1){
                // Validasi apakah semua data telah diisi
                $kd_matkul_td = ( ! empty($kd_matkul))? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah
                $matkul_td = ( ! empty($matkul))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
                $sks_td = ( ! empty($sks))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
                $kd_jurusan_td = ( ! empty($kd_jurusan))? "" : " style='background: #E07171;'"; // Jika Telepon kosong, beri warna merah
                $semester_td = ( ! empty($semester))? "" : " style='background: #E07171;'"; // Jika semester kosong, beri warna merah
                
                // Jika salah satu data ada yang kosong
                if(empty($kd_matkul) or empty($matkul) or empty($sks) or empty($kd_jurusan) or empty($semester) ){
                  $kosong++; // Tambah 1 variabel $kosong
                }
                
                echo "<tr>";
                echo "<td".$kd_matkul_td.">".$kd_matkul."</td>";
                echo "<td".$matkul_td.">".$matkul."</td>";
                echo "<td".$sks_td.">".$sks."</td>";
                echo "<td".$kd_jurusan_td.">".$kd_jurusan."</td>";
                echo "<td".$semester_td.">".$semester."</td>";
                echo "</tr>";
              }
              
              $numrow++; // Tambah 1 setiap kali looping
            }
            
            echo "</table>";
            
            // Cek apakah variabel kosong lebih dari 0
            // Jika lebih dari 0, berarti ada data yang masih kosong
            if($kosong > 0){
            ?>  
              <script>
              $(document).ready(function(){
                // Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
                $("#jumlah_kosong").html('<?php echo $kosong; ?>');
                
                $("#kosong").show(); // Munculkan alert validasi kosong
              });
              </script>
            <?php
            }else{ // Jika semua data sudah diisi
              echo "<hr>";
              
              // Buat sebuah tombol untuk mengimport data ke database
              echo "<button type='submit' name='import' class='btn btn-primary'><span class='glyphicon glyphicon-upload'></span> Import</button>";
            }
            
            echo "</form>";
          }else{ // Jika file yang diupload bukan File Excel 2007 (.xlsx)
            // Munculkan pesan validasi
            echo "<div class='alert alert-danger'>
            Hanya File Excel 2007 (.xlsx) yang diperbolehkan
            </div>";
          }
        }
        ?>



      </div>
    </div>
  </div>


</div>


