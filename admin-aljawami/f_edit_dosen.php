<?php
include('php/cek_akses.php');
include('../config/koneksi.php');

if(isset($_POST['idx'])) {
  $id = $_POST['idx'];
  //$sql="SELECT * FROM tb_dosen WHERE id_dosen='$id' ";
  $sql="SELECT * FROM tb_dosen,tb_jurusan WHERE tb_dosen.kd_jurusan=tb_jurusan.kd_jurusan 
  AND id_dosen='$id' ";
  $query=mysqli_query($koneksi,$sql);
  $r=mysqli_fetch_assoc($query);  
?>

   

<!--Content isi-->
      <form action="php/dosen/edit_dosen.php" method="POST">
        <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
        <tbody>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <tr>
          <td width="250px">NIP *</td>
          <td>
            <input class="form-control" name="nip" type="text" value="<?php echo $r['nip']; ?>" required>
          </td>
        </tr>
        
        <tr>
          <td>Nama Dosen *</td>
          <td><input class="form-control" name="nama_dosen" type="text" value="<?php echo $r['dosen']; ?>" required ></td>
        </tr>
        <tr>
          <td>Dosen Prodi *</td>
          <td>
            <select class="form-control" name="kd_jurusan">
              <option value="<?php echo $r['kd_jurusan'];?>"><?php echo $r['kd_jurusan'];?> - <?php echo $r['jurusan'];?></option>
              <?php
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
          <td>E-mail</td>
          <td>
            <input class="form-control" name="email" type="email" value="<?php echo $r['email']?>">
          </td>
        </tr>
        <tr>
          <td>No HP</td>
          <td>
            <input class="form-control" name="no_hp" type="text" value="<?php echo $r['no_hp']?>">
          </td>
        </tr>
        <tr>
          <td colspan=3>
          <font color="red"><i>* Data tidak boleh kosong, harus diisi !</i></font>
          </br><br>
            &nbsp;&nbsp;
          <input type="submit" name="tambah" value="Update" class="btn btn-large btn-primary" />&nbsp;&nbsp;&nbsp;
          <input type="reset" name="reset" value="Reset" class="btn btn-large btn-warning" />&nbsp;&nbsp;&nbsp;
          </td>
        </tr>
        </tbody>
      </table>
     </form>

<?php
}
?>

  
