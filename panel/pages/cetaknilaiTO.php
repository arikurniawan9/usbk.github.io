<?php
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
?>

<link rel="stylesheet" href="cetak.min.css">
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="jquery.qrcode-0.12.0.min.js"></script>
<script type="text/javascript" src="jquery.scrollbar.min.js"></script>
<script type="text/javascript" src="jquery-1.4.js"></script>
<script src="date/jquery.js"></script>
<script src="jquery.datetimepicker.full.js"></script>
<script type="text/javascript" src="jquery.gdocsviewer.min.js"></script> 


<script type="text/javascript" src="jquery-1.4.js"></script>
<style>@media print {
    footer {page-break-after: always;}
}
</style>

</head>
<body>
<?php

//koneksi database
include "../../config/server.php";


$sqlad = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_admin");
$ad = mysqli_fetch_array($sqlad);
$namsek = strtoupper($ad['XSekolah']);
$kepsek = $ad['XKepSek'];
$logsek = $ad['XLogo'];
$BatasAwal = 50;
 if(isset($_REQUEST['iki3'])){ 
$cekQuery = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM cbt_siswa where XKodeKelas = '$_REQUEST[iki3]' and  XKodeJurusan = '$_REQUEST[jur3]' ");
}else{
$cekQuery = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM cbt_siswa ");
}
$jumlahData = mysqli_num_rows($cekQuery);
$jumlahn = 20;
$n = ceil($jumlahData/$jumlahn);
$nomz = 1;
for($i=1;$i<=$n;$i++){ ?>

<div class="page">	
				<table border="0" width="100%">
					<tbody>
						 <tr>
						 <?php 
								$sqk = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_tes where XKodeUjian = '$_REQUEST[tes3]'");
								$rs = mysqli_fetch_array($sqk);
                             	$rs1 = strtoupper("$rs[XNamaUjian]");
								
								if($_REQUEST['tes3']=='ALL'){$namaujian = "DAFTAR NILAI UJIAN ";} else {$namaujian = "DAFTAR NILAI TRYOUT";}
								?> 
								<td width="100" ><img src="images/tut.jpg" height="90"></td>
								<td>
								<center><strong class="f12"><?php echo "$namaujian"; ?>
								<br><?php echo $namsek; ?>
								<br>TAHUN <?php echo $_COOKIE['beetahun']; ?></strong>
				
								</center></td>
								<td width="100"><img src="../../images/<?php echo "$logsek"; ?>" height="90"></td>
	
	
						</tr>
					</tbody>
				</table>
	<br>
								<?php 
								$sqk = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_mapel where XKodeMapel = '$_REQUEST[map3]'");
								$rs = mysqli_fetch_array($sqk);
                             	$rs1 = strtoupper("$rs[XNamaMapel]");
								?>   
				<table class="detail">
					  <tbody>
							  <tr>
							  <td>MATA PELAJARAN</td><td >:</td>
							  <td><span style="width:300px"><?php echo $rs1; ?> </span></td>
							  <td>SEMESTER</td><td>:</td>
							  <td><span style="width:130px"><?php echo $_REQUEST['sem3']; ?></span></td>
							  </tr>
							  <tr>
							  <td>KELAS - JURUSAN</td><td >:</td>
							  <td><span style="width:300px"><?php echo $_REQUEST['iki3']; ?> - <?php echo $_REQUEST['jur3']; ?></span></td>
							  <td>TAHUN AKADEMIK</td><td>:</td>
							  <td><span style="width:130px"><?php echo $_COOKIE['beetahun']; ?></span></td>
							  </tr>
					  </tbody>
				</table>
	<br>
	
				<table class="it-grid it-cetak" width="100%">
				<tbody>
				<tr color="#C4BC96" height="30px">
					<th rowspan="2"><center>No.</center></th>
					<th rowspan="2"><center>NIS/NISN</center></th>
					<th rowspan="2"><center>Nama Peserta</center></th>
					<th colspan="5"><center>TryOut</center></th>
					<th rowspan="2"><center>Total Akhir</center></th>
					<th rowspan="2"><center>KKM</center></th>
				</tr>
				<tr color="#E2F7B9">
					<td height="30" align="center">TO1</td>
					<td height="30" align='center'>TO2</td>
					<td align="center">TO3</td>
					<td align="center">TO4</td>
					<td align="center">TO5</td>
					
				</tr>
				</tbody>
					
					
				<?php

$mulai = $i-1;
$batas = ($mulai*$jumlahn);
$startawal = $batas;
$batasakhir = $batas+$jumlahn;

$s = $i-1;

$per = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from cbt_mapel where XKodeMapel = '$_REQUEST[map3]'");
$p = mysqli_fetch_array($per);

$perUH = $p['XPersenUH'];
$perUTS = $p['XPersenUTS'];
$perUAS = $p['XPersenUAS'];
$NilaiKKM = $p['XKKM'];
?>
<?php
if(isset($_REQUEST['iki3'])){ 
$cekQuery1 = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM cbt_siswa where XKodeKelas = '$_REQUEST[iki3]' and  XKodeJurusan = '$_REQUEST[jur3]' limit $batas,$jumlahn");
}else{
$cekQuery1 = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM cbt_siswa limit $batas,$jumlahn");
}
$jumlahTO = 0;
while($f= mysqli_fetch_array($cekQuery1)){

$sto1 = mysqli_query($GLOBALS["___mysqli_ston"], "
SELECT sum(XNilai) as totTO1, count(XNilai) as jujum2 FROM cbt_nilai where  (XKodeKelas = '$_REQUEST[iki3]' or XKodeKelas='ALL') and XNIK = '$f[XNIK]' and XKodeUjian = 'TO1' 
and	XKodeMapel = '$_REQUEST[map3]' and XSemester = '$_REQUEST[sem3]' and XSetId='$_COOKIE[beetahun]'");
$to1 = mysqli_fetch_array($sto1);
$jumlahTO1 = mysqli_num_rows($sto1);

$tot1 = $to1['totTO1'];
if($tot1==""){ 
$TOP1 = "";
} else {
$TOP1 = number_format($tot1, 2, ',', '.');
}

$sto2 = mysqli_query($GLOBALS["___mysqli_ston"], "
SELECT sum(XNilai) as totTO2, count(XNilai) as jujum2 FROM cbt_nilai where  (XKodeKelas = '$_REQUEST[iki3]' or XKodeKelas='ALL') and XNIK = '$f[XNIK]' and XKodeUjian = 'TO2' 
and	XKodeMapel = '$_REQUEST[map3]' and XSemester = '$_REQUEST[sem3]' and XSetId='$_COOKIE[beetahun]'");
$to2 = mysqli_fetch_array($sto2);
$jumlahTO2 = mysqli_num_rows($sto2);
$tot2 = $to2['totTO2'];
if($tot2==""){ 
$TOP2 = "";
} else {
$TOP2 = number_format($tot2, 2, ',', '.');
}

$sto3 = mysqli_query($GLOBALS["___mysqli_ston"], "
SELECT sum(XNilai) as totTO3, count(XNilai) as jujum2 FROM cbt_nilai where  (XKodeKelas = '$_REQUEST[iki3]' or XKodeKelas='ALL') and XNIK = '$f[XNIK]' and XKodeUjian = 'TO3' 
and	XKodeMapel = '$_REQUEST[map3]' and XSemester = '$_REQUEST[sem3]' and XSetId='$_COOKIE[beetahun]'");
$to3 = mysqli_fetch_array($sto3);
$jumlahTO3 = mysqli_num_rows($sto3);
$tot3 = $to3['totTO3'];
if($tot3==""){ 
$TOP3 = "";
} else {
$TOP3 = number_format($tot3, 2, ',', '.');
}

$sto4 = mysqli_query($GLOBALS["___mysqli_ston"], "
SELECT sum(XNilai) as totTO4, count(XNilai) as jujum2 FROM cbt_nilai where  (XKodeKelas = '$_REQUEST[iki3]' or XKodeKelas='ALL') and XNIK = '$f[XNIK]' and XKodeUjian = 'TO4' 
and	XKodeMapel = '$_REQUEST[map3]' and XSemester = '$_REQUEST[sem3]' and XSetId='$_COOKIE[beetahun]'");
$to4 = mysqli_fetch_array($sto4);
$jumlahTO4 = mysqli_num_rows($sto4);
$tot4 = $to4['totTO4'];
if($tot4==""){ 
$TOP4 = "";
} else {
$TOP4 = number_format($tot4, 2, ',', '.');
}

$sto5 = mysqli_query($GLOBALS["___mysqli_ston"], "
SELECT sum(XNilai) as totTO5, count(XNilai) as jujum2 FROM cbt_nilai where  (XKodeKelas = '$_REQUEST[iki3]' or XKodeKelas='ALL') and XNIK = '$f[XNIK]' and XKodeUjian = 'TO5' 
and	XKodeMapel = '$_REQUEST[map3]' and XSemester = '$_REQUEST[sem3]' and XSetId='$_COOKIE[beetahun]'");
$to5 = mysqli_fetch_array($sto5);
$jumlahTO5 = mysqli_num_rows($sto5);
$tot5 = $to5['totTO5'];
if($tot5==""){ 
$TOP5 = "";
} else {
$TOP5 = number_format($tot5, 2, ',', '.');
}

$jto = mysqli_query($GLOBALS["___mysqli_ston"], "
SELECT * FROM cbt_nilai where XNomerUjian = '$f[XNomerUjian]' and XKodeUjian like 'TO%' 
and	XKodeMapel = '$_REQUEST[map3]' and XSemester = '$_REQUEST[sem3]' and XSetId='$_COOKIE[beetahun]'");

$jumlahTO = mysqli_num_rows($jto);

$TAkhire = $tot1+$tot2+$tot3+$tot4+$tot5;
if($jumlahTO==0){$TOTAkhire = "";$NilaiKKM = "";} else {$TOTAkhire = number_format(($TAkhire/$jumlahTO), 2, ',', '.');}
	  echo "
	  <tr height=30px>
	  <td align='center'>&nbsp;$nomz </td>
	  <td align='center'>&nbsp;$f[XNIK]</td>
	  <td align=left>&nbsp;$f[XNamaSiswa]</td>
	  <td align='center'>&nbsp;$TOP1</td>
	  <td align='center'>&nbsp;$TOP2</td>
	  <td align='center'>&nbsp;$TOP3</td>
	  <td align='center'>&nbsp;$TOP4</td>
	  <td align='center'>&nbsp;$TOP5</td>
	  <td align='center'>$TOTAkhire </td>
  	  <td align='center'>$NilaiKKM</td>	  
	  </tr>";

  $nomz++;
?>
<?php } ?>      

	</table>
	
				<div class=" footer">
					<table width="100%" height="30">
					<tbody><tr>
						<td width="25px" style="border:1px solid black"></td>
						<td width="5px">&nbsp;</td>
						<td style="border:1px solid black;font-weight:bold;font-size:14px;text-align:center;">UJIAN BERBASIS KOMPUTER - <?php echo $namsek; ?></td>
						<td width="5px">&nbsp;</td>
						<td width="25px" style="border:1px solid black"></td>
					</tr>
					</tbody>
					</table>
				</div>
   


	<script>
		$('.rekap-grid').find('td').each(function(){
			if($(this).html() == '0'){
				$(this).html('');
			}
		});
	</script>
	
    </div>
   
<?php } ?>            
</body>
</html>								