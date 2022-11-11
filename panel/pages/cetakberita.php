<?php

	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>

<title><?php echo $skull; ?>-CBT | Form Berita Acara</title>

<link rel="stylesheet" href="cetak.min.css">
<script type="text/javascript" src="jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="jquery.qrcode-0.12.0.min.js"></script>
<script type="text/javascript" src="jquery.scrollbar.min.js"></script>
<script type="text/javascript" src="jquery.gdocsviewer.min.js"></script> 
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
$kab = $ad['XKab'];
$prop = $ad['XProp'];
$kec = $ad['XKec'];
$nipadmin = $ad['XNIPAdmin'];
$nipkepsek = $ad['XNIPKepsek'];
$logsek = $ad['XLogo'];
$BatasAwal = 50;
$sql1 = mysqli_query($GLOBALS["___mysqli_ston"], "select * from inf_lokasi where lokasi_kabupatenkota='$kab' and lokasi_propinsi='$prop' and lokasi_kecamatan='0000' and lokasi_kelurahan='0000'");
$xadm1 = mysqli_fetch_array($sql1);
$xkab= $xadm1['lokasi_nama'];


								$sqk = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_ujian where XTokenUjian = '$_REQUEST[token]' ");
								$rs = mysqli_fetch_array($sqk);
								$tanggal = "$rs[XTglUjian]";
								$kelas = "$rs[XKodeKelas]";
								$jurus = "$rs[XKodeJurusan]";
								$proktor = "$rs[XProktor]";
								$nipp = "$rs[XNIPProktor]";
								$pengawas = "$rs[XPengawas]";
								$nip = "$rs[XNIPPengawas]";
								$cat = "$rs[XCatatan]";
								$sesi = "$rs[XSesi]";
								
								$timestamp = strtotime($tanggal);								
								$hari = date('l', $timestamp);
								$tgl = date('d', $timestamp);
								$bln = date('F', $timestamp);
								$bln2 = date('m', $timestamp);
								$thn = date('Y', $timestamp);
								$jamawal = $rs['XJamUjian'];
								$j1 = substr($jamawal,0,2);
								$m1 = substr($jamawal,3,2);
								$d1 = substr($jamawal,6,2); // pecah xmulaiujian ambil dari jamsekarang
								$jam1 = "$j1:$m1";								
	
	
$j2 = substr($rs['XLamaUjian'],0,2);
$m2 = substr($rs['XLamaUjian'],3,2);
$d2 = substr($rs['XLamaUjian'],6,2);
$selectedTime = "$j1:$m1:$d1";

$j3 = $j2*60;
$m3 = $m2;
$jummenit = $j3+$m3;
$jum_menit = "+$j2 hour +$m2 minutes";

$minutes_to_add = $jum_menit;

//set timezone
//date_default_timezone_set('GMT');

//set an date and time to work with
$start = "$thn-$bln2-$tgl $j1:$m1:$d1";
//display the converted time
$habis = date('H:i',strtotime($jum_menit,strtotime($start)));

if(!$kelas=="ALL"&&!$jurus=="ALL"){ 
$kondisi = "1";
$cekQuery = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM cbt_siswa where XKodeKelas = '$kelas' and XKodeJurusan = '$jurus'");
}elseif(!$kelas=="ALL"&&$jurus=="ALL"){ 
$kondisi = "2";
$cekQuery = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM cbt_siswa where  XKodeKelas = '$kelas'");
}elseif($kelas=="ALL"&&!$jurus=="ALL"){ 
$kondisi = "3";
$cekQuery = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM cbt_siswa where  XKodeJurusan = '$jurus'");
}elseif($kelas=="ALL"&&$jurus=="ALL"){ 
$kondisi = "4";
$cekQuery = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM cbt_siswa");
} else {
$kondisi = "5";
$cekQuery = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM cbt_siswa where XKodeKelas = '$kelas' and XKodeJurusan = '$jurus'");
}

$ikutSiswa = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM cbt_siswa_ujian where XTokenUjian = '$rs[XTokenUjian]'");


