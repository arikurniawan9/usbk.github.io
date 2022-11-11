<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
?>
<html>
<head>
<title><?php echo $skull; ?>-CBT | Administrator</title>

        
		<link href="/it-framework.css" rel="stylesheet" type="text/css"/>
		<link href="/it-framework-kurikulum.css" rel="stylesheet" type="text/css"/>
		<link href="/admin.min.css" rel="stylesheet" type="text/css"/>
		<link rel="stylesheet" href="cetak.min.css">
		<script type="text/javascript" src="../js/jquery.js"></script>
		<script type="text/javascript" src="jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="jquery.qrcode-0.12.0.min.js"></script>
		<script type="text/javascript" src="jquery.scrollbar.min.js"></script>
		<script type="text/javascript" src="jquery-1.4.js"></script>
		<script src="date/jquery.js"></script>
		<script src="jquery.datetimepicker.full.js"></script>
		<script type="text/javascript" src="jquery.gdocsviewer.min.js"></script> 
		
		<style>@media print {
			footer {page-break-after: always;}
		}
		</style>
		
		<script type="text/javascript"> 
		/*<![CDATA[*/
		$(document).ready(function() {
			$('a.embed').gdocsViewer({width: 600, height: 750});
			$('#embedURL').gdocsViewer();
		});
		/*]]>*/
		</script> 

<script src="jquery-1.8.3.min.js" type="text/JavaScript" language="javascript"></script>
<script src="jquery.PrintArea.js" type="text/JavaScript" language="javascript"></script>
<script>
        (function($) {
            // fungsi dijalankan setelah seluruh dokumen ditampilkan
            $(document).ready(function(e) {
                 
                // aksi ketika tombol cetak ditekan
                $("#cetak").bind("click", function(event) {
                    // cetak data pada area <div id="#data-mahasiswa"></div>
                    $('#page').printArea();
                });
            });
        }) (jQuery);
    </script>
<style>
.scroll{
  width: auto;
  background: #dddddd;
  border: #999999 1px solid
  padding: 10px;
  overflow: scroll;
  height: 550px;

}
</style>
		



</head>
<body>
<div class="portlet light ">
	    <div class="portlet-title">
			 <div class="caption">
			 <i class="fa fa-print"></i> | Daftar Hadir
			 </div>
					<div class="actions">
						<button id="cetak" class="btn btn-danger btn-sm"  style="margin-top:4px; margin-bottom:5px"><i class="fa fa-print"></i> Print </button>
						<a href="#" data-toggle="modal" data-target="#myDaftarHadir">
							<button type="button" class="btn btn-success btn-sm" style="margin-top:5px; margin-bottom:5px">
								<i class="fa fa-search"></i> Print Daftar Hadir  Kelas Lain</i>
							</button>
						</a>
						
						<a href="?">
								<button type="button" class="btn btn-success btn-sm" style="margin-top:5px; margin-bottom:5px">
									<i class="fa fa-home fa-fw"></i> Dashboard</i>
								</button>
						</a>	
					</div>
		</div>






<div class="scroll"  id="page">

<?php
//koneksi database
include "../../config/server.php";
$BatasAwal = 50;
 if(isset($_REQUEST['iki1'])){ 
$cekQuery = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM cbt_siswa where XKodeKelas = '$_REQUEST[iki1]' and  XKodeJurusan = '$_REQUEST[jur1]'  and  XSesi = '$_REQUEST[sesi1]' and  XRuang = '$_REQUEST[ruang1]'  ");
}else{
$cekQuery = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM cbt_siswa ");
}
$sqlad = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_admin");
$ad = mysqli_fetch_array($sqlad);
$namsek = strtoupper($ad['XSekolah']);
$kepsek = $ad['XKepSek'];
$logsek = $ad['XLogo'];
$tes = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_tes WHERE XKodeUjian='$_REQUEST[jenisuji]'");
$tes4 = mysqli_fetch_array($tes);
								
								$tanggal = date('m/d/y', strtotime($_REQUEST['tanggal1']));		
															
								$timestamp = strtotime($tanggal);								
								$hari = date('l', $timestamp);
								$tgl = date('d', $timestamp);
								$bln = date('F', $timestamp);
								$thn = date('Y', $timestamp);
								
