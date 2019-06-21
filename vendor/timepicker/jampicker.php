<!-- ************************************* 
 * Jampicker.html
 * By : BliKomKom
 * Script html menggunakan timepicker
 * untuk inputasi jam menit (hh:mm)
 * http://www.komang.my.id
************************************** -->
<head>
<title>Jquery untuk input Jam Menit</title>
<link rel="stylesheet" href="css/jquery-ui.css" type="text/css" />
<link rel="stylesheet" href="css/jquery.ui.timepicker.css?v=0.3.3" type="text/css" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script> 
<script type="text/javascript" src="js/jquery.ui.timepicker.js?v=0.3.3"></script>
<script type="text/javascript">
            $(document).ready(function() {
                $('#jam1').timepicker({
                    showPeriodLabels: false
                });
              });
</script>
</head>
<body>
<form method="POST">
Jam Awal : <input type="text" name="j" style="width: 70px;" id="jam1" />
<br />
<button type="submit">Ambil nilai jam dan menit</button>
</form> 
</body>
</html>

<?php
$j= $_POST["j"];
echo $j;
//$a = 40;
$cc = $a.'minutes';
$j1 = date('H:i', strtotime($cc, strtotime($j)));
//echo '</br>'.$j1;
?>