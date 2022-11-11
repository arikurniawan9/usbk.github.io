<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
?>
<html>
<head>
<title><?php echo $skull; ?>-CBT | Administrator</title>

<script type="text/javascript" src="jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="jquery.qrcode-0.12.0.min.js"></script>
<script type="text/javascript" src="jquery.gdocsviewer.min.js"></script> 
<link rel="stylesheet" href="cetak.min.css">
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

<?php

function kartu($am,$kokel,$kojur) {
$sqlam = mysqli_query($GLOBALS["___mysqli_ston"], "
select * from (select * from cbt_siswa where XKodeKelas = '$kokel' and XKodeJurusan='$kojur' order by Urut  limit $am) as ambil order by Urut Desc limit 1");
$a = mysqli_fetch_array($sqlam);

$sqlad = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_admin");
$ad = mysqli_fetch_array($sqlad);
$namsek = $ad['XSekolah'];
$kepsek = $ad['XKepSek'];
$logsek = $ad['XLogo'];
$skul_tkt= $ad['XTingkat']; 
if ($skul_tkt=="SMA" || $skul_tkt=="MA"||$skul_tkt=="STM"){$rombel="Jurusan";}else{$rombel="Rombel";}

if(str_replace(" ","",$a['XFoto'])==""){$pic = "nouser.png";}else{$pic="$a[XFoto]";}
?>

<body style="">

	<center>
					<table style="width:9cm;border:1px solid black;" class="kartu">
					<tbody>
					<tr>
						<td colspan="3" style="border-bottom:1px solid black">
							<table width="100%" style="background:" class="kartu">
							<tbody>
							<tr>
								<td><img src="images/tut.jpg" height="40"></td>
								<td align="center" style="font-weight:bold">
								<font color="#" >KARTU PESERTA <br> UJIAN BERBASIS KOMPUTER  <br>
									<?php echo $namsek; ?></br></font> <?php echo $_COOKIE['beetahun'];?></br>
								</td>
								<td><img src="../../images/<?php echo $logsek; ?>" height="40"></td>
							</tr>
							</tbody>
							</table>
							</td>
					</tr>
					<tr><td width="115">&nbsp;Nama Peserta</td><td width="1">:</td><td><?php echo "$a[XNamaSiswa] "; ?></td></tr>
					<tr><td>&nbsp;Kelas</td><td>:</td><td><?php echo "$a[XKodeKelas] - $kojur"; ?></td></tr>
					<tr><td>&nbsp;Username</td><td>:</td><td style="font-size:12px;font-weight:bold;"><?php echo "$a[XNomerUjian]"; ?></td></tr>
					<tr><td>&nbsp;Password</td><td>:</td><td style="font-size:12px;font-weight:bold;"><?php echo $a['XPassword']; ?></td></tr>
					<tr><td>&nbsp;Jurusan</td><td>:</td><td><?php echo "$a[XKodeJurusan] "; ?></td></tr>
					<tr><td>&nbsp;Sesi - Ruang</td><td>:</td><td><?php echo "$a[XSesi] - $a[XRuang]"; ?></td></tr>
					<tr><td rowspan="3" align="center"><img src="../../fotosiswa/<?php echo $pic; ?>" height="65px" border="thin solid red"></td>
					<td colspan="2" valign="top" align="center">Kepala<br><?php echo $namsek; ?></td></tr>
					<td style="font-size:12px;font-weight:bold;" colspan="2" align="center">Ttd ,</td>
					<tr><td colspan="2" align="center"><?php echo $kepsek; ?></td></tr>
					</tbody>
				</table>
<?php        
}
?>

<?php
//koneksi database
include "../../config/server.php";
$BatasAwal = 50;

if(isset($_REQUEST['kelas'])&&isset($_REQUEST['jur'])){ 
$cekQuery = mysqli_query($GLOBALS["___mysqli_ston"], "
SELECT * FROM cbt_siswa where XKodeKelas = '$_REQUEST[kelas]' and  XKodeJurusan = '$_REQUEST[jur]' ");
} else {
$cekQuery = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM cbt_siswa"); 
}

$jumlahData = mysqli_num_rows($cekQuery);
$jumlahn = 8;
$n = ceil($jumlahData/$jumlahn);

for($i=1;$i<=$n;$i++){ ?>
<div class="page">
<?php
$mulai = $i-1;
$batas = ($mulai*$jumlahn);
$startawal = $batas;
$batasakhir = $batas+$jumlahn;
$kokelz = "$_REQUEST[kelas]";
$kojurz = "$_REQUEST[jur]";

?>
		<table width="100%" class="kartu">
		<tr>
		<td><?php if($startawal+1<=$jumlahData){kartu($startawal+1,$kokelz,$kojurz);} ?></td>
        <td><?php if($startawal+2<=$jumlahData){kartu($startawal+2,$kokelz,$kojurz);} ?></td>
		</tr>
		<td>
		&nbsp;
		</td>
        <tr>
		<td><?php if($startawal+3<=$jumlahData){kartu($startawal+3,$kokelz,$kojurz);} ?></td>
        <td><?php if($startawal+4<=$jumlahData){kartu($startawal+4,$kokelz,$kojurz);} ?></td>
		</tr>
		<td>
		&nbsp;
		</td>
        <tr>
		<td><?php if($startawal+5<=$jumlahData){kartu($startawal+5,$kokelz,$kojurz);} ?></td>
        <td><?php if($startawal+6<=$jumlahData){kartu($startawal+6,$kokelz,$kojurz);} ?></td>
		</tr>
		<td>
		&nbsp;
		</td>
        <tr>
		<td><?php if($startawal+7<=$jumlahData){kartu($startawal+7,$kokelz,$kojurz);} ?></td>
        <td><?php if($startawal+8<=$jumlahData){kartu($startawal+8,$kokelz,$kojurz);} ?></td>
		</tr>
    
		</table>
	</center>
</div>
<?php } ?>
</body>
</html>