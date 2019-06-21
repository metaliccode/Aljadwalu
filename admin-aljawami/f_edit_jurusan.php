<?php
include('php/cek_akses.php');
include('../config/koneksi.php');

if(isset($_POST['idx'])) {
    $id = $_POST['idx'];    
    $sql="SELECT * FROM tb_jurusan WHERE id_jurusan='$id' ";
    $query = mysqli_query($koneksi,$sql);
    $r = mysqli_fetch_assoc($query);
?>
   
<!--Content isi-->
      <form action="php/jurusan/edit_jurusan.php" method="POST">
        <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
        <tbody>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <tr>
          <td width="170px">Kode Jurusan</td>
          <td>
            <input class="form-control col-md-5" name="kd_jurusan" type="text" value="<?php echo $r['kd_jurusan']; ?>" required>
          </td>
        </tr>
        
        <tr>
          <td>Nama Jurusan</td>
          <td><input class="form-control col-md-5" name="nama_jurusan" type="text" value="<?php echo $r['jurusan']; ?>" required ></td>
        </tr>

        <tr>
          <td colspan=3>
          <input type="submit" name="tambah" value="Save" class="btn btn-large btn-primary" />&nbsp;&nbsp;&nbsp;
          <input type="reset" name="reset" value="Reset" class="btn btn-large btn-warning" />&nbsp;&nbsp;&nbsp;
        </tr>
        </tbody>
      </table>
     </form>
<?php 
}
?>    


  