$jumlahData = mysqli_num_rows($cekQuery);
$jumlahn = 20;
$n = ceil($jumlahData/$jumlahn);
$nomz = 1;
for($i=1;$i<=$n;$i++){ ?>
	<div class="page">	
    <table width="100%">
		<tbody>
        	 <tr>
			 <?php
							
								//Our DD-MM-YYYY date string.
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
								elseif($bln=='October'){$bln = "Oktober";}
								elseif($bln=='November'){$bln = "Nopember";}
								elseif($bln=='December'){$bln = "Desember";}
								
																?>    
    <td width="100" ><img src="images/tut.jpg" height="90"></td>
					<td>
					<center><strong class="f12">DAFTAR HADIR PESERTA
					<br><?php echo strtoupper($tes4['XNamaUjian']); ?> BERBASIS KOMPUTER
					<br><?php echo $namsek; ?>
					<br>TAHUN PELAJARAN : <?php echo $_COOKIE['beetahun']; ?></strong>
	
					</center></td>
					<td width="100"><img src="../../images/<?php echo "$logsek"; ?>" class="img-responsive"></td>
	
	
			</tr>
		</tbody>
	</table>
  <br>
<table class="detail" width="100%">
  <tbody>
  <tr>
  <td>MATA PELAJARAN</td><td >:</td>
  <td><span style="width:300px"><?php echo "$_REQUEST[mapel1]"; ?> </span></td>
  <td>SESI / RUANG</td><td>:</td>
  <td><span style="width:100px"><?php echo "$_REQUEST[sesi1]"; ?> - <?php echo "$_REQUEST[ruang1]"; ?></span></td>
  </tr>
  
  <tr>
  <td>HARI</td><td>:</td>
  <td><span style="width:100px"><?php echo $hari; ?></span> TANGGAL : <span style="width:130px"><?php echo $tgl; ?> <?php echo $bln; ?> <?php echo $thn; ?></span></td>
  <td>PUKUL</td><td>:</td>
  <td><span style="width:100px"><?php echo "$_REQUEST[mulai1]"; ?> - <?php echo "$_REQUEST[akhir1]"; ?></span></td>
  </tr>
  </tbody>
</table>
  
<table class="it-grid it-cetak" width="100%">
				<tbody>
				<tr color="#C4BC96" style="height:30px">
					<th width="20px"><center>No.</center></th>
					<th width="100px"><center>No. Ujian</center></th>
					<th width="250px"><center>Nama Peserta</center></th>
					<th width="250px"><center>Tanda Tangan</center></th>
					<th width="100px"><center>Ket.</center></th>
				</tr>
<?php
$mulai = $i-1;
$batas = ($mulai*$jumlahn);
$startawal = $batas;
$batasakhir = $batas+$jumlahn;

$s = $i-1;

?>
<?php
 if(isset($_REQUEST['iki1'])){ 
$cekQuery1 = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM cbt_siswa where XKodeKelas = '$_REQUEST[iki1]' and  XKodeJurusan = '$_REQUEST[jur1]'  and  XSesi = '$_REQUEST[sesi1]' and  XRuang = '$_REQUEST[ruang1]' limit $batas,$jumlahn");
}else{
$cekQuery1 = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM cbt_siswa limit $batas,$jumlahn");
}
while($f= mysqli_fetch_array($cekQuery1)){
 if ($nomz % 2 == 0) {
	  echo "
	  <tr>
	  <td align='center'>$nomz.</td>
	  <td align='center'>$f[XNomerUjian]</td>
	  <td align='left'>$f[XNamaSiswa]</td>
	  <td align='left'>$nomz.</td>
	  <td align='center'></td></tr>";
	  } else {
	  echo "<tr>
	  <td align='center'>$nomz.</td>
	  <td align='center'>$f[XNomerUjian]</td>
	  <td align='left'>$f[XNamaSiswa]</td>
	  <td align='center'>$nomz.</td>
	  <td align='left'>&nbsp;</td></tr>";
	  }
  $nomz++;
?>
<?php } ?>        
 </tbody>       
</table>

<table width="100%">
	<tbody>
	<tr>
	<td><strong><i>Keterangan : </i></strong></td></tr>
	<tr><td>1. Daftar Hadir dibuat rangkap 2 (dua), masing-masing untuk sekolah dan Dinas Kota/kab.</td></tr>
	<tr><td>2. Pengawas ruang menyilang Nama Peserta yang tidak hadir.</td>
	</tr>
	</tbody>
</table>

<table width="100%">
			<tbody>
			<tr>
				<td>
					<table style="border:1px solid black">
					<tbody><tr>
						<td>Jumlah Peserta yang Seharusnya Hadir</td>
						<td>:</td>
						<td>_____ orang</td>
					</tr>
					<tr>
						<td>Jumlah Peserta yang Tidak Hadir</td>
						<td>:</td>
						<td>_____ orang</td>
					</tr>
					<tr style="border-top:1px solid black">
						<td>Jumlah Peserta Hadir</td>
						<td>:</td>
						<td>_____ orang</td>
					</tr>
					</tbody></table>
				</td>
				<td align="center" width="200">
					Proktor<br><br><br><br><br>(<nip></nip>)<br><br>&nbsp;&nbsp;&nbsp;&nbsp;NIP. <nip></nip>
				</td>
				<td align="center" width="175">
					Pengawas<br><br><br><br><br>(<nip></nip>)<br><br>&nbsp;&nbsp;&nbsp;&nbsp;NIP. <nip></nip>
				</td>
			</tr>
			</tbody>
</table>			
			
		<br>
		<br>

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
</div>
</div>
</div>   
</body>
</html>
