<?php
include('php/cek_akses.php');
include('../config/koneksi.php');

$id = 1;
$sql="SELECT * FROM tb_set_sks WHERE id_sks='$id' ";
$query=mysqli_query($koneksi,$sql);
$r=mysqli_fetch_assoc($query); 

?>
   
<div class="container-fluid" style="font-size: 14px;">
  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="index.php">Home</a>
    </li>
    <li class="breadcrumb-item active">Ubah data set waktu lama perSKS</li>
  </ol>
  
  <div class="card mb-3">
    <div class="card-header"><i class="fa fa-hourglass-half"></i> Set Lama Waktu PerSKS (*Menit) </div>
      <div class="card-body">
      <form action="php/set_sks/edit_sks.php" method="POST">
        <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
        <tbody>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <tr>
          <td width="200px">Lama Waktu Kuliah PerSKS</td>
          <td class="form-row">
            <input class="form-control col-md-3" name="lama" type="text" value="<?php echo $r['lama']; ?>" required>
            <i> &nbsp;&nbsp;Menit/SKS</i>
          </td>
        </tr>
        
        <tr>
          <td colspan=2>
          <input type="submit" name="tambah" value="Save" class="btn btn-large btn-primary" />&nbsp;&nbsp;&nbsp;
          <input type="reset" name="reset" value="Reset" class="btn btn-large btn-warning" />&nbsp;&nbsp;&nbsp;
          </td>
        </tr>
        </tbody>
      </table>
     </form>

    </div>
  </div>
</div>  

  
