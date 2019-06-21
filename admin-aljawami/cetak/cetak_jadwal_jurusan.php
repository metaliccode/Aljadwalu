<?php 

  include('../../config/koneksi.php');
  $jurusan  = $_POST['jurusan'];
  $semester = $_POST['semester'];
  $id_dosen = $_POST['dosen'];
  
  //$id=$_GET['id'];
  $sql9="SELECT * FROM tb_dosen WHERE id_dosen='$id_dosen' ";
  $query9=mysqli_query($koneksi,$sql9);
  $r9=mysqli_fetch_assoc($query9); 

  $date = date('Y');
  $date1 = $date - 1;
  $bulan_ini=date('n');  
  if($bulan_ini<=6){
    $bln ="Genap";
  }else{
    //echo "Semester GANJIL";
    $bln ="Ganjil";
  }

?>
<link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<body oncontextmenu="return false()" onload="window.print()" style="border: 0px solid black;">
	<div class="row">
		<div class="col-lg-12">
			<table align="center">
				<tbody>
					<tr>
					<td>
						<div style="padding-top: 0px;">
						  <center>
  							<b>Jadwal Matakuliah Semester <?php echo $bln; ?></b><br>
                <b>STAI Yapata Al-Jawami</b><br>
  							<b>Prodi <?php echo $jurusan; ?> </b><br>
  							<b>Tahun Akademik <?php echo $date1;?>/<?php echo $date;?></b><br>
  						</center>
						</div>
					</td>
					</tr>
				</tbody>
			</table>
			<hr style="border: 0; border-top: 1px solid #000000;">
		</div>

		<div class="col-lg-12">
		
		<table border=1 width="100%" cellpadding="3">
          <thead class="table-warning">
            <tr>
              <th colspan="7"><center>SEMESTER <?php echo $semester;?></center></center></th>
            </tr>
            <tr>
              <th><center>HARI</center></th>
              <th width="100px"><center>WAKTU</center></th>
              <th ><center>MATAKULIAH</center></th>
              <th><center>SKS</center></th>
              <th width="240px"><center>DOSEN</center></th>
              <th><center>RUANG</center></th>
              <th><center>KELAS</center></th>
            </tr>
          </thead>        
        <tbody>
        
        <?php        
        $sqlsen = "SELECT * FROM tb_jadwal,tb_matkul,tb_dosen,tb_jurusan WHERE 
              tb_matkul.kd_matkul=tb_jadwal.kd_matkul 
          AND tb_dosen.id_dosen=tb_jadwal.kd_dosen 
          AND tb_jurusan.kd_jurusan=tb_jadwal.kd_jurusan
          AND tb_matkul.kd_matkul=tb_jadwal.kd_matkul 
        AND jurusan='$jurusan' AND semester='$semester' AND hari='Senin' ORDER BY waktu1 ASC";
        $pssen = mysqli_query($koneksi,$sqlsen);
        if(mysqli_num_rows($pssen)==0){  
            //jika data kosong, maka akan menampilkan row kosong
            //echo '<tr><td colspan="6">Hari Tidak ada data!</td></tr>';
        }else{
            $i=0; 
            while($datasen=mysqli_fetch_assoc($pssen)){
              $row1[$i]=$datasen;
              $i++;
            }

            foreach($row1 as $cell1){
              if(isset($total1[$cell1['hari']]['jml'])) { 
                $total1[$cell1['hari']]['jml']++; 
              }else{
                $total1[$cell1['hari']]['jml']=1; 
              } 
            }

            $n1=count($row1);
            $cekhari1="";
            for($i=0;$i<$n1;$i++){
              $cell1=$row1[$i];
              echo '<tr>';
              if($cekhari1!=$cell1['hari']){
                echo '<td' .($total1[$cell1['hari']]['jml']>1?' rowspan="' .($total1[$cell1['hari']]['jml']).'">':'>') .$cell1['hari'].'</td>';
                $cekhari1=$cell1['hari'];
              }

              $waktu1= date('H:i',strtotime($cell1['waktu1'])); 
              $waktu2= date('H:i',strtotime($cell1['waktu2']));
              echo "
                <td>
                  ".$waktu1." - ".$waktu2."
                </td>                
                <td>$cell1[matkul]</td>
                <td><center>$cell1[sks]</center></td>
                <td>$cell1[dosen]</td>
                <td><center>$cell1[kd_ruang]</center></td>
                <td><center>$cell1[kelas]</center></td>

                ";
              echo "</tr>";
            }  
        }
        ?>

        <?php        
        $sqlsel = "SELECT * FROM tb_jadwal,tb_matkul,tb_dosen,tb_jurusan WHERE 
              tb_matkul.kd_matkul=tb_jadwal.kd_matkul 
          AND tb_dosen.id_dosen=tb_jadwal.kd_dosen 
          AND tb_jurusan.kd_jurusan=tb_jadwal.kd_jurusan
          AND tb_matkul.kd_matkul=tb_jadwal.kd_matkul
          AND jurusan='$jurusan' AND semester='$semester' AND hari='Selasa' ORDER BY waktu1 ASC";
        $pssel = mysqli_query($koneksi,$sqlsel);
        if(mysqli_num_rows($pssel)==0){  
            //jika data kosong, maka akan menampilkan row kosong
            //echo '<tr><td colspan="6">Hari Tidak ada data!</td></tr>';
        }else{
            $i=0; 
            while($datasel=mysqli_fetch_assoc($pssel)){
              $row2[$i]=$datasel;
              $i++;
            }

            foreach($row2 as $cell2){
              if(isset($total2[$cell2['hari']]['jml'])) { 
                $total2[$cell2['hari']]['jml']++; 
              }else{
                $total2[$cell2['hari']]['jml']=1; 
              } 
            }

            $n2=count($row2);
            $cekhari2="";
            for($i=0;$i<$n2;$i++){
              $cell2=$row2[$i];
              echo '<tr>';
              if($cekhari2!=$cell2['hari']){
                echo '<td' .($total2[$cell2['hari']]['jml']>1?' rowspan="' .($total2[$cell2['hari']]['jml']).'">':'>') .$cell2['hari'].'</td>';
                $cekhari2=$cell2['hari'];
              }
              $waktu1= date('H:i',strtotime($cell2['waktu1'])); 
              $waktu2= date('H:i',strtotime($cell2['waktu2']));
              echo "
                <td>
                  ".$waktu1." - ".$waktu2."
                </td>
                <td>$cell2[matkul]</td>
                <td><center>$cell2[sks]</center></td>
                <td>$cell2[dosen]</td>
                <td><center>$cell2[kd_ruang]</center></td>
                <td><center>$cell2[kelas]</center></td>

                ";
              echo "</tr>";
            }  
        }
        ?>

        <?php        
        $sqlrab = "SELECT * FROM tb_jadwal,tb_matkul,tb_dosen,tb_jurusan WHERE 
              tb_matkul.kd_matkul=tb_jadwal.kd_matkul 
          AND tb_dosen.id_dosen=tb_jadwal.kd_dosen 
          AND tb_jurusan.kd_jurusan=tb_jadwal.kd_jurusan
          AND tb_matkul.kd_matkul=tb_jadwal.kd_matkul
          AND jurusan='$jurusan' AND semester='$semester' AND hari='Rabu' ORDER BY waktu1 ASC";
        $psrab = mysqli_query($koneksi,$sqlrab);
        if(mysqli_num_rows($psrab)==0){  
            //jika data kosong, maka akan menampilkan row kosong
            //echo '<tr><td colspan="6">Hari Tidak ada data!</td></tr>';
        }else{
            $i=0; 
            while($datarab=mysqli_fetch_assoc($psrab)){
              $row3[$i]=$datarab;
              $i++;
            }

            foreach($row3 as $cell3){
              if(isset($total3[$cell3['hari']]['jml'])) { 
                $total3[$cell3['hari']]['jml']++; 
              }else{
                $total3[$cell3['hari']]['jml']=1; 
              } 
            }

            $n3=count($row3);
            $cekhari3="";
            for($i=0;$i<$n3;$i++){
              $cell3=$row3[$i];
              echo '<tr>';
              if($cekhari3!=$cell3['hari']){
                echo '<td' .($total3[$cell3['hari']]['jml']>1?' rowspan="' .($total3[$cell3['hari']]['jml']).'">':'>') .$cell3['hari'].'</td>';
                $cekhari3=$cell3['hari'];
              }
              $waktu1= date('H:i',strtotime($cell3['waktu1'])); 
              $waktu2= date('H:i',strtotime($cell3['waktu2']));
              echo "
                <td>
                  ".$waktu1." - ".$waktu2."
                </td>
                <td>$cell3[matkul]</td>
                <td><center>$cell3[sks]</center></td>
                <td>$cell3[dosen]</td>
                <td><center>$cell3[kd_ruang]</center></td>
                <td><center>$cell3[kelas]</center></td>

                ";
              echo "</tr>";
            }  
        }
        ?>

        <?php        
        $sqlkam = "SELECT * FROM tb_jadwal,tb_matkul,tb_dosen,tb_jurusan WHERE 
              tb_matkul.kd_matkul=tb_jadwal.kd_matkul 
          AND tb_dosen.id_dosen=tb_jadwal.kd_dosen 
          AND tb_jurusan.kd_jurusan=tb_jadwal.kd_jurusan
          AND tb_matkul.kd_matkul=tb_jadwal.kd_matkul
          AND jurusan='$jurusan' AND semester='$semester' AND hari='Kamis' ORDER BY waktu1 ASC";
        $pskam = mysqli_query($koneksi,$sqlkam);
        if(mysqli_num_rows($pskam)==0){  
            //jika data kosong, maka akan menampilkan row kosong
            //echo '<tr><td colspan="6">Hari Tidak ada data!</td></tr>';
        }else{
            $i=0; 
            while($datakam=mysqli_fetch_assoc($pskam)){
              $row4[$i]=$datakam;
              $i++;
            }

            foreach($row4 as $cell4){
              if(isset($total4[$cell4['hari']]['jml'])) { 
                $total4[$cell4['hari']]['jml']++; 
              }else{
                $total4[$cell4['hari']]['jml']=1; 
              } 
            }

            $n4=count($row4);
            $cekhari4="";
            for($i=0;$i<$n4;$i++){
              $cell4=$row4[$i];
              echo '<tr>';
              if($cekhari4!=$cell4['hari']){
                echo '<td' .($total4[$cell4['hari']]['jml']>1?' rowspan="' .($total4[$cell4['hari']]['jml']).'">':'>') .$cell4['hari'].'</td>';
                $cekhari4=$cell4['hari'];
              }
              $waktu1= date('H:i',strtotime($cell4['waktu1'])); 
              $waktu2= date('H:i',strtotime($cell4['waktu2']));
              echo "
                <td>
                  ".$waktu1." - ".$waktu2."
                </td>
                <td>$cell4[matkul]</td>
                <td><center>$cell4[sks]</center></td>
                <td>$cell4[dosen]</td>
                <td><center>$cell4[kd_ruang]</center></td>
                <td><center>$cell4[kelas]</center></td>

                ";
              echo "</tr>";
            }  
        }
        ?>

        <?php                
        $sqljum = "SELECT * FROM tb_jadwal,tb_matkul,tb_dosen,tb_jurusan WHERE 
              tb_matkul.kd_matkul=tb_jadwal.kd_matkul 
          AND tb_dosen.id_dosen=tb_jadwal.kd_dosen 
          AND tb_jurusan.kd_jurusan=tb_jadwal.kd_jurusan
          AND tb_matkul.kd_matkul=tb_jadwal.kd_matkul
          AND jurusan='$jurusan' AND semester='$semester' AND hari='Jumat' ORDER BY waktu1 ASC";
        $psjum = mysqli_query($koneksi,$sqljum);
        if(mysqli_num_rows($psjum)==0){  
            //jika data kosong, maka akan menampilkan row kosong
            //echo '<tr><td colspan="6">Hari Tidak ada data!</td></tr>';
        }else{
            $i=0; 
            while($datajum=mysqli_fetch_assoc($psjum)){
              $row5[$i]=$datajum;
              $i++;
            }

            foreach($row5 as $cell5){
              if(isset($total5[$cell5['hari']]['jml'])) { 
                $total5[$cell5['hari']]['jml']++; 
              }else{
                $total5[$cell5['hari']]['jml']=1; 
              } 
            }

            $n5=count($row5);
            $cekhari5="";
            for($i=0;$i<$n5;$i++){
              $cell5=$row5[$i];
              echo '<tr>';
              if($cekhari5!=$cell5['hari']){
                echo '<td' .($total5[$cell5['hari']]['jml']>1?' rowspan="' .($total5[$cell5['hari']]['jml']).'">':'>') .$cell5['hari'].'</td>';
                $cekhari5=$cell5['hari'];
              }

              $waktu1= date('H:i',strtotime($cell5['waktu1'])); 
              $waktu2= date('H:i',strtotime($cell5['waktu2']));
              echo "
                <td>
                  ".$waktu1." - ".$waktu2."
                </td>
                <td>$cell5[matkul]</td>
                <td><center>$cell5[sks]</center></td>
                <td>$cell5[dosen]</td>
                <td><center>$cell5[kd_ruang]</center></td>
                <td><center>$cell5[kelas]</center></td>

                ";
              echo "</tr>";
            }  
        }
        ?>        
