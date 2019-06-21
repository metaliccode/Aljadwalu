<?php
include('php/cek_akses.php');
include('../config/koneksi.php');

$id = $_SESSION['id_admin'];
$sql="SELECT * FROM tb_admin WHERE id_admin='$id' ";
$query=mysqli_query($koneksi,$sql);
$r=mysqli_fetch_assoc($query); 

?>
   

<!--Content isi-->
<div class="container-fluid">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="index_user.php">Home</a>
    </li>
    <li class="breadcrumb-item active">Ganti Data Akun</li>
  </ol>
    
  <div class="card mb-3">
    <div class="card-header"><i class="fa fa-table"></i> Ganti Password</div>
      <div class="card-body">
      <form action="php/admin_user/edit_user.php" method="POST">
        <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
        <tbody>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="kd_jurusan" value="<?php echo $r['kd_jurusan']; ?>">
        <input type="hidden" name="level" value="<?php echo $r['level']; ?>">
        <!--<input type="hidden" name="ps" value="<?php //echo $r['password']; ?>">-->
        <tr>
          <td width="250px">Nama Lengkap</td>
          <td>
            <input class="form-control col-md-5" name="nama" type="text" value="<?php echo $r['nama_admin']; ?>" required>
          </td>
        </tr>
        
        <tr>
          <td>Username</td>
          <td><input class="form-control col-md-5" name="username" type="text" value="<?php echo $r['username']; ?>" required ></td>
        </tr>
        <!--<tr>
          <td>Password Lama</td>
          <td>
            <input class="form-control col-md-5" name="pass" type="password" placeholder="Enter Password Lama" required >
          </td>
        </tr>
        -->
        <tr>
          <td>Password Baru *</td>
          <td>
            <input class="form-control col-md-5" name="pass1" type="password" placeholder="Enter Password Baru" required>
            &nbsp;<font color="red"><i>*password minimal 6 - 25 karakter</i></font>
          </td>
        </tr>
        <tr>
          <td>Confirm Password *</td>
          <td>
            <input class="form-control col-md-5" name="pass2" type="password" placeholder="Enter Confirm Password" required>
          </td>
        </tr>
        <tr>
          <td colspan=3>
          <input type="submit" name="tambah" value="Save" class="btn btn-large btn-primary" />&nbsp;&nbsp;&nbsp;
          <input type="reset" name="reset" value="Reset" class="btn btn-large btn-warning" />&nbsp;&nbsp;&nbsp;
        </tr>
        </tbody>
      </table>
     </form>

    </div>
  </div>
</div>  

  
