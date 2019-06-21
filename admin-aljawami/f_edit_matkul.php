<?php
include('php/cek_akses.php');
include('../config/koneksi.php');
if(isset($_POST['idx'])) {
    $id = $_POST['idx'];    
    $sql="SELECT * FROM tb_matkul,tb_jurusan WHERE tb_jurusan.kd_jurusan=tb_matkul.kd_jurusan AND id_matkul='$id' ";
    $query = mysqli_query($koneksi,$sql);
    $r = mysqli_fetch_assoc($query);
?>
   

<!--Content isi-->
      <form action="php/matakuliah/edit_matkul.php" method="POST">
        <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
        <tbody>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <tr>
          <td width="250px">Kode Matakuliah *</td>
          <td>
            <input class="form-control" name="kd_matkul" type="text" value="<?php echo $r['kd_matkul']; ?>" required>
          </td>
        </tr>
        
        <tr>
          <td>Nama Matakuliah *</td>
          <td><input class="form-control" name="nama_matkul" type="text" value="<?php echo $r['matkul']; ?>" required></td>
        </tr>
        <tr>
          <td>Jurusan</td>
            <td>
                <?php
                  $kd_jurusan = $_SESSION['kd_jurusan'];
                  $sql1="SELECT * from tb_jurusan WHERE kd_jurusan='$kd_jurusan' ";
                  $jur=mysqli_query($koneksi,$sql1);
                  $dt=mysqli_fetch_assoc($jur); 
                ?>
                <input class="form-control" type="hidden" name="jurusan" value="<?php echo $dt['kd_jurusan'];?>" readonly>
                <input class="form-control" type="text" value="<?php echo $dt['kd_jurusan'];?> - <?php echo $dt['jurusan'];?>" readonly>  
            </td>
        </tr>
        <tr>
          <td>SKS *</td>
          <td>
            <!--<input class="form-control col-md-5" name="sks" type="text" value="<?php //echo $r['sks']?>">
            -->
            <select class="form-control" name="sks">
              <option value="<?php echo $r['sks'];?>"><?php echo $r['sks'];?></option>
              <option value=0>0</option>
              <option value=2>2</option>
              <option value=3>3</option>
              <option value=4>4</option>
            </select>
          </td>
        </tr>
        <tr>
          <td>Semester *</td>
          <td>
           <!-- <input class="form-control col-md-5" name="no_hp" type="text" value="<?php //echo $r['semester']?>">
          -->
          <select class="form-control" name="semester" required>
              <option value="<?php echo $r['semester'];?>"><?php echo $r['semester'];?></option>
              <option value=1>1</option>
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
              &nbsp;&nbsp;
              <input type="submit" name="tambah" value="Update" class="btn btn-large btn-primary" />&nbsp;&nbsp;
              <input type="reset" name="reset" value="Reset" class="btn btn-large btn-warning" />&nbsp;&nbsp;
          </td>
        </tr>
        </tbody>
      </table>
     </form>

<?php
}
?>
  