<!--        </tbody>


        <tbody>
-->
       	<?php        
        $sqlsab = "SELECT * FROM tb_jadwal,tb_matkul,tb_dosen,tb_jurusan WHERE 
              tb_matkul.kd_matkul=tb_jadwal.kd_matkul 
          AND tb_dosen.id_dosen=tb_jadwal.kd_dosen 
          AND tb_jurusan.kd_jurusan=tb_jadwal.kd_jurusan
          AND tb_matkul.kd_matkul=tb_jadwal.kd_matkul
          AND jurusan='$jurusan' AND semester='$semester' AND hari='Sabtu' ORDER BY waktu1 ASC";
        $pssab = mysqli_query($koneksi,$sqlsab);
        if(mysqli_num_rows($pssab)==0){  
            //jika data kosong, maka akan menampilkan row kosong
            //echo '<tr><td colspan="6">Hari Tidak ada data!</td></tr>';
        }else{
            $i=0; 
            while($datasab=mysqli_fetch_assoc($pssab)){
              $row6[$i]=$datasab;
              $i++;
            }

            foreach($row6 as $cell6){
              if(isset($total6[$cell6['hari']]['jml'])) { 
                $total6[$cell6['hari']]['jml']++; 
              }else{
                $total6[$cell6['hari']]['jml']=1; 
              } 
            }

            $n6=count($row6);
            $cekhari6="";
            for($i=0;$i<$n6;$i++){
              $cell6=$row6[$i];
              echo '<tr>';
              if($cekhari6!=$cell6['hari']){
                echo '<td' .($total6[$cell6['hari']]['jml']>1?' rowspan="' .($total6[$cell6['hari']]['jml']).'">':'>') .$cell6['hari'].'</td>';
                $cekhari6=$cell6['hari'];
              }

              $waktu1= date('H:i',strtotime($cell6['waktu1'])); 
              $waktu2= date('H:i',strtotime($cell6['waktu2']));
              echo "
                <td>
                  ".$waktu1." - ".$waktu2."
                </td>
                <td>$cell6[matkul]</td>
                <td><center>$cell6[sks]</center></td>
                <td>$cell6[dosen]</td>
                <td><center>$cell6[kd_ruang]</center></td>
                <td><center>$cell6[kelas]</center></td>

                ";
              echo "</tr>";
            }  
        }
        
        ?>