$jumlahSiswaSemua = mysqli_num_rows($cekQuery);
$jumlahSiswaUjian = mysqli_num_rows($ikutSiswa);
$jumlahSiswaAbsen = $jumlahSiswaSemua-$jumlahSiswaUjian;
?>
	<div id="chart"></div>
	<div class="page">	
    <table border="0" width="100%">
		<tbody>
			<tr>
							<?php
							
								//Our YYYY-MM-DD date string.
								if($hari=='Sunday'){$hari = "Minggu";}
								elseif($hari=='Monday'){$hari = "Senin";}
								elseif($hari=='Tuesday'){$hari = "Selasa";}
								elseif($hari=='Wednesday'){$hari = "Rabu";}
								elseif($hari=='Thursday'){$hari = "Kamis";}
								elseif($hari=='Friday'){$hari = "Jum'at";}
								elseif($hari=='Saturday'){$hari = "Sabtu";}
								
								if($bln=='January'){$bln = "Januari";}
								elseif($bln=='February'){$bln = "Pebruari";}
								elseif($bln=='March'){$bln = "Maret";}
								elseif($bln=='April'){$bln = "April";}
								elseif($bln=='May'){$bln = "Mei";}
								elseif($bln=='June'){$bln = "Juni";}
								elseif($bln=='July'){$bln = "Juli";}
								elseif($bln=='August'){$bln = "Agustus";}
								elseif($bln=='September'){$bln = "September";}
								elseif($bln=='Octocber'){$bln = "Oktober";}
								elseif($bln=='November'){$bln = "Nopember";}
								elseif($bln=='December'){$bln = "Desember";}
						?>                                
				<td width="100" ><img src="images/tut.jpg" height="90"></td>
				<td><center><strong class="f12">BERITA ACARA PELAKSANAAN
										<br>UJIAN SEKOLAH BERBASIS KOMPUTER (USBK)
										<br><?php echo $namsek; ?>
										<br>TAHUN PELAJARAN : <?php echo $_COOKIE['beetahun']; ?></strong></center></td>
				<td width="100"><img src="../../images/<?php echo "$logsek"; ?>" height="90"></td>
			</tr>
		</tbody>
	</table>
  <br><br>
  
   
   <!-- <tr>

   								 <?php 
								$sqk2 = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_mapel where XKodeMapel = '$rs[XKodeMapel]'");
								$rs1 = mysqli_fetch_array($sqk2);
                             	$rs2 = strtoupper("$rs1[XNamaMapel]");
								$NilaiKKM2 = $rs1['XKKM'];
								?>   
    <td width="20%">Mata Pelajaran</td><td>: <b><?php echo $rs2; ?> (Nilai KKM : <?php echo $NilaiKKM2; ?>)</b></td>
    </tr>
    <tr>
    <td>Kelas | Jurusan</td><td>: <b><?php echo $rs['XKodeKelas']; ?> | <?php echo $rs['XKodeJurusan']; ?></b></td>
    </tr>

  <tr>
    <td>Tahun Akademik </td><td>: <?php echo $_COOKIE['beetahun']; ?></td>
  </tr>
  
  !-->
	<table class="cetakan">
				<tbody><tr>
					<td style="text-align:justify;">
					Pada hari ini <span><?php echo $hari; ?></span> tanggal <span><?php echo $tgl; ?></span>
					 bulan <span><?php echo $bln; ?></span> tahun <span ><?php echo $thn; ?></span>, di <?php echo "$namsek"; ?> <?php echo "$xkab"; ?>
					telah diselenggarakan Ujian Sekolah Berbasis Komputer (USBK), untuk Mata Pelajaran <span><?php echo $rs2; ?></span> dari pukul
					<?php echo $jam1; ?> sampai dengan pukul <?php echo $habis; ?>.
					</td>
					</tr>
				</tbody>
	</table>
					
	<table class="cetakan full">
		<tbody><tr>
					<td width="30px" rowspan="8" valign="top">1.</td>
					<td width="200px">Username</td>
					<td width="10px">:</td>
					<td><span class="full"><?php echo "$ad[XKodeSekolah]"; ?></span></td>
				</tr>
				<tr>
					<td>Sekolah/Madrasah</td>
					<td>:</td>
					<td><span class="full"><?php echo "$namsek"; ?></span></td>
				</tr>
				<tr>
					<td>Sesi</td>
					<td>:</td>
					<td><span class="full"><?php echo "$rs[XSesi]"; ?></span></td>
				</tr>
				<tr>
					<td>Jumlah Peserta Seharusnya</td>
					<td>:</td>
					<td><span class="full"><?php echo "$jumlahSiswaSemua"; ?></span></td>
				</tr>
				<tr>
					<td>Jumlah Hadir (Ikut Ujian)</td>
					<td>:</td>
					<td><span class="full"><?php echo "$jumlahSiswaUjian"; ?></span></td>
				</tr>
				<tr>
					<td>Jumlah Tidak Hadir</td>
					<td>:</td>
					<td><span class="full"><?php echo "$jumlahSiswaAbsen"; ?></span></td>
				</tr>
				<tr>
					<td>Username Tidak Hadir</td>
					<td>:</td>
					<td><span class="full">&nbsp;</span></td>
				</tr>
			</tbody></table>
			<table class="detail" width="100%">
				<tbody><tr>
					<td width="30px" rowspan="6" valign="top">2.</td>
					<td>Catatan selama Ujian Sekolah Berbasis Komputer (USBK) :</td>
				</tr>
				<tr height="25px"><td style="border-bottom:solid 1px #000"><?php echo "$rs[XCatatan]"; ?></td></tr>
				<tr height="25px"><td style="border-bottom:solid 1px #000">&nbsp;</td></tr>
				<tr height="25px"><td style="border-bottom:solid 1px #000">&nbsp;</td></tr>
				<tr height="25px"><td style="border-bottom:solid 1px #000">&nbsp; </td></tr>
				<tr height="25px"><td style="border-bottom:solid 1px #000">&nbsp;</td></tr>
			</tbody></table>
			<table class="detail">
				<tbody><tr height="80px">
					<td colspan="4">Yang membuat berita acara :</td>
				</tr>
				<tr align="center" style="font-weight:bold">
					<td width="200px" colspan="2"></td>
					<td width="200px"></td>
					<td width="200px">TTD</td>
				</tr>
				<tr>
					<td rowspan="2" valign="top">1.</td>
					<td>Proktor</td>
					<td valign="bottom"><span style="width:170px"><?php echo $proktor; ?>&nbsp;</span></td>
					<td rowspan="2" valign="middle" align="center">1.<span style="width:170px;float:right">&nbsp;</span></td>
				</tr>
				<tr><td>NIP</td><td valign="bottom"><span style="width:170px"><?php echo $nipp; ?>&nbsp;</span></td></tr>
				<tr>
					<td rowspan="2" valign="top">2.</td>
					<td>Pengawas</td>
					<td valign="bottom"><span style="width:170px"><?php echo $pengawas; ?>&nbsp;</span></td>
					<td rowspan="2" valign="middle" align="center">2.<span style="width:170px;float:right">&nbsp;</span></td>
				</tr>
				<tr><td>NIP</td><td valign="bottom"><span style="width:170px"><?php echo $nip; ?>&nbsp;</span></td></tr>
				<tr>
					<td rowspan="2" valign="top">3.</td>
					<td>Kepala Sekolah</td>
					<td valign="bottom"><span style="width:170px"><?php echo $ad['XKepSek']; ?>&nbsp;</span></td>
					<td rowspan="2" valign="middle" align="center">3.<span style="width:170px;float:right">&nbsp;</span></td>
				</tr>
				<tr><td>NIP</td><td valign="bottom"><span style="width:170px"><?php echo $ad['XNIPKepsek']; ?>&nbsp;</span></td></tr>
			</tbody></table>
			<br><br>
			<table style="border:solid 1px black" class="cetakan">
			<tbody><tr>
				<td style="border-bottom:1px solid black"><i><b>Catatan:</b></i></td>
			</tr>
			<tr>
				<td>
					<ul style="list-style-type:none;">
						<li style="font-size:12px">- Dibuat rangkap 3 (tiga), masing-masing untuk Sekolah, Kota/Kabupaten dan Provinsi
						</li><li style="font-size:12px">- Untuk pusat di upload melalui web UNBK
					</li></ul>
				</td>
			</tr>
			</tbody></table><br><br>
			<div class="footer">
				<table width="100%" height="30">
				<tbody><tr>
					<td width="25px" style="border:1px solid black"></td>
					<td width="5px">&nbsp;</td>
					<td style="border:1px solid black;font-weight:bold;font-size:14px;text-align:center;">UJIAN BERBASIS KOMPUTER - <?php echo "$namsek"; ?></td>
					<td width="5px">&nbsp;</td>
					<td width="25px" style="border:1px solid black"></td>
				</tr>
				</tbody></table>
			</div>
		</div>
	
	<script>
		$('.rekap-grid').find('td').each(function(){
			if($(this).html() == '0'){
				$(this).html('');
			}
		});
	</script>
 
</body>
</html>