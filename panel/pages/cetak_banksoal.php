<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<link rel="stylesheet" href="cetak.min.css">
<script type="text/javascript" src="jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="jquery.qrcode-0.12.0.min.js"></script>
<script type="text/javascript" src="jquery.scrollbar.min.js"></script>
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
  
 
  <script type="text/javascript"
  src="../../mesin/MathJax/MathJax.js?config=AM_HTMLorMML-full"></script>

<!-- script untuk refresh/reload mathjax setiap content baru !-->
   <script>
  MathJax.Hub.Queue(["Typeset",MathJax.Hub]);
</script>
<!-- script untuk refresh/reload mathjax setiap content baru !-->
<body>

		<div class="portlet ">
	    <div class="portlet-title">
			 <div class="caption">
			 <i class="fa fa-print"></i> | Cetak Soal
			 </div>
					<div class="actions">
						<button id="cetak" class="btn btn-danger btn-sm"  style="margin-top:4px; margin-bottom:5px"><i class="fa fa-print"></i>Cetak Bank Soal</button>
						<a href="?modul=daftar_soal">
							<button type="button" class="btn btn-success btn-sm" style="margin-top:5px; margin-bottom:5px">
								<i class="fa fa-search"></i> Kembali ke Daftar Bank Soal</i>
							</button>
						</a>
						
						<a href="?">
								<button type="button" class="btn btn-success btn-sm" style="margin-top:5px; margin-bottom:5px">
									<i class="fa fa-home fa-fw"></i> Dashboard</i>
								</button>
						</a>	
					</div>
		</div>
		</div>
		
<div class="scroll"  id="page">


<?php
include "../../config/server.php";
include "../../config/fungsi_tgl.php";
?>

<?php
$var_soal = "$_REQUEST[idsoal]";

