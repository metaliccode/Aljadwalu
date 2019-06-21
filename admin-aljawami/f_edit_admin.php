<?php
include('php/cek_akses.php');
include('../config/koneksi.php');

if(isset($_POST['idx'])) {
  $id = $_POST['idx'];
  $sql="SELECT * FROM tb_admin,tb_jurusan WHERE tb_admin.kd_jurusan=tb_jurusan.kd_jurusan 
  AND id_admin='$id' ";
  $query=mysqli_query($koneksi,$sql);
  $r=mysqli_fetch_assoc($query);  
?>
   

<!--Content isi-->
      <form action="php/admin_user/edit_user.php" method="POST">
        <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
        <tbody>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <!--<input type="hidden" name="ps" value="<?php //echo $r['password']; ?>">-->
        <tr>
          <td width="250px">Nama Lengkap</td>
          <td>
            <input class="form-control" name="nama" type="text" value="<?php echo $r['nama_admin']; ?>" required>
          </td>
        </tr>
        
        <tr>
          <td>Username</td>
          <td><input class="form-control" name="username" type="text" value="<?php echo $r['username']; ?>" required ></td>
        </tr>
        <tr>
          <td>Admin Jurusan</td>
          <td>
            <select class="form-control" name='kd_jurusan'>
            <option value='<?php echo $r['kd_jurusan']; ?>' selected><?php echo $r['kd_jurusan']; ?> - <?php echo $r['jurusan']; ?></option>
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
          <td>Password Baru</td>
          <td>
            <input class="form-control" name="pass1" type="password" placeholder="Enter Password Baru" required >&nbsp;<font color="red"><i>*password minimal 6 - 25 karakter</i></font>
          </td>
        </tr>
        <tr>
          <td>Confirm Password</td>
          <td>
            <input class="form-control" name="pass2" type="password" placeholder="Enter Confirm Password" required >
          </td>
        </tr>
        <tr>
          <td>Level</td>
          <td>
            <select class="form-control" name='level'>
            <option value='<?php echo $r['level']; ?>' selected><?php echo $r['level']; ?></option>
              <option value="Root">Root</option>
              <option value="User">User</option>
            </select>
          </td>
        </tr>
        <tr>
          <td colspan=3>
          <input type="submit" name="tambah" value="Update" class="btn btn-large btn-primary" />&nbsp;&nbsp;&nbsp;
          <input type="reset" name="reset" value="Reset" class="btn btn-large btn-warning" />&nbsp;&nbsp;&nbsp;
          <a href="index.php?page=dt_admin" class="btn btn-large btn-danger"><i class="fa fa-times"></i> Back</a></td>
        </tr>
        </tbody>
      </table>
     </form>

<?php 
}
?>    
