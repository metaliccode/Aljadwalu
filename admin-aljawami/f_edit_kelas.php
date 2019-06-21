<?php
include('php/cek_akses.php');
include('../config/koneksi.php');
if(isset($_POST['idx'])) {
    $id = $_POST['idx'];    
    $sql = "SELECT * FROM tb_kelas WHERE id_kelas='$id' ";
    $query = mysqli_query($koneksi,$sql);
    $r = mysqli_fetch_assoc($query);
?>
   
<!--Content isi-->
      <form action="php/kelas/edit_kelas.php" method="POST">
        <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
        <tbody>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <tr>
          <td width="170px">Kode Kelas</td>
          <td>
            <input class="form-control" name="kd_kelas" type="text" value="<?php echo $r['kd_kelas']; ?>" required>
          </td>
        </tr>
        
        <tr>
          <td>Kelas</td>
          <td><input class="form-control" name="kelas" type="text" value="<?php echo $r['kelas']; ?>" required ></td>
        </tr>

        <tr>
          <td colspan=3>
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

  
