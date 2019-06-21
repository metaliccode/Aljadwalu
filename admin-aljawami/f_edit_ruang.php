<?php
include('php/cek_akses.php');
include('../config/koneksi.php');

if(isset($_POST['idx'])) {
    $id = $_POST['idx'];    
    $sql="SELECT * FROM tb_ruangan WHERE id_ruang='$id' ";
    $query = mysqli_query($koneksi,$sql);
    $r = mysqli_fetch_assoc($query);
?>
   

<!--Content isi-->
    <form action="php/ruangan/edit_ruang.php" method="POST">
      <div class="table-responsive">
      <table class="table table-bordered table-hover table-striped">
      <tbody>
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <tr>
        <td width="170px">Kode Ruangan</td>
        <td>
          <input class="form-control" name="kd_ruang" type="text" value="<?php echo $r['kd_ruang']; ?>" required>
        </td>
      </tr>
      
      <tr>
        <td>Nama Gedung</td>
        <td><input class="form-control" name="nama_ruang" type="text" value="<?php echo $r['nama_ruang']; ?>" required ></td>
      </tr>

      <tr>
        <td colspan=3>
        <input type="submit" name="tambah" value="Update" class="btn btn-large btn-primary" />&nbsp;&nbsp;&nbsp;
        <input type="reset" name="reset" value="Reset" class="btn btn-large btn-warning" />&nbsp;&nbsp;&nbsp;
      </tr>
      </tbody>
    </table>
   </form>
<?php
}
?>


  
