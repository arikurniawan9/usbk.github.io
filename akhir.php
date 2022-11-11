<?php include "config/server.php"; 
// ===============================
// Status Ujian XStatusUjian = 1 Aktif
// Status Ujian XStatusUjian = 0 BelumAktif
// Status Ujian XStatusUjian = 9 Selesai
if(isset($_COOKIE['PESERTA'])){
$user = $_COOKIE['PESERTA'];} else {
header('Location:login.php');}

$tgl = date("H:i:s");
$tgl2 = date("Y-m-d");
				
		$sqltoken = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM `cbt_siswa_ujian` s left join cbt_ujian u on u.XKodeSoal = s.XKodeSoal
		WHERE s.XNomerUjian = '$user' and s.XStatusUjian = '1'");
		$st = mysqli_fetch_array($sqltoken);
		$xtokenujian = $st['XTokenUjian'];  
		
		
		
		$sqlgabung = mysqli_query($GLOBALS["___mysqli_ston"], "
		SELECT * FROM `cbt_siswa_ujian` s LEFT JOIN cbt_jawaban j ON j.XUserJawab = s.XNomerUjian and j.XTokenUjian = s.XTokenUjian left join cbt_siswa s1 on s1.XNomerUjian =
		s.XNomerUjian WHERE s.XNomerUjian = '$user' and s.XStatusUjian = '1'");
		  
		//=======================
		  $s0 = mysqli_fetch_array($sqlgabung);
		  $xkodesoal = $s0['XKodeSoal'];
		  $xtokenujian = $s0['XTokenUjian'];  
		  $xnomerujian = $s0['XNomerUjian'];  
		  $xnik = $s0['XNIK'];    
		  $xkodeujian = $s0['XKodeUjian'];
		  $xkodemapel = $s0['XKodeMapel'];
		  $xkodekelas = $s0['XKodeKelas'];  
		  $xkodejurusan = $s0['XKodeJurusan']; 		
		  $xsemester = $s0['XSemester']; 		  
		  $xnamkel = $s0['XNamaKelas'];
		  
		  $sqlsoal = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM cbt_ujian  WHERE XKodeSoal = '$xkodesoal'");
		  $sa = mysqli_fetch_array($sqlsoal);
		  //$xkodeujian = $sa['XKodeUjian'];
		  $xjumsoal = $sa['XJumSoal'];
		  $xjumpil = $sa['XPilGanda']; 	
		  $xtampil = $sa['XTampil'];
		  
		 $sql4 = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM cbt_mapel  WHERE XKodeMapel = '$xkodemapel'");
		  $km = mysqli_fetch_array($sql4);
		  $kkm = $km['XKKM'];
		  
		  
		  if($xjumsoal>0){

	$sqlnilai = mysqli_query($GLOBALS["___mysqli_ston"], " SELECT * FROM cbt_paketsoal WHERE XKodeSoal = '$xkodesoal'");
	$sqn = mysqli_fetch_array($sqlnilai);
	$per_pil = $sqn['XPersenPil'];	
	$per_esai = $sqn['XPersenEsai'];
	$xesai = $sqn['XEsai'];
	$xpilganda = $sqn['XPilGanda'];
$sqltahun = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_setid where XStatus = '1'");
		$st = mysqli_fetch_array($sqltahun);
		$tahunz = $st['XKodeAY'];
		  
$xjumbenarz = mysqli_query($GLOBALS["___mysqli_ston"], "select count(XNilai) as benar from cbt_jawaban where XUserJawab = '$user' and XJenisSoal = '1' and XKodeSoal = '$xkodesoal' and XTokenUjian = '$xtokenujian' and XNilai = '1'");
		  $r = mysqli_fetch_array($xjumbenarz);
		  $xjumbenar = $r['benar'];
		  $xjumsalah = $xjumpil-$xjumbenar;
		  $nilaix = ($xjumbenar/$xjumpil)*100;
		  if(isset($_COOKIE['beetahun'])){$setAY =$_COOKIE['beetahun'];}else{$setAY = "$tahunz";}
		  
		  //cek apakah nilai untuk token ini sudah ada atau tidak 
		  $sqlceknilai= mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_nilai where XNomerUjian = '$xnomerujian' and XKodeSoal = '$xkodesoal' and XTokenUjian = '$xtokenujian' 
		  and XSemester = '$xsemester' and XSetId = '$setAY' and XKodeMapel = '$xkodemapel' and XNIK = '$xnik'"));
		  
		  if($sqlceknilai>0){
		  $sqlmasuk = mysqli_query($GLOBALS["___mysqli_ston"], "update cbt_nilai set XJumSoal='$xjumsoal',XBenar='$xjumbenar',XSalah='$xjumsalah',XNilai='$nilaix',XTotalNilai=,'$nilaix'
		  where XNomerUjian = '$xnomerujian' and XKodeSoal = '$xkodesoal' and XTokenUjian = '$xtokenujian' and XSemester = '$xsemester' and XSetId = '$setAY' 
		  and XKodeMapel = '$xkodemapel' and XNIK = '$xnik'");
		  } else {
		  $sqlmasuk = mysqli_query($GLOBALS["___mysqli_ston"], "insert into cbt_nilai (
		  XKodeUjian,XTokenUjian,XTgl,XJumSoal,XBenar,XSalah,XNilai,XKodeMapel,XKodeKelas,XKodeSoal,XNomerUjian,XNIK,XSemester,XSetId,XPersenPil,XPersenEsai,XTotalNilai,XPilGanda,XEsai,XNamaKelas) 
		  values 
		  ('$xkodeujian','$xtokenujian','$tgl2','$xjumsoal','$xjumbenar','$xjumsalah','$nilaix','$xkodemapel','$xkodekelas','$xkodesoal','$xnomerujian','$xnik','$xsemester',
		  '$setAY','$per_pil','$per_esai','$nilaix','$xpilganda','$xesai','$xnamkel')");
		  }
					
		  if(isset($xtokenujian)){
		  $sql = mysqli_query($GLOBALS["___mysqli_ston"], "Update cbt_siswa_ujian set XStatusUjian = '9' where XNomerUjian = '$user' and XStatusUjian = '1'  and XTokenUjian = '$xtokenujian'");}
		  $sql = mysqli_query($GLOBALS["___mysqli_ston"], "Update cbt_siswa_ujian set XStatusUjian = '9',XLastUpdate = '$tgl' where XNomerUjian = '$user' and XStatusUjian = '1'");

		  }

?>
<style>
.left {
    float: left;
    width: 70%;
}
.right {
    float: right;
    width: 30%;
	background-color: #333333;
			height:101px;	
		color:#FFFFFF;	
		font-size: 13px; font-style:normal; font-weight:normal;
}
.user {
		color:#FFFFFF;	
		font-size: 15px; font-style:normal; font-weight:bold;
		top:-20px;
}
.log {
		color:#3799c2;	
		font-size: 11px; font-style:normal; font-weight:bold;
		top:-20px;
}
.group:after {
    content:"";
    display: table;
    clear: both;
	
}
/*
img {
    max-width: 100%;
    height: auto;
}
*/

.visible{
    display: block !important;
}

.hidden{
    display: none !important;
}
.foto{height:80px;}	
.buntut{width:100%;bottom:0px; position:absolute;}	
@media screen and (max-width: 780px) { /* jika screen maks. 780 right turun */
/*    .left, */
    .left,
    .right {
        float: none;
        width: auto;
		margin-top:0px;
		height:101px;
		color:#FFFFFF;
		display:block;	
    }
.foto{height:80px;}	
.buntut{width:100%;bottom:0px; position:absolute;}		
}
@media screen and (max-width: 400px) { /* jika screen maks. 780 right turun */
/*    .left, */
    .left{width: auto;    height: 91px;}
    .right {
        float: none;
        width: auto;
		margin-top:0px;
		height:60px;
		color:#FFFFFF;
    }
.foto{height:60px;}	
.buntut{width:100%;bottom:0px; position:absolute;}	
}
</style>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $skull;?> | Computer Based Test - CBT</title>
</head>
<?php 
include "config/server.php";
$sql = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from cbt_admin");
$r = mysqli_fetch_array($sql);
$sqllogin = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM  `cbt_siswa` WHERE XNomerUjian = '$user'");
 $sis = mysqli_fetch_array($sqllogin);
 
  $xkodekelas = $sis['XKodeKelas'];
  $xnamkelas = $sis['XNamaKelas'];
  $xjurz = $sis['XKodeJurusan'];
  $val_siswa = $sis['XNamaSiswa'];
  $poto = $sis['XFoto'];  
  
  if($poto==''){
	  $gambar="avatar.gif";
  } else{
	  $gambar=$poto;
  } 
?>
<body class="font-medium" style="background-color:#c9c9c9">
<header style="background-color:<?php echo "$r[XWarna]"; ?>">
<div class="group">
    <div class="left" style="background-color:<?php echo "$r[XWarna]"; ?>"><a href=""><img src="images/<?php echo "$r[XBanner]"; ?>" style=" margin-left:0px;"></a>
    </div>
    	<div class="right"><table width="100%" border="0" style="margin-top:10px">   
     					<tr><td rowspan="3" width="100px" align="center"><img src="fotosiswa/<?php echo "$gambar"; ?>" style=" margin-left:0px; margin-top:5px" class="foto"></td>
						<td><span class="user" style=" margin-left:0px; margin-top:5px">Terima Kasih</span></td></tr>
                        <tr><td><span class="user"><?php echo "$val_siswa ($xkodekelas)"; ?></span></td></tr>
                        <tr><td><span class="log"><a href="logout.php">Logout</a><span></td></tr>
						</table>
                        </div>
           
      	</div>
	</div> 
</div>         
</header>

     <link rel="stylesheet" href="css/bootstrap2.min.css">
     <link href="css/klien.css" rel="stylesheet">
<!--	<link href="css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css"> !-->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>


<div class="main-content">
<div class="page-column">
   
<div  class="col-md-4 col-md-offset-4 login-wrapper" style="float:inherit">
<div class="panel panel-default" style="margin-top:0px">
            <div class="panel-heading" style="font-size:22px; font-weight:bold">
                Konfirmasi Tes
            </div>

            <div class="inner-content" style="height:280px">
            <div class="form-horizontal" style="margin-top:0px"><br>


						<div class="inner-content">
                            <div class="wysiwyg-content">
                                <p>Terimakasih telah berpartisipasi dalam tes ini.<br>
									<?php if($xtampil=='1'){ ?>
									<br><font size="7" color="blue"><?php
									$queri= mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * from cbt_nilai where XNomerUjian ='$user' and XTokenUjian='$xtokenujian'");
									$data = mysqli_fetch_array($queri);
									echo " Nilai : ".$data['XTotalNilai']."</br></br></Font>";
									}
									?>
                                    Silahkan klik tombol LOGOUT untuk mengakhiri test.
                                </p>
                            </div>
                        </div>
						<div class="panel-footer">
                            <div class="row">
                                <div ><br /><a href="logout.php">
                                    <button type="submit" class="btn btn-success btn-block" data-dismiss="modal">LOGOUT</button>
                                </div>
                            </div>
                        </div>            

    

            </div>
            </div>
   </div>
   </div>
</div>
</div>

</body>

</html>