<!--        </tbody>

        <tbody>
-->
        <?php        
        $sql99 = "SELECT * FROM tb_jadwal,tb_matkul,tb_dosen,tb_jurusan WHERE 
              tb_matkul.kd_matkul=tb_jadwal.kd_matkul 
          AND tb_dosen.id_dosen=tb_jadwal.kd_dosen 
          AND tb_jurusan.kd_jurusan=tb_jadwal.kd_jurusan
          AND tb_matkul.kd_matkul=tb_jadwal.kd_matkul
          AND jurusan='$jurusan' AND semester='$semester' AND hari='Minggu' ORDER BY waktu1 ASC";
        $proses = mysqli_query($koneksi,$sql99);
        if(mysqli_num_rows($proses)==0){  
            //jika data kosong, maka akan menampilkan row kosong
            //echo '<tr><td colspan="6">Hari Tidak ada data!</td></tr>';
        }else{
            $i=0; 
            while($data99=mysqli_fetch_assoc($proses)){
              $row[$i]=$data99;
              $i++;
            }

            foreach($row as $cell){
              if(isset($total[$cell['hari']]['jml'])) { 
                $total[$cell['hari']]['jml']++; 
              }else{
                $total[$cell['hari']]['jml']=1; 
              } 
            }

            $n=count($row);
            $cekhari="";
            for($i=0;$i<$n;$i++){
              $cell=$row[$i];
              echo '<tr>';
              if($cekhari!=$cell['hari']){
                echo '<td' .($total[$cell['hari']]['jml']>1?' rowspan="' .($total[$cell['hari']]['jml']).'">':'>') .$cell['hari'].'</td>';
                $cekhari=$cell['hari'];
              }
              $waktu1= date('H:i',strtotime($cell['waktu1'])); 
              $waktu2= date('H:i',strtotime($cell['waktu2']));
              echo "
                <td>
                  ".$waktu1." - ".$waktu2."
                </td>
                <td>$cell[matkul]</td>
                <td><center>$cell[sks]</center></td>
                <td>$cell[dosen]</td>
                <td><center>$cell[kd_ruang]</center></td>
                <td><center>$cell[kelas]</center></td>

                ";
              echo "</tr>";
            }  
        }
        
        ?>

        </tbody>
      </table>


			<hr style="border: 0; border-top: 1px solid #000000;">
			<div class="container" align="right">
  			<div class="col-md-4 col-xs-4" style="font-size: 12px;">
  			<p style="margin-bottom: 10px;">Bandung, <?php
         $arrbln = array("Januari","Februaru","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
         $b = $arrbln[$bulan_ini-1];
            echo date('d'); 
            echo "  ".$b."  "; 
            echo date('Y');  
         ?></p>

        <?php
          if (empty($id_dosen)) {
            
          }else{
          ?>  
          <p>Mengetahui,
          <br />Ketua Jurusan <?php echo $jurusan; ?></p>
          <br />
          <br />
          <p><?php echo $r9['dosen'];?><br>
           -----------------------------------
          <br>NIP. <?php echo $r9['nip'];?></p>
        <?php
          }
        ?>
  					
  			</div>
			</div>

		</div>
	</div>
    
</body>