$sql0 = mysqli_query($GLOBALS["___mysqli_ston"], "select m.*, p.*,k.*, p.XKodeJurusan as XKodeJurusan, p.XKodeKelas as XKodeKelas, p.XTglBuat as TglBuat from cbt_paketsoal p 
		LEFT JOIN cbt_mapel m on m.XKodeMapel = p.XKodeMapel 
		LEFT JOIN cbt_kelas k ON k.XKodeKelas = p.XKodeKelas
	
		where p.XKodeSoal = '$var_soal'"); 
$p = mysqli_fetch_array($sql0);
$namamapel = $p['XNamaMapel'];
$kodesoal = $p['XKodeSoal'];
$namakelas=$p['XKodeKelas'];

$namaguru=$p['XGuru'];
$tglbuat=indonesian_date($p['TglBuat']);
$kodekelas = $p['XKodeKelas'];
$kodejurusan = $p['XKodeJurusan'];

if($kodekelas=="ALL") {
	$kelas="ALL";
} else {
	$kelas=$namakelas;
};

if($kodejurusan=="ALL") {
	$jurusan="ALL";
} else {$jurusan=$kodejurusan;};

$sql1 = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT Nama FROM cbt_user WHERE Username='$namaguru'");
$u=mysqli_fetch_array($sql1);
$namapembuat = $u['Nama'];

$sqladmin = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM cbt_admin");
$s = mysqli_fetch_array($sqladmin);
$logo = $s['XLogo'];
$namasekolah =$s['XSekolah'];
 $skul = $s['XTingkat'];
if ($skul=="SMA" || $skul=="MA"||$skul=="STM"){$rombel="Jurusan";}else{$rombel="Rombel";}
	
if(str_replace(" ","",$logo)==""){
$logo = "tut.jpg";} else { $foto = "$logo";}
?>

			<div class="page">	
				<table width="100%">
					<tbody>
						 <tr>
							<td width="100" ><img src="images/tut.jpg" height="90"></td>
							<td>
							<center><strong class="f12">DAFTAR SOAL
							<br>UJAIAN SEKOLAH  BERBASIS KOMPUTER
							<br><?php echo $namasekolah; ?>
							<br>TAHUN PELAJARAN : <?php echo $_COOKIE['beetahun']; ?></strong>
							</center></td>
							<td width="100"><img src="../../images/<?php echo $logo; ?>" class="img-responsive"></td>
			
			
						</tr>
					</tbody>
				</table>
			
				<br>
				<table class="detail" width="100%">
				  <tbody>
				  <tr>
				  <td>Mata Pelajaran</td><td >:</td>
				  <td><span style="width:230px"><?php echo "$namamapel"; ?></span></td>
				  <td>Kode Soal</td><td >:</td>
				  <td><span style="width:100px"><?php echo "$kodesoal"; ?></span></td>
				  </tr>
				  <tr>
				  <td>Kelas</td><td>:</td>
				  <td><span style="width:230px"><<?php echo "$kelas"; ?></span></td>
				  <td>Rombel</td><td>:</td>
				  <td><span style="width:100px"><<?php echo "$jurusan "; ?></span></td>
				  </tr>
				  <tr>
				  <td>Pembuat Soal</td><td>:</td>
				  <td><span style="width:230px"><?php echo $namapembuat; ?></span> </td>
				  <td>Tanggal Pembuatan </td><td>:</td> 
				  <td><span style="width:100px"><?php echo $tglbuat; ?></span></td>
				  </tr>
				  <tr>
				  <td>Satuan Pendidikan</td><td>:</td>
				  <td><span style="width:300px"><?php echo $namasekolah; ?></span></td>
				  </tr>
				  </tbody>
				</table>
		
		
		
		
		
		
<!--		
		
<div class="group">
        <div class="panel panel-default">
			<div class="panel-heading">
				<iframe src="<?php echo "print_banksoal.php?idsoal=$_REQUEST[idsoal]"?>" style="display:none;" name="frame"></iframe>
				<a href="?modul=daftar_soal">
					<button type="button" class="btn btn-default btn-small" style="margin-top:5px; margin-bottom:5px">
						<i class="fa fa-arrow-circle-left"></i> Kembali ke Daftar Bank Soal</i>
					</button>
				</a>
				<button type="button" class="btn btn-warning btn-small" onClick="frames['frame'].print()" style="margin-top:5px; margin-bottom:5px">
					<i class="glyphicon glyphicon-print"></i> Cetak Bank Soal
				</button>
				
            </div>
            
			<div class="panel-body">
				<table width="100%" border="0">
					<tr>
					<h3 class="panel-title" align="center">DATA BANK SOAL</h3>					
					</tr>
					<br/>
					<tr>
						<td rowspan="5" width="150">
							<img src="../../images/<?php echo $logo; ?>" width="78%" height="70" />                         </div></td>
						<td width=300>Mata Pelajaran | Kode Soal</td>
						<td >: &nbsp;<?php echo "$namamapel | $kodesoal"; ?></td>                
					</tr>
					<tr>
						<td>Kelas - <?php echo $rombel;?> </td>
						<td>: &nbsp;
						<?php echo "$kelas - $jurusan "; ?></td>
					</tr>
					<tr>
						<td>Pembuat Soal</td>
						<td>: &nbsp;<?php echo $namapembuat; ?></td>
					</tr>
					<tr>
						<td>Tanggal Pembuatan</td>
						<td>: &nbsp;<?php echo $tglbuat; ?></td>
					</tr>
					<tr>
						<td>Satuan Pendidikan</td>
						<td>: &nbsp;<?php echo $namasekolah; ?></td>
					</tr>
				</table>
		  </div>
        </div>  
</div>
-->
<br><br>


<link href="../../mesin/dist/skin/blue.monday/css/jplayer.blue.monday.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../mesin/lib/jquery.min.js"></script>
<script type="text/javascript" src="../../mesin/dist/jplayer/jquery.jplayer.min.js"></script>

	<table class="cetakan">
		<tbody><tr>Soal Pilihan Ganda </td></tr></tbody>
	</table>
	<br>

			<?php
			$nomer = 1;
			$sql = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM cbt_soal s 
					LEFT JOIN cbt_paketsoal p ON p.XKodeSoal = s. XKodeSoal  
					WHERE p.XKodeSoal = '$var_soal' order by XNomerSoal");				
			while($sp = mysqli_fetch_array($sql)){	
				$jumpil = $sp['XJumPilihan'];
				$js = $sp['XJenisSoal'];
				
				if(!$sp['XGambarTanya']=='')
				{
					$gambarsoalnye = "<br><br><img src='../../pictures/$sp[XGambarTanya]'  align=center><br>";
				}
				else
				{
					$gambarsoalnye = "";
				}
				if(!$sp['XAudioTanya']=='')
				{
					$audiosoalnye = "$sp[XAudioTanya]<br>";} else {$audiosoalnye = "";
				}
				if(!$sp['XVideoTanya']=='')
				{
					$videosoalnye = "$sp[XVideoTanya]<br>";
				} 
				else 
				{
					$videosoalnye = "";
				}
				
				if(str_replace(" ","",$sp['XGambarJawab1'])=='')
				{
					$ambilfile1 = "";
				}
				else
				{
					if(file_exists("../../pictures/$sp[XGambarJawab1]"))
					{
						$ambilfile1 = "<img src=../../pictures/$sp[XGambarJawab1] >";
					} 
					else
					{
						$ambilfile1 = "<img src=../../images/kross.png> $sp[XGambarJawab1] tidak belum diUpload";
					}
				}
				
				if(str_replace(" ","",$sp['XGambarJawab2'])=='')
				{
					$ambilfile2 = "";
				}
				else
				{
					if(file_exists("../../pictures/$sp[XGambarJawab2]"))
					{
						$ambilfile2 = "<img src=../../pictures/$sp[XGambarJawab2] >";
					} 
					else
					{
						$ambilfile2 = "<img src=../../images/kross.png> $sp[XGambarJawab2] tidak belum diUpload";
					}
				}
				if(str_replace(" ","",$sp['XGambarJawab3'])=='')
				{
					$ambilfile3 = "";
				}
				else
				{
					if(file_exists("../../pictures/$sp[XGambarJawab3]"))
					{
						$ambilfile3 = "<img src=../../pictures/$sp[XGambarJawab3] >";
					} 
					else
					{
						$ambilfile3 = "<img src=../../images/kross.png> $sp[XGambarJawab3] tidak belum diUpload";
					}
				}
				if(str_replace(" ","",$sp['XGambarJawab4'])=='')
				{
					$ambilfile4 = "";
				}
				else
				{
					if(file_exists("../../pictures/$sp[XGambarJawab4]"))
					{
						$ambilfile4 = "<img src=../../pictures/$sp[XGambarJawab4] >";
					} 
					else
					{
						$ambilfile4 = "<img src=../../images/kross.png> $sp[XGambarJawab4] tidak belum diUpload";
					}
				}
				
				if(str_replace(" ","",$sp['XGambarJawab5'])=='')
				{
					$ambilfile5 = "";
				}
				else
				{
					if(file_exists("../../pictures/$sp[XGambarJawab5]"))
					{
						$ambilfile5 = "<img src=../../pictures/$sp[XGambarJawab5] >";
					} 
					else
					{
						$ambilfile5 = "<img src=../../images/kross.png> $sp[XGambarJawab5] tidak belum diUpload";
					}
				}
				
				if($js=='2')
				{
					$katsoal = "Esai/Uraian";
									//echo "<p>Pertanyaan : $_REQUEST[jum] asdasd $xadm[Urut] $js</p>";		
					$soalnye = strip_tags($sp['XTanya']);							
					echo "<p>$soalnye</p>
						 <p>$gambarsoalnye</p>";
				}
				
				elseif($jumpil=='3'){ 						
					//$katsoal = "Pilihan Ganda (3 Pilihan Jawaban)";<p>Pertanyaan : $katsoal dengan Opsi Jawaban $_REQUEST[jum]</p>
						if($sp['XKunciJawaban']=='1'){$kunci1 = "<img src='../../images/benar.png' width=20px>";} else {$kunci1="";}
						if($sp['XKunciJawaban']=='2'){$kunci2 = "<img src='../../images/benar.png' width=20px>";} else {$kunci2="";}
						if($sp['XKunciJawaban']=='3'){$kunci3 = "<img src='../../images/benar.png' width=20px>";} else {$kunci3="";}
										

							$Jawab1 = str_replace("<p>","",$sp['XJawab1']);
							$Jawab1 = str_replace("</p>","",$Jawab1);		
							$Jawab1 = str_replace("<h1>","",$Jawab1);		
							$Jawab1 = str_replace("</h1>","",$Jawab1);		
							$Jawab1 = str_replace("<h2>","",$Jawab1);		
							$Jawab1 = str_replace("</h2>","",$Jawab1);		
							$Jawab1 = str_replace("<h3>","",$Jawab1);		
							$Jawab1 = str_replace("</h3>","",$Jawab1);		
							/* $Jawab1 = str_replace("<span class='fontstyle0'>","",$Jawab1);	
							$Jawab1 = str_replace("</span>","",$Jawab1); */
							$Jawab1 = str_replace("<br /><br />","",$Jawab1);
									
							$Jawab2 = str_replace("<p>","",$sp['XJawab2']);
							$Jawab2 = str_replace("</p>","",$Jawab2);		
							$Jawab2 = str_replace("<h1>","",$Jawab2);		
							$Jawab2 = str_replace("</h1>","",$Jawab2);		
							$Jawab2 = str_replace("<h2>","",$Jawab2);		
							$Jawab2 = str_replace("</h2>","",$Jawab2);		
							$Jawab2 = str_replace("<h3>","",$Jawab2);		
							$Jawab2 = str_replace("</h3>","",$Jawab2);		
							/* $Jawab2 = str_replace("<span class='fontstyle0'>","",$Jawab2);	
							$Jawab2 = str_replace("</span>","",$Jawab2); */
							$Jawab2 = str_replace("<br /><br />","",$Jawab2);
									
							$Jawab3 = str_replace("<p>","",$sp['XJawab3']);
							$Jawab3 = str_replace("</p>","",$Jawab3);		
							$Jawab3 = str_replace("<h1>","",$Jawab3);		
							$Jawab3 = str_replace("</h1>","",$Jawab3);		
							$Jawab3 = str_replace("<h2>","",$Jawab3);		
							$Jawab3 = str_replace("</h2>","",$Jawab3);		
							$Jawab3 = str_replace("<h3>","",$Jawab3);		
							$Jawab3 = str_replace("</h3>","",$Jawab3);		
							/* $Jawab3 = str_replace("<span class='fontstyle0'>","",$Jawab3);	
							$Jawab3 = str_replace("</span>","",$Jawab3); */
							$Jawab3 = str_replace("<br /><br />","",$Jawab3);									


							$soalnye=$sp['XTanya'];	
							$soalnye = str_replace("<p>","",$soalnye);	
							$soalnye = str_replace("</p>","",$soalnye);	
							$soalnye = str_replace("font-size: 24px;","",$soalnye);		
							$soalnye = str_replace("<h1>","",$soalnye);		
							$soalnye = str_replace("</h1>","",$soalnye);		
							$soalnye = str_replace("<h2>","",$soalnye);		
							$soalnye = str_replace("</h2>","",$soalnye);		
							$soalnye = str_replace("<h3>","",$soalnye);		
							$soalnye = str_replace("</h3>","",$soalnye);	
							/* $soalnye = str_replace("<span class='fontstyle0'>","",$soalnye);	
							$soalnye = str_replace("</span>","",$soalnye); */
							//$soalnye = str_replace("`","'",$soalnye);
							$soalnye = str_replace("<p>&nbsp;</p>","",$soalnye);									
								echo "	
									<table width=100% border=0>
										<tr>
											<td width=30px valign=top><p>$nomer.</p></td>
											<td colspan=2 valign=top>$soalnye </td>
											<p>$gambarsoalnye</p>
										</tr>
										<tr>											
											<td width=30px valign=top>&nbsp;</td>
											<td width=20px valign=top>A.</td>
											<td colspan=2 valign=top>$ambilfile1 $Jawab1 $kunci1</td>
										</tr>
										<tr>
											<td width=30px valign=top>&nbsp;</td>
											<td width=20px valign=top>B.</td>
											<td colspan=2 valign=top>$ambilfile2 $Jawab2 $kunci2 </td>
										</tr>
										<tr>
											<td width=30px valign=top>&nbsp;</td>
											<td width=20px valign=top>C.</td>
											<td colspan=2 valign=top>$ambilfile3 $Jawab3 $kunci3</td>
										</tr>
										<br/>
										</table>";
				} 
				elseif($jumpil=='4'){ 						
					//$katsoal = "Pilihan Ganda (4 Pilihan Jawaban)";<p>Pertanyaan : $katsoal dengan Opsi Jawaban $_REQUEST[jum]</p>
						if($sp['XKunciJawaban']=='1'){$kunci1 = "<img src='../../images/benar.png' width=20px>";} else {$kunci1="";}
						if($sp['XKunciJawaban']=='2'){$kunci2 = "<img src='../../images/benar.png' width=20px>";} else {$kunci2="";}
						if($sp['XKunciJawaban']=='3'){$kunci3 = "<img src='../../images/benar.png' width=20px>";} else {$kunci3="";}
						if($sp['XKunciJawaban']=='4'){$kunci4 = "<img src='../../images/benar.png' width=20px>";} else {$kunci4="";}
									
										
							$Jawab1 = str_replace("<p>","",$sp['XJawab1']);
							$Jawab1 = str_replace("</p>","",$Jawab1);		
							$Jawab1 = str_replace("<h1>","",$Jawab1);		
							$Jawab1 = str_replace("</h1>","",$Jawab1);		
							$Jawab1 = str_replace("<h2>","",$Jawab1);		
							$Jawab1 = str_replace("</h2>","",$Jawab1);		
							$Jawab1 = str_replace("<h3>","",$Jawab1);		
							$Jawab1 = str_replace("</h3>","",$Jawab1);		
							/* $Jawab1 = str_replace("<span class='fontstyle0'>","",$Jawab1);	
							$Jawab1 = str_replace("</span>","",$Jawab1); */
							$Jawab1 = str_replace("<br /><br />","",$Jawab1);
									
							$Jawab2 = str_replace("<p>","",$sp['XJawab2']);
							$Jawab2 = str_replace("</p>","",$Jawab2);		
							$Jawab2 = str_replace("<h1>","",$Jawab2);		
							$Jawab2 = str_replace("</h1>","",$Jawab2);		
							$Jawab2 = str_replace("<h2>","",$Jawab2);		
							$Jawab2 = str_replace("</h2>","",$Jawab2);		
							$Jawab2 = str_replace("<h3>","",$Jawab2);		
							$Jawab2 = str_replace("</h3>","",$Jawab2);		
						/* 	$Jawab2 = str_replace("<span class='fontstyle0'>","",$Jawab2);	
							$Jawab2 = str_replace("</span>","",$Jawab2); */
							$Jawab2 = str_replace("<br /><br />","",$Jawab2);
									
							$Jawab3 = str_replace("<p>","",$sp['XJawab3']);
							$Jawab3 = str_replace("</p>","",$Jawab3);		
							$Jawab3 = str_replace("<h1>","",$Jawab3);		
							$Jawab3 = str_replace("</h1>","",$Jawab3);		
							$Jawab3 = str_replace("<h2>","",$Jawab3);		
							$Jawab3 = str_replace("</h2>","",$Jawab3);		
							$Jawab3 = str_replace("<h3>","",$Jawab3);		
							$Jawab3 = str_replace("</h3>","",$Jawab3);		
							// $Jawab3 = str_replace("<span class='fontstyle0'>","",$Jawab3);	
							// $Jawab3 = str_replace("</span>","",$Jawab3);
							$Jawab3 = str_replace("<br /><br />","",$Jawab3);												
									
							$Jawab4 = str_replace("<p>","",$sp['XJawab4']);
							$Jawab4 = str_replace("</p>","",$Jawab4);		
							$Jawab4 = str_replace("<h1>","",$Jawab4);		
							$Jawab4 = str_replace("</h1>","",$Jawab4);		
							$Jawab4 = str_replace("<h2>","",$Jawab4);		
							$Jawab4 = str_replace("</h2>","",$Jawab4);		
							$Jawab4 = str_replace("<h3>","",$Jawab4);		
							$Jawab4 = str_replace("</h3>","",$Jawab4);									
							/* $Jawab4 = str_replace("<span class='fontstyle0'>","",$Jawab4);	
							$Jawab4 = str_replace("</span>","",$Jawab4); */
							$Jawab4 = str_replace("<br /><br />","",$Jawab4);

															
							$soalnye=$sp['XTanya'];	
							$soalnye = str_replace("<p>","",$soalnye);	
							$soalnye = str_replace("</p>","",$soalnye);	
							$soalnye = str_replace("font-size: 24px;"," ",$soalnye);		
							$soalnye = str_replace("<h1>","",$soalnye);		
							$soalnye = str_replace("</h1>","",$soalnye);		
							$soalnye = str_replace("<h2>","",$soalnye);		
							$soalnye = str_replace("</h2>","",$soalnye);		
							$soalnye = str_replace("<h3>","",$soalnye);		
							$soalnye = str_replace("</h3>","",$soalnye);	
							/* $soalnye = str_replace("<span class='fontstyle0'>","",$soalnye);	
							$soalnye = str_replace("</span>","",$soalnye); */
							//$soalnye = str_replace("`","'",$soalnye);
							$soalnye = str_replace("<p>&nbsp;</p>","",$soalnye);										
									echo "	
										<table class='cetakan full'>
										<tbody>
										<tr>
											<td width=30px valign=top><p>$nomer.</p></td>
											<td colspan=2 valign=top>$soalnye </td>
											<p>$gambarsoalnye</p>
										</tr>
										<tr>											
											<td width=30px valign=top>&nbsp;</td>
											<td width=20px valign=top>A.</td>
											<td colspan=2 valign=top>$ambilfile1 $Jawab1 $kunci1</td>
										</tr>
										<tr>
											<td width=30px valign=top>&nbsp;</td>
											<td width=20px valign=top>B.</td>
											<td colspan=2 valign=top>$ambilfile2 $Jawab2 $kunci2 </td>
										</tr>
										<tr>
											<td width=30px valign=top>&nbsp;</td>
											<td width=20px valign=top>C.</td>
											<td colspan=2 valign=top>$ambilfile3 $Jawab3 $kunci3</td>
										</tr>
										<tr>
											<td width=30px>&nbsp;</td>
											<td width=20px valign=top>D.</td>
											<td colspan=2 valign=top>$ambilfile4 $Jawab4 $kunci4 </td>			
										</tr><br/>
										</tbody>
										</table>";
				} 
				elseif($jumpil=='5'){ 
					//$katsoal = "Pilihan Ganda (5 Pilihan Jawaban)";<p>Pertanyaan : $katsoal dengan Opsi Jawaban $_REQUEST[jum]</p>
						if($sp['XKunciJawaban']=='1'){$kunci1 = "<img src='../../images/benar.png' width=20px>";} else {$kunci1="";}
						if($sp['XKunciJawaban']=='2'){$kunci2 = "<img src='../../images/benar.png' width=20px>";} else {$kunci2="";}
						if($sp['XKunciJawaban']=='3'){$kunci3 = "<img src='../../images/benar.png' width=20px>";} else {$kunci3="";}
						if($sp['XKunciJawaban']=='4'){$kunci4 = "<img src='../../images/benar.png' width=20px>";} else {$kunci4="";}
						if($sp['XKunciJawaban']=='5'){$kunci5 = "<img src='../../images/benar.png' width=20px>";} else {$kunci5="";}
																	
									
							$Jawab1 = str_replace("<p>","",$sp['XJawab1']);
							$Jawab1 = str_replace("</p>","",$Jawab1);		
							$Jawab1 = str_replace("<h1>","",$Jawab1);		
							$Jawab1 = str_replace("</h1>","",$Jawab1);		
							$Jawab1 = str_replace("<h2>","",$Jawab1);		
							$Jawab1 = str_replace("</h2>","",$Jawab1);		
							$Jawab1 = str_replace("<h3>","",$Jawab1);		
							$Jawab1 = str_replace("</h3>","",$Jawab1);		
							/* $Jawab1 = str_replace("<span class='fontstyle0'>","",$Jawab1);	
							$Jawab1 = str_replace("</span>","",$Jawab1); */
							$Jawab1 = str_replace("<br /><br />","",$Jawab1);
									
							$Jawab2 = str_replace("<p>","",$sp['XJawab2']);
							$Jawab2 = str_replace("</p>","",$Jawab2);		
							$Jawab2 = str_replace("<h1>","",$Jawab2);		
							$Jawab2 = str_replace("</h1>","",$Jawab2);		
							$Jawab2 = str_replace("<h2>","",$Jawab2);		
							$Jawab2 = str_replace("</h2>","",$Jawab2);		
							$Jawab2 = str_replace("<h3>","",$Jawab2);		
							$Jawab2 = str_replace("</h3>","",$Jawab2);		
							/* $Jawab2 = str_replace("<span class='fontstyle0'>","",$Jawab2);	
							$Jawab2 = str_replace("</span>","",$Jawab2); */
							$Jawab2 = str_replace("<br /><br />","",$Jawab2);
									
							$Jawab3 = str_replace("<p>","",$sp['XJawab3']);
							$Jawab3 = str_replace("</p>","",$Jawab3);		
							$Jawab3 = str_replace("<h1>","",$Jawab3);		
							$Jawab3 = str_replace("</h1>","",$Jawab3);		
							$Jawab3 = str_replace("<h2>","",$Jawab3);		
							$Jawab3 = str_replace("</h2>","",$Jawab3);		
							$Jawab3 = str_replace("<h3>","",$Jawab3);		
							$Jawab3 = str_replace("</h3>","",$Jawab3);		
							/* $Jawab3 = str_replace("<span class='fontstyle0'>","",$Jawab3);	
							$Jawab3 = str_replace("</span>","",$Jawab3); */
							$Jawab3 = str_replace("<br /><br />","",$Jawab3);												
									
							$Jawab4 = str_replace("<p>","",$sp['XJawab4']);
							$Jawab4 = str_replace("</p>","",$Jawab4);		
							$Jawab4 = str_replace("<h1>","",$Jawab4);		
							$Jawab4 = str_replace("</h1>","",$Jawab4);		
							$Jawab4 = str_replace("<h2>","",$Jawab4);		
							$Jawab4 = str_replace("</h2>","",$Jawab4);		
							$Jawab4 = str_replace("<h3>","",$Jawab4);		
							$Jawab4 = str_replace("</h3>","",$Jawab4);									
							/* $Jawab4 = str_replace("<span class='fontstyle0'>","",$Jawab4);	
							$Jawab4 = str_replace("</span>","",$Jawab4); */
							$Jawab4 = str_replace("<br /><br />","",$Jawab4);

									
							$Jawab5 = str_replace("<p>","",$sp['XJawab5']);
							$Jawab5 = str_replace("</p>","",$Jawab5);		
							$Jawab5 = str_replace("<h1>","",$Jawab5);		
							$Jawab5 = str_replace("</h1>","",$Jawab5);		
							$Jawab5 = str_replace("<h2>","",$Jawab5);		
							$Jawab5 = str_replace("</h2>","",$Jawab5);		
							$Jawab5 = str_replace("<h3>","",$Jawab5);		
							$Jawab5 = str_replace("</h3>","",$Jawab5);			
							/* $Jawab5 = str_replace("<span class='fontstyle0'>","",$Jawab5);	
							$Jawab5 = str_replace("</span>","",$Jawab5); */
							$Jawab5 = str_replace("<br /><br />","",$Jawab5);
									
							$soalnye=$sp['XTanya'];	
							$soalnye = str_replace("<p>","",$soalnye);									
							$soalnye = str_replace("</p>","",$soalnye);
							$soalnye = str_replace("font-size: 24px;"," ",$soalnye);
							$soalnye = str_replace("<h1>","",$soalnye);		
							$soalnye = str_replace("</h1>","",$soalnye);		
							$soalnye = str_replace("<h2>","",$soalnye);		
							$soalnye = str_replace("</h2>","",$soalnye);		
							$soalnye = str_replace("<h3>","",$soalnye);		
							$soalnye = str_replace("</h3>","",$soalnye);	
						/* 	$soalnye = str_replace("<span class='fontstyle0'>","",$soalnye);	font-size: 24px;
							$soalnye = str_replace("</span>","",$soalnye); */
							//$soalnye = str_replace("`","'",$soalnye);
							$soalnye = str_replace("<p>&nbsp;</p>","",$soalnye);		
									echo "	
										<table class='cetakan full'>
										<tbody>
										<tr>
											<td width=30px valign=bottom><p>$nomer.</p></td>
											<td colspan=2 valign=bottom>$soalnye</td>
											<p>$gambarsoalnye</p>
										</tr>
										<tr>											
											<td width=30px valign=top>&nbsp;</td>
											<td width=20px valign=top>A.</td>
											<td colspan=2 valign=top>$ambilfile1 $Jawab1 $kunci1 </td>
										</tr>
										<tr>
											<td width=30px valign=top>&nbsp;</td>
											<td width=20px valign=top>B.</td>
											<td colspan=2 valign=top>$ambilfile2 $Jawab2 $kunci2 </td>
										</tr>
										<tr>
											<td width=30px valign=top>&nbsp;</td>
											<td width=20px valign=top>C.</td>
											<td colspan=2 valign=top>$ambilfile3 $Jawab3 $kunci3 </td>
										</tr>
										<tr>
											<td width=30px>&nbsp;</td>
											<td width=20px valign=top>D.</td>
											<td colspan=2 valign=top>$ambilfile4 $Jawab4 $kunci4 </td>	
										<tr>
											<td width=30px>&nbsp;</td>
											<td width=20px valign=top>E.</td>
											<td colspan=2 valign=top>$ambilfile5 $Jawab5 $kunci5 </td>											
										</tr><br/>
										</tbody>
										</table>";
				} 
				
				$nomer++;
			}			

			?>
					
			
	</div>		
	<script>
		$('.rekap-grid').find('td').each(function(){
			if($(this).html() == '0'){
				$(this).html('');
			}
		});
	</script>		
			
	
	
	
</div>

</body>
</html>	
				
