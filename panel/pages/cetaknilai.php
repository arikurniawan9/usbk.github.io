<?php

	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
?>


<html>
<head>
<title><?php echo $skull; ?>-CBT | Cetak Daftar Nilai</title>
<link rel="stylesheet" href="cetak.min.css">

<script type="text/javascript" src="jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="jquery.qrcode-0.12.0.min.js"></script>
</head>

<style>@media print {
    footer {page-break-after: always;}
}
</style>
<script type="text/javascript"> 
/*<![CDATA[*/
$(document).ready(function() {
	$('a.embed').gdocsViewer({width: 600, height: 700});
	$('#embedURL').gdocsViewer();
});
/*]]>*/
</script>

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
								
								if($_REQUEST['tes3']=='ALL'){$namaujian = "DAFTAR NILAI UJIAN";} else {$namaujian = "DAFTAR NILAI UJIAN $rs1";}
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
								$NilaiKKM2 = $rs['XKKM'];
								?>   
				<table class="detail">
					  <tbody>
							  <tr>
							  <td>MATA PELAJARAN</td><td >:</td>
							  <td><span style="width:300px"><?php echo $rs1; ?> </span></td>
							  <td>NILAI KKM</td><td>:</td>
							  <td><span style="width:130px">( <?php echo $NilaiKKM2; ?> )</span></td>
							  </tr>
							  <tr>
							  <td>KELAS-JURUSAN</td><td >:</td>
							  <td><span style="width:300px"><?php echo $_REQUEST['iki3']; ?> - <?php echo $_REQUEST['jur3']; ?> </span></td>
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
					<th colspan="5"><center>Semester 1 </center></th>
					<th colspan="5"><center>Semester 2 </center></th>
					<th rowspan="2"><center>N.Akhir</center></th>
					<th rowspan="2"><center>KKM</center></th>
				</tr>
				<tr color="#E2F7B9">
					<td height="30" align="center">UH</td>
					<td height="30" align='center'>TG</td>
					<td align="center">UTS</td>
					<td align="center">UAS</td>
					<td align="center">N.Sem.1</td>
					<td align="center">UH</td>
					<td height="30" align='center'>TG</td>
					<td align="center">UTS</td>
					<td align="center">UAS</td>
					<td align="center">N.Sem.2</td>
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
while($f= mysqli_fetch_array($cekQuery1)){
	$utg = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(XNilaiTugas) as totUG, count(XNilaiTugas) as jujumG FROM cbt_tugas where XKodeKelas = '$_REQUEST[iki3]' and XNIK = '$f[XNIK]' and 
	XKodeMapel = '$_REQUEST[map3]' and XSemester = '1' and XSetId='$_COOKIE[beetahun]'");

	$tug = mysqli_fetch_array($utg);
	if(isset($tug['totUG'])){$totUG1 = number_format(($tug['totUG']/$tug['jujumG']), 2, ',', '.');
	$TUG1 = ($tug['totUG']/$tug['jujumG']);
	} else {$totUG1="";$TUG1="";}


	if($_REQUEST['iki3']=="ALL"){
	$uh = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(XTotalNilai) as totUH, count(XNilai) as jujum FROM cbt_nilai where XNIK = '$f[XNIK]' and XKodeUjian = 'UH' 
	and	XKodeMapel = '$_REQUEST[map3]' and XSemester = '1' and XSetId='$_COOKIE[beetahun]'");
	} else {
	$uh = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(XTotalNilai) as totUH, count(XNilai) as jujum FROM cbt_nilai where XKodeKelas = '$_REQUEST[iki3]' 
	and  XNIK = '$f[XNIK]' and XKodeUjian = 'UH' 
	and	XKodeMapel = '$_REQUEST[map3]' and XSemester = '1' and XSetId='$_COOKIE[beetahun]'");
	}

//echo "SELECT sum(XTotalNilai) as totUH, count(XNilai) as jujum FROM `cbt_jawaban` j left join cbt_ujian u on u.XTokenUjian = j.XTokenUjian WHERE XUserJawab = '$f[XNomerUjian]' and u.XKodeUjian = 'UH' and u.XKodeMapel = '$_REQUEST[map3]' and u.XSemester = '1' and u.XSetId='$_COOKIE[beetahun]'";
		
	$tuh = mysqli_fetch_array($uh);

//echo "$tuh[totUH]-$f[XNomerUjian]<br>";

	if(isset($tuh['totUH'])){$totUH1 = number_format(($tuh['totUH']/$tuh['jujum']), 2, ',', '.');
	$TUH1 = ($tuh['totUH']/$tuh['jujum']);
	} else {$totUH1="";$TUH1 = "";}

	$uts = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(XNilai) as totUTS FROM cbt_nilai where XKodeKelas = '$_REQUEST[iki3]' and XNIK = '$f[XNIK]' and XKodeUjian = 'UTS' and XKodeMapel = '$_REQUEST[map3]' and XSemester = '1' and XSetId='$_COOKIE[beetahun]'");
	$tuts = mysqli_fetch_array($uts);
	if(isset($tuts['totUTS'])){$totUTS1 = number_format($tuts['totUTS'], 2, ',', '.');
	$TUTS1 = $tuts['totUTS'];
	} else {$totUTS1="";$TUTS1="";}	


	$uas = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(XNilai) as totUAS FROM cbt_nilai where XKodeKelas = '$_REQUEST[iki3]' and XNIK = '$f[XNIK]' and XKodeUjian = 'UAS' and XKodeMapel = '$_REQUEST[map3]' and XSemester = '1' and XSetId='$_COOKIE[beetahun]'");
	$tuas = mysqli_fetch_array($uas);
	if(isset($tuas['totUAS'])){$totUAS1 = number_format($tuas['totUAS'], 2, ',', '.');
	$TUAS1 = $tuas['totUAS'];
	} else {$totUAS1="";$TUAS1="";}	

//nilai akhir semester1
//NR = 60% (RU&T)+ 20% (UTS)  + 20% (UAS)

if(!$totUH1==""){
	$NUH1 = $TUH1;
	$NUG1 = $TUG1;	
	if($NUG1==""){$NH1   = $NUH1;} else {$NH1   = ($NUH1+$NUG1)/2; }//Nilai Harian
	$NUT1 = $TUTS1;	
	$NUA1 = $TUAS1;	
	
	//$NA1  = ($NH1*($perUH/100))+($NUT1*($perUTS/100))+($NUA1*($perUAS/100)); // bila dihitung dari presentase
	$NA1  = ($NH1*($perUH))+($NUT1*($perUTS))+($NUA1*($perUAS)); // bila dihitung dari presentase
	//$NA1  = ( ($NH1*2)+$NUT1+$NUA1 )/4 ; //
	$totNA1 = 	number_format(($NA1/100), 2, ',', '.');

} else { $NA1 = ""; $totNA1 = "";}


	$utg2 = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(XNilaiTugas) as totUG2, count(XNilaiTugas) as jujumG2 FROM cbt_tugas where XKodeKelas = '$_REQUEST[iki3]' and XNIK = '$f[XNIK]' and 
	XKodeMapel = '$_REQUEST[map3]' and XSemester = '2' and XSetId='$_COOKIE[beetahun]'");

	$tug2 = mysqli_fetch_array($utg2);
	if(isset($tug2['totUG2'])){$totUG2 = number_format(($tug2['totUG2']/$tug2['jujumG2']), 2, ',', '.');
	$TUG2 = ($tug2['totUG2']/$tug2['jujumG2']);
	} else {$totUG2="";$TUG2 ="";}

	$uh2 = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(XNilai) as totUH2, count(XNilai) as jujum2 FROM cbt_nilai where XKodeKelas = '$_REQUEST[iki3]' and XNIK = '$f[XNIK]' and XKodeUjian = 'UH' 
	and	XKodeMapel = '$_REQUEST[map3]' and XSemester = '2' and XSetId='$_COOKIE[beetahun]'");


	$tuh2 = mysqli_fetch_array($uh2);
	if(isset($tuh2['totUH2'])){$totUH2 = number_format(($tuh2['totUH2']/$tuh2['jujum2']), 2, ',', '.');
	$TUH2 = ($tuh2['totUH2']/$tuh2['jujum2']);} else {$totUH2="";$TUH2 ="";}

	$uts2 = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(XNilai) as totUTS2 FROM cbt_nilai where XKodeKelas = '$_REQUEST[iki3]' and XNIK = '$f[XNIK]' and XKodeUjian = 'UTS' and XKodeMapel = '$_REQUEST[map3]' and XSemester = '2' and XSetId='$_COOKIE[beetahun]'");
	$tuts2 = mysqli_fetch_array($uts2);
	if(isset($tuts2['totUTS2'])){$totUTS2 = number_format($tuts2['totUTS2'], 2, ',', '.');
	$TUTS2 = $tuts2['totUTS2'];
	} else {$totUTS2="";$TUTS2="";}	

	$uas2 = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT sum(XNilai) as totUAS2 FROM cbt_nilai where XKodeKelas = '$_REQUEST[iki3]' and XNIK = '$f[XNIK]' and XKodeUjian = 'UAS' and XKodeMapel = '$_REQUEST[map3]' and XSemester = '2' and XSetId='$_COOKIE[beetahun]'");
	$tuas2 = mysqli_fetch_array($uas2);
	if(isset($tuas2['totUAS2'])){$totUAS2 = number_format($tuas2['totUAS2'], 2, ',', '.');
	$TUAS2 = $tuas2['totUAS2'];
	} else {$totUAS2="";$TUAS2="";}	

if(!$totUH2==""){
	$NUH2 = $TUH2;
	$NUG2 = $TUG2;
	if($NUG2==""){$NH2   = $NUH2;} else {$NH2   = ($NUH2+$NUG2)/2; }
	
	$NUT2 = $TUTS2;	
	$NUA2 = $TUAS2;	
	
	$NA2  = ($NH2*($perUH))+($NUT2*($perUTS))+($NUA2*($perUAS)); // bila dihitung dari presentase
	//$NA1  = ( ($NH1*2)+$NUT1+$NUA1 )/4 ; //
	$totNA2 = 	number_format($NA2, 2, ',', '.');
	
} else { $totNA2 = "";}

if(!isset($NA2)){ $NA2 = 0;}

	if($NA2==""){$TotAkhir = ($NA1+$NA2)/100;} else {$TotAkhir = (($NA1+$NA2)/2)/100;}
	
	if($NA1==""&&$NA2==""){$TotAkhire ="";} else {
	$TotAkhire = number_format($TotAkhir, 2, ',', '.');
	}
	if($totUH1==''){$TotAkhir = "";}

	$tampilKKM = number_format($NilaiKKM, 2, ',', '.');
	if($TotAkhir>=$NilaiKKM2){$lulus = "LULUS";} else {$lulus = "REMIDI";}
	
	  echo "
	  <tr height=30px>
	  <td align='center'>&nbsp;$nomz</td>
	  <td align='center'>$f[XNIK]</td>
	  <td align=left>&nbsp;$f[XNamaSiswa]</td>
	  <td align='center'>&nbsp;$totUH1.</td>
	  <td align='center'>&nbsp;$totUG1.</td>
	  <td align='center'>&nbsp;$totUTS1.</td>
	  <td align='center'>&nbsp;$totUAS1.</td>
	  <td align='center'>&nbsp;$totUH2.</td>
	  <td align='center'>&nbsp;$totUG2.</td>
	  <td align='center'>&nbsp;$totUTS2.</td><td align='center'>&nbsp;$totUH1.</td>
	  <td align='center'>&nbsp;$totUAS2.</td>
	  <td align='center'>&nbsp;$totNA2.</td>
	  <td align='center'>&nbsp;$TotAkhire.</td>
	  <td align='center'>&nbsp;$NilaiKKM2.</td>
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
</div> 	


	<script>
		$('.rekap-grid').find('td').each(function(){
			if($(this).html() == '0'){
				$(this).html('');
			}
		});
	</script>
<?php } ?> 
</body>

</html>


