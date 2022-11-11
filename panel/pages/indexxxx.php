<?php
if(!isset($_COOKIE['beeuser'])){header("Location: login.php");}
include "../../config/server.php";

		$skul_pic= $log['XLogo'];
		$admpic= $log['XPicAdmin']; 
		$skul_ban= $log['XBanner']; 
		$skul_tkt= $log['XTingkat']; 
		$skul_warna= $log['XWarna']; 
		$skul_adm= strtoupper($log['XAdmin']); 
		$status_server = 1;
		
if ($zo == "Asia/Jakarta"){$w ="WIB";} elseif($zo == "Asia/Makassar"){$w ="WITA";} else{$w ="WIT";}
		
if(isset($_REQUEST['simpan5'])){
		$sql = mysqli_query($GLOBALS["___mysqli_ston"], "update cbt_server set XServer='$_REQUEST[server1]' where id = '1'");
		$sqlzona = mysqli_query($GLOBALS["___mysqli_ston"], "update cbt_zona set XZona='$_REQUEST[zona1]'");
		$sqlheader = mysqli_query($GLOBALS["___mysqli_ston"], "update cbt_header set Header='$_REQUEST[header]', HeaderUjian='$_REQUEST[headerujian]', XNilaiKelas='$_REQUEST[nilaikelas]', HakAkses='$_REQUEST[hakakses]'");
}
	
if(isset($_REQUEST['simpan_bd'])){
	$teks0=$_REQUEST["db_server"];
	$teks1="<?php ";
	$teks2="\$db_server=\"";
	$teks3="\";";
	$db_server =$teks1.$teks2.$teks0.$teks3;
	$file = fopen("../../config/db_server.php","w");    
			if($file){fputs($file,$db_server);}
			fclose($file); 
header("Location: logout.php");
	}		

	$xadm5 = mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_server"));
		$xserver= $xadm5['XServer'];
	
	if (mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_zona LIMIT 1")==TRUE){
		$hdr = mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_header"));
		$header= $hdr['Header'];
		if (mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_sync LIMIT 1")==TRUE){	
			$headerujian =$hdr['HeaderUjian'];
			$nilaikelas =$hdr['XNilaiKelas'];
			$hakakses =$hdr['HakAkses'];
		}else{
			$headerujian=0;
			$nilaikelas=0;
			$hakakses=0;
		}
	}else{
		$header=0;	
		$headerujian =0;
		$nilaikelas =0;
		$hakakses =0;
	}		
	$serv = php_uname('n');
	if (!$sqlconn) {$status_server='0'; die('Could not connect: ' . mysqli_error($GLOBALS["___mysqli_ston"]));}
		$a = ((is_null($___mysqli_res = mysqli_get_server_info($GLOBALS["___mysqli_ston"]))) ? false : $___mysqli_res);
		$b = substr($a, 0, strpos($a, "-"));
		$b = str_replace(".","",$b);
				
	if ($_COOKIE['beelogin']=="siswa"){
		$res = mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_siswa WHERE XNomerUjian='$_COOKIE[beeuser]'"));
		$poto  = $res['XFoto']; 
		$nama = $res['XNamaSiswa'];
		$loginx="3";
	}else{
		$re = mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_user WHERE Username='$_COOKIE[beeuser]'"));
		$poto  = $re['XPoto'];
		$loginx = $re['login'];
		$nama  =$re['Nama'];
	}

	if($poto==''){$gambar="avatar.gif";} else {$gambar=$poto;} 
	if($loginx=='1'){$ucap="Admin"; $ucap2 ="Administrator" ;} else  if($loginx=='2'){$ucap="Guru"; $ucap2 ="Guru Mapel" ;}  else {$ucap="Siswa"; $ucap2="Nama Siswa";}
	
	if(!isset($_REQUEST['modul'])||$_REQUEST['modul']==''){$bread = "<font color=#646473>Beranda</font>";}		
	elseif($_REQUEST['modul']=="info_skul"){$bread = "<font color=#646473>Identitan Sekolah </font>| Update Data Sekolah";}		
	elseif($_REQUEST['modul']=="upl_kelas"||$_REQUEST['modul']=="uploadkelas"){$bread = "<a href=?modul=daftar_kelas>Daftar Kelas</a> &#8226; <font color=#646473>Upload Data Kelas  </font>| Upload Form Excel Data Kelas";}		
	elseif($_REQUEST['modul']=="upl_mapel"||$_REQUEST['modul']=="uploadmapel"){$bread = "<a href=?modul=daftar_mapel>Mata Pelajaran</a> &#8226; <font color=#646473>Upload Mata Pelajaran  </font>| Upload Form Excel Data Mapel";}	
	elseif($_REQUEST['modul']=="upl_siswa"||$_REQUEST['modul']=="uploadsiswa"){$bread = "<a href=?modul=daftar_siswa>Daftar Siswa</a> &#8226; <font color=#646473>Upload Data Siswa </font>| Upload Form Excel Data Siswa";}
	elseif($_REQUEST['modul']=="daftar_siswa"){$bread = "<font color=#646473>Daftar Siswa/Peserta </font>| Upload, Download, Hapus, Tambah & Edit Data Siswa";}	
	elseif($_REQUEST['modul']=="daftar_kelas"){$bread = "<font color=#646473>Daftar Kelas </font>| Hapus, & Edit Kelas";}			
	elseif($_REQUEST['modul']=="daftar_mapel"){$bread = "<font color=#646473>Daftar Mapel </font>| Hapus, & Edit Mapel";}			
	elseif($_REQUEST['modul']=="buat_soal"){$bread = "<font color=#646473>Buat Bank Soal</font>";}			
	elseif($_REQUEST['modul']=="upl_foto"||$_REQUEST['modul']=="upload_foto"){$bread = "<font color=#646473>Upload Foto Peserta</font>";}	
	elseif($_REQUEST['modul']=="status_tes"){$bread = "<font color=#646473>Status Tes</font>";}		
	elseif($_REQUEST['modul']=="daftar_soal"){$bread = "<font color=#646473>Bank Soal </font>| Aktifasi, Edit & Hapus";}	
	elseif($_REQUEST['modul']=="upl_soal"){$bread = "<a href=?modul=daftar_soal>Bank Soal</a> &#8226; <font color=#646473>Upload File Template</font>";}			
	elseif($_REQUEST['modul']=="edit_soal"){$bread = "<a href=?modul=daftar_soal>Bank Soal</a> &#8226; <font color=#646473>Daftar Edit Soal</font>";}		
	elseif($_REQUEST['modul']=="edit_data_soal") {$bread = "<a href=?modul=daftar_soal>Bank Soal</a> &#8226; <a href=?modul=edit_soal&jum=$_REQUEST[jum]&soal=$_REQUEST[soal]>Daftar Soal</a>  &#8226; <font color=#646473>Edit Soal</font>";}	
	elseif($_REQUEST['modul']=="tambah_soal") {$bread = "<a href=?modul=daftar_soal>Bank Soal</a> &#8226; <a href=?modul=edit_soal&jum=$_REQUEST[jum]&soal=$_REQUEST[soal]>Daftar Soal</a>  &#8226; <font color=#646473>Tambah Soal</font>";}	
	elseif($_REQUEST['modul']=="data_user"){$bread = "<font color=#646473>Managemen User </font>| Administrasi Administrator & Guru";}
	elseif($_REQUEST['modul']=="backup"){$bread = "<font color=#646473>BackUp & Restore</font> | BackUp, Hapus & Restor DataBase";}
	elseif($_REQUEST['modul']=="set_server"){$bread = "<font color=#646473>Seting Server Pusat</font>";}
	elseif($_REQUEST['modul']=="data_skul"){$bread = "<font color=#646473>Data Sekolah Klien/Peserta </font>| Edit & Hapus ";}
	elseif($_REQUEST['modul']=="upload_filesoal"){$bread = "<font color=#646473>Upload File Pendukung</font>";}
	elseif($_REQUEST['modul']=="upl_filesoal"){$bread = "<font color=#646473>Upload File Pendukung</font>";}
	elseif($_REQUEST['modul']=="upl_tugas"){$bread = "<font color=#646473>Upload Nilai Tugas</font>";}
	elseif($_REQUEST['modul']=="edit_biodata_siswa"){$bread = "<font color=#646473>Edit Biodata Siswa</font>";}
	elseif($_REQUEST['modul']=="edit_biodata"){$bread = "<font color=#646473>Edit Biodata Guru</font>";}
	elseif($_REQUEST['modul']=="cetak_kartu"){$bread = "<font color=#646473>Cetak Kartu Peserta</font> ";}
	elseif($_REQUEST['modul']=="cetak_kartu_to"){$bread = "<font color=#646473>Cetak Kartu Try-Out</font> ";}
	elseif($_REQUEST['modul']=="cetak_absensi"){$bread = "<font color=#646473>Cetak Daftar Hadir</font>";}
	elseif($_REQUEST['modul']=="berita_acara"){$bread = "<font color=#646473>Cetak Berita Acara </font>";}
	elseif($_REQUEST['modul']=="cetak_hasil"){$bread = "<font color=#646473>Cetak Daftar Nilai </font>";}
	elseif($_REQUEST['modul']=="cetak_TO"){$bread = "<font color=#646473>Cetak Daftar Nilai Try Out </font>";}
	elseif($_REQUEST['modul']=="aktifkan_jadwaltes"){$bread = "<font color=#646473>Status Ujian | Jadwal Ujian </font>| Nonkatifkan Ujian & Reset Login Peserta ";}
	elseif($_REQUEST['modul']=="daftar_waktu"){$bread = "<font color=#646473>Status Ujian | Edit Setting Ujian </font>";}
	elseif($_REQUEST['modul']=="daftar_tesbaru"){$bread = "<font color=#646473>Status Ujian | Setting Ujian </font>| Buat Jadwal Ujian & Non Aktifkan Bank Soal";}
	elseif($_REQUEST['modul']=="daftar_peserta"){$bread = "<font color=#646473>Status Peserta</font>";}
	elseif($_REQUEST['modul']=="analisasoal"){$bread = "<font color=#646473>Analisa | Soal dan Hasil Jawaban</font>";}
	elseif($_REQUEST['modul']=="analisajawaban"){$bread = "<a href=?modul=analisasoal>Analisa</a> &#8226; <font color=#646473>Hasil Analisa</font>";}
	elseif($_REQUEST['modul']=="jawabansiswa"){$bread = "<a href=?modul=analisasoal>Analisa</a> &#8226; <a href=?modul=analisajawaban&soal=$_REQUEST[soal]>Hasil Analisa</a> &#8226; <font color=#646473>Lembar Jawaban Siswa</font>";}
	elseif($_REQUEST['modul']=="lks"){$bread = "<a href=?modul=analisasoal>Analisa</a> &#8226; <a href=?modul=analisajawaban&soal=$_REQUEST[soal]>Hasil Analisa</a> &#8226; <font color=#646473>Skoring Jawaban ESAI</font>";}
	elseif($_REQUEST['modul']=="analisabutir"){$bread = "<a href=?modul=analisasoal>Analisa</a> &#8226; <font color=#646473>Analisa Butir Soal</font>";}
	elseif($_REQUEST['modul']=="rekapesai"){$bread = "Analisa Soal dan Hasil Jawaban";}
	elseif($_REQUEST['modul']=="daftar_waktu_db"){$bread = "<font color=#646473>Status Ujian | DataBase Ujian </font>| Edit & Hapus db";}
	elseif($_REQUEST['modul']=="edit_tes"){$bread = "<a href=?modul=daftar_tesbaru>Status Ujian | Setting Ujian</a> &#8226; <font color=#646473>Buat Jadwal Ujian dan Rilis TOKEN</font>";}	
	elseif($_REQUEST['modul']=="reset_peserta"){$bread = "<a href=?modul=aktifkan_jadwaltes>Status Ujian | Jadwal Ujian</a> &#8226; <font color=#646473>Reset Login Peserta</font>";}	
	elseif($_REQUEST['modul']=="upl_user"||$_REQUEST['modul']=="uploaduser"){$bread = "<font color=#646473>Upload Data User</font>";}
	elseif($_REQUEST['modul']=="edit_biodata"){$bread = "<font color=#646473>Edit Biodata</font>";}
	elseif($_REQUEST['modul']=="edit_biodata_pass"){$bread = "<font color=#646473>Ganti Password";}
	elseif($_REQUEST['modul']=="edit_biodata_siswa"){$bread = "<font color=#646473>Edit Biodata</font>";}
	elseif($_REQUEST['modul']=="edit_biodata_siswa_pass"){$bread = "<font color=#646473>Ganti Password</font>";}
	elseif($_REQUEST['modul']=="daftar_nilai"){$bread = "<font color=#646473>Daftar Nilai</font>";}
		

	$tgljam = date("d/m/Y H:i");  
	$tgl = date("d/m/Y"); 
	if ($mode == "lokal" ){$tmode="Mode Server PUSAT";} else {$tmode="Mode Server LOKAL";} 
		
	$Dd= date("D");
	if ($Dd=="Sun"){$hari="Minggu";}
	else if ($Dd=="Mon"){$hari="Senin, ";}
	else if ($Dd=="Tue"){$hari="Selasa, ";}
	else if ($Dd=="Wed"){$hari="Rabu, ";}
	else if ($Dd=="Thu"){$hari="Kamis, ";}
	else if ($Dd=="Fri"){$hari="Jum'at, ";}
	else if ($Dd=="Sat"){$hari="Sabtu, ";}
	else {$hari=$Dd;}
?>


<!DOCTYPE html>
<html>

<head>
	<link href='../../images/icon.png' rel='icon' type='image/gif'/>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	
    <title><?php echo $skull; ?> | Administrator</title>
	
    <!-- Bootstrap Core CSS -->
		<link href="../../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="../../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" />
		<link href="../../assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="../../assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="../../assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
	
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="../../assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
		
        <!-- END THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->

</head>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="jquery-1.4.js"></script>

 <?php 
 $tgljam = date("d/m/Y H:i");  
 $tgl = date("d/m/Y"); 
 ?>
<!-- <link rel="stylesheet" type="text/css" href="./css/bootstrap.css"/>  -->
<link rel="stylesheet" type="text/css" href="jquery.datetimepicker.css"/>
<style type="text/css">

.custom-date-style {
	background-color: red !important;
}

.input{	
}
.input-wide{
	width: 500px;
}
.datetimepicker{z-index:99999;
}

</style>
<script src="date/jquery.js"></script>
<script src="jquery.datetimepicker.full.js"></script>
 <script>/*
window.onerror = function(errorMsg) {
	$('#console').html($('#console').html()+'<br>'+errorMsg)
}*/
$.noConflict();
jQuery( document ).ready(function( $ ) {
$.datetimepicker.setLocale('en');

$('#datetimepicker_format').datetimepicker({value:'2015/04/15 05:03', format: $("#datetimepicker_format_value").val()});
console.log($('#datetimepicker_format').datetimepicker('getValue'));

$("#datetimepicker_format_change").on("click", function(e){
	$("#datetimepicker_format").data('xdsoft_datetimepicker').setOptions({format: $("#datetimepicker_format_value").val()});
});
$("#datetimepicker_format_locale").on("change", function(e){
	$.datetimepicker.setLocale($(e.currentTarget).val());
});

$('#datetimepicker').datetimepicker({
dayOfWeekStart : 1,
lang:'en',
disabledDates:['1986/01/08','1986/01/09','1986/01/10'],
startDate:	'1986/01/05'
});
$('#datetimepicker').datetimepicker({value:'2015/04/15 05:03',step:10});
$('.some_class').datetimepicker();
$('#default_datetimepicker').datetimepicker({
	formatTime:'H:i',
	//formatDate:'d.m.Y',
	formatDate:'d.m.Y',
	//defaultDate:'8.12.1986', // it's my birthday
	defaultDate:'+03.01.1970', // it's my birthday
	defaultTime:'10:00',
	timepickerScrollbar:false
});
$('#tanggal1').datetimepicker({
	timepicker:false,
	format:'m/d/Y',
	formatDate:'d/m/Y',
});
$('#datetimepicker_mask').datetimepicker({
	mask:'9999/19/39 29:59'
});
$('#mulai1').datetimepicker({
	datepicker:false,
	format:'H.i',
	step:5
});
$('#akhir1').datetimepicker({
	datepicker:false,
	format:'H.i',
	step:5
});
$('#datetimepicker_dark').datetimepicker({theme:'dark'})
        }); 

</script>




<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">

 <div class="page-wrapper">
<!-- ////Tampilan HEADER Modern (alternatif)/////-->
	<div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
				<a href="index.php">
						<img src="../../images/<?php echo "$skul_ban"; ?>" alt="logo" class="logo-default" style="width:150px;margin-top:5px;"   /> </a>
						<div class="menu-toggler sidebar-toggler">
						<span></span>
                        <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
						</div>
                </div>
			
				<!-- END LOGO -->
				<!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
                <!-- END RESPONSIVE MENU TOGGLER -->
                <!-- BEGIN PAGE ACTIONS -->
                <!-- DOC: Remove "hide" class to enable the page header actions -->
				
					<div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            <li >
								<?php
								if($status_server==1){
								?>
								<label style="text-align:right; color:#04e5dd; font-size:20px; margin-top:10px; margin-right:10px">AKTIF</label>
							   <?php } else { ?>
							   <label style="text-align:right; color:#f2647a; font-size:20px; margin-top:10px; margin-right:10px">OFFLINE</label>
							   <?php } ?>
							</li>
							<?php if ($_COOKIE['beelogin']=="siswa"){?>
							<li class="dropdown dropdown-user dropdown-dark">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <span class="username username-hide-on-mobile"><?php echo $nama; ?></span>
                                    <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
									<?php 	if(file_exists("../../fotosiswa/$res[XFoto]")&&!$gambar==''){ ?>
                                    <img alt="" class="img-circle"  src="../../fotosiswa/<?php echo "$gambar"; ?>" /> 
									<?php 	} else {echo "<img src=../../fotosiswa/avatar.gif>";} ?></a>
							<?php }else{?>
							<li class="dropdown dropdown-user dropdown-dark">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <span class="username username-hide-on-mobile"><?php echo $nama; ?></span>
                                    <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
									<?php 	if(file_exists("photo/$re[XPoto]")&&!$gambar==''){ ?>
                                    <img alt="" class="img-circle" src="photo/<?php echo "$gambar"; ?>" /> 
									<?php 	} else {echo "<img src=photo/avatar.gif>";} ?></a>
							<?php } ?>
							<ul class="dropdown-menu dropdown-menu-default">
							<?php if ($_COOKIE['beelogin']=="siswa"){?>
                                    <li>
                                        <a href="?modul=edit_biodata_siswa" data-toggle='modal' data-target=''>
                                            <i class="icon-user"></i> Edit My Profile </a>
                                    </li>
									<?php }else{?>
									<li>
                                        <a href="?modul=edit_biodata" data-toggle='modal' data-target=''>
                                            <i class="icon-user"></i> Edit My Profile </a>
                                    </li>
									<?php } ?>
									<?php if ($_COOKIE['beelogin']=="siswa"){?>
									<li>
                                        <a href="?modul=edit_biodata_siswa_pass">
                                            <i class="icon-key"></i> Ganti Password </a>
                                    </li>
									<?php }else{?>
									<li>
                                        <a href="?modul=edit_biodata_pass">
                                            <i class="icon-key"></i> Ganti Password </a>
                                    </li>
									<?php } ?>
									<?php if ($_COOKIE['beelogin']=="siswa"){?>
									<li>
										<a  href="?modul=daftar_nilai">
											<i class="fa fa-list"></i> Daftar Nilai</a>
									</li>
									<?php } ?>
                                    <li>
                                        <a href="logout.php">
                                            <i class="icon-logout"></i> Log Out </a>
                                    </li>
									
                                </ul>
                            </li>
                            <!-- END USER LOGIN DROPDOWN -->
							<!-- BEGIN QUICK SIDEBAR TOGGLER
                            <li>
								<a href="logout.php" class="dropdown dropdown-extended quick-sidebar-toggler">
                                <span class="sr-only">Toggle Quick Sidebar</span>
                                <i class="icon-logout"></i></a>
                            </li>
                            <!-- END QUICK SIDEBAR TOGGLER -->
                        </ul>
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
				</div>
            <!-- END HEADER INNER -->
			
        </div>
	
        <!-- END HEADER -->
		
		
	<!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER 
		<div class="page-container" style="background-image:url(../../assets/images/acs.jpg); background-repeat:repeat-x repeat-y; background-attachment:fixed" > -->
        <div class="page-container" >
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-fixed" >
                <!-- BEGIN SIDEBAR -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <div class="page-sidebar navbar-collapse collapse  " >
                    <!-- BEGIN SIDEBAR MENU -->
                    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <ul class="page-sidebar-menu page-header-fixed" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="400" style="padding-top: 20px" >
					<li class="sidebar-toggler-wrapper hide">
                                <div class="sidebar-toggler">
                                    <span></span>
                                </div>
                    </li>
					<li class="sidebar-search-wrapper">
                                <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                                <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
                                <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
                                <form class="sidebar-search  " action="index.php" method="POST">
                                    <a href="javascript:;" class="remove">
                                        <i class="icon-close"></i>
                                    </a>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search...">
                                        <span class="input-group-btn">
                                            <a href="javascript:;" class="btn submit">
                                                <i class="icon-magnifier"></i>
                                            </a>
                                        </span>
                                    </div>
                                </form>
                                <!-- END RESPONSIVE QUICK SEARCH FORM -->
                       </li>
					<li class="nav-item start ">
                            <a href="index.php" class="nav-link nav-toggle" data-scroll>
                                <i class="icon-home"></i>
                                <span class="title">Dashboard</span>
                                <span class="selected"></span>
                                      
                            </a>
					</li>
					<li class="nav-item start  ">
                                <a href="#" class="nav-link" data-toggle='modal' data-target='#myInfo'>
                                    <i class="icon-question"></i>
                                    <span class="title">Info & Tutorial</span>
									<span class="selected"></span>
									
								</a>
					</li>
					


						<!--li class="nav-item  ">
						<!phpif ($xserver=="pusat"){?>
                                <a href="?modul=sinkron" class="nav-link nav-toggle " aria-hidden="true">
                                    <i class="icon-cloud-download"></i>
                                    <span class="title">Status Sinkronisasi</span>
									<span class="selected"></span>
                                    
								</a>
					
						<!php }?>
						</li> --!>
<!-- /////////////////////// ADMINISTRASI LOGIN //////////////////////////////-->
<!-- //////// ADMIN (1) /////////-->						
<?php if($loginx=="1"){?>						
						<li class="nav-item  ">
								<a href="javascript:;" class="nav-link nav-toggle">
									<i class="icon-settings"></i>
									<span class="title">System Server</span>
									<span class="selected"></span>
									<span class="arrow open"></span>
								</a>
								<ul class="sub-menu">
                                    <li class="nav-item   ">
                                        <a href="#" data-toggle="modal" data-target="#myServer"  class="nav-link " data-scroll>
											<i class="fa fa-gear fa-fw"></i>
											<span class="title">Setting Server</span>
											<span class="selected"></span>
                                        </a>
                                    </li>
									<li class="nav-item  ">
										<?php if ($xserver=="lokal"){?>
                                        <a href="?modul=data_skul" class="nav-link ">
                                            <i class="fa fa-university fa-fw"></i>
                                            <span class="title">Server Sekolah (Klien)</span>  
											<span class="selected"></span>
                                        </a>
										<?php } else { ?>
										<a href="?modul=set_server" class="nav-link ">
                                            <i class="fa fa-server"></i>
                                            <span class="title">Server Pusat</span>  
											<span class="selected"></span>
                                        </a>
										<?php }?>
                                    </li>
									<li class="nav-item  ">
                                        <a href="#" data-toggle="modal" data-target="#db_server" class="nav-link " >
                                            <i class="icon-layers"></i>
                                            <span class="title">Ubah db/Install Baru</span>
											<span class="selected"></span>
                                        </a>
                                    </li>
								</ul>
							</li>
							
							<li class="nav-item   ">
								<a href="javascript:;" class="nav-link nav-toggle">
									<i class="icon-graduation"></i>
									<span class="title">Data Sekolah</span>
									<span class="arrow"></span>
								</a>
								<ul class="sub-menu">
                                    <li class="nav-item ">
                                        <a href="?modul=info_skul" class="nav-link " data-scroll>
											<i class="icon-badge"></i>
											<span class="title">Identitas Sekolah</span>
                                        </a>
                                    </li>
									<li class="nav-item ">
                                        <a href="?modul=data_user" class="nav-link ">
                                            <i class="icon-user-follow"></i>
                                            <span class="title">Manajemen User</span>   
                                        </a>
                                    </li>
									<li class="nav-item ">
                                        <a href="?modul=backup" class="nav-link " >
                                            <i class="icon-layers"></i>
                                            <span class="title">Backup & Restore</span>   
                                        </a>
                                    </li>
								</ul>
							</li>
							
							<li class="nav-item   ">
                                <a href="#" class="nav-link nav-toggle">
                                    <i class="icon-grid"></i>
                                    <span class="title">Administrative</span>
                                    <span class="arrow open"></span>
								</a>
								<ul class="sub-menu">
                                    <li >
                                        <a href="?modul=daftar_kelas" >
											<i class="icon-list"></i>
											<span class="title">Daftar Kelas</span>
                                            
                                        </a>
                                    </li>
									<li >
                                        <a href="?modul=daftar_mapel" >
                                            <i class="icon-list"></i>
                                            <span class="title">Mata Pelajaran</span>
                                            
                                        </a>
                                    </li>
									<li >
                                        <a href="?modul=daftar_siswa">
                                            <i class="icon-users"></i>
                                            <span class="title">Daftar Siswa</span>
                                            
                                        </a>
                                    </li>
									
								</ul>
							</li>

<!-- /////// GURU (2) //////-->	
<?php } if( $loginx=="2" ){?>							
					
							<li class="nav-item   ">
								<a href="?modul=edit_biodata" class="nav-link nav-toggle">
									<i class="icon-user"></i>
									<span class="title">Edit Biodata</span>
									
								</a>
							</li>	
							<li class="nav-item ">
                                <a href="?modul=edit_biodata_pass" class="nav-link ">
                                     <i class="fa fa-key fa-fw"></i>
                                     <span class="title">Ganti Password</span>   
                                </a>
                            </li>
							
<!-- /////// GURU (2) //////-->	
	<?php } if( $loginx=="3" ){?>							
					
							<li class="nav-item   ">
								<a href="?modul=edit_biodata_siswa" class="nav-link nav-toggle">
									<i class="icon-user"></i>
									<span class="title">Edit Biodata</span>
									
								</a>
							</li>	
							<li class="nav-item ">
                                <a href="?modul=edit_biodata_siswa_pass" class="nav-link ">
                                     <i class="fa fa-key fa-fw"></i>
                                     <span class="title">Ganti Password</span>   
                                </a>
                            </li>
							<li class="nav-item ">
                                <a href="?modul=daftar_nilai" class="nav-link ">
                                     <i class="fa fa-list"></i>
                                     <span class="title">Daftar Nilai</span>   
                                </a>
                            </li>
							
					<?php if( $nilaikelas=="1"  ){?>
							<li class="nav-item   ">
                                <a href="#" class="nav-link nav-toggle">
                                    <i class="icon-settings"></i>
                                    <span class="title">Daftar Nilai Perkelas</span>
                                    <span class="arrow open"></span>
								</a>
								<ul class="sub-menu">
                                    <li >
                                        <a href="#" data-toggle="modal" data-target="#myCetakHasil" class="nav-link"  >
											<i class="icon-list"></i>
											<span class="title">Daftar Nilai Ujian </span>
                                            
                                        </a>
                                    </li>
									<li >
                                        <a href="#" data-toggle="modal" data-target="#myCetakTO" class="nav-link"  >
                                            <i class="icon-list"></i>
                                            <span class="title">Daftar Nilai TryOut</span>
                                            
                                        </a>
                                    </li>
								</ul>
							</li>

<!-- /////// GURU (2) atau ADMIN (1) //////-->	
<?php }} if($loginx=="1"  ) {?>
						<li class="nav-item   ">
                                <a href="#" class="nav-link nav-toggle">
                                    <i class="icon-book-open"></i>
                                    <span class="title">Bank Soal</span>
                                    <span class="arrow open"></span>
								</a>
							<ul class="sub-menu">
								<li class="nav-item  ">
									<a href="?modul=daftar_soal" class="nav-link ">
										<i class="icon-docs"></i>
										<span class="title">Daftar Bank Soal</span>
										
									</a>
								</li>
								<li class="nav-item  ">
									<a href="?modul=file_pendukung" title="Buat Soal" data-toggle="modal" class="nav-link ">
										<i class="icon-cloud-upload"></i>
										<span class="title">Upload File Pendukung</span>
										
									</a>
								</li>
								<li class="nav-item  ">
									<a href="?modul=upl_tugas" title="Buat Soal" data-toggle="modal" class="nav-link ">
										<i class="icon-arrow-up"></i>
										<span class="title">Upload Nilai Tugas</span>
										
									</a>
								</li>
								
							</ul>
						</li>
						
<?php } if( $loginx=="2" ) {?>
						<li class="nav-item   ">
                                <a href="#" class="nav-link nav-toggle">
                                    <i class="icon-book-open"></i>
                                    <span class="title">Bank Soal</span>
                                    <span class="arrow open"></span>
								</a>
							<ul class="sub-menu">
								<li class="nav-item  ">
									<a href="?modul=daftar_soal" class="nav-link ">
										<i class="icon-docs"></i>
										<span class="title">Daftar Bank Soal</span>
										
									</a>
								</li>
								<li class="nav-item  ">
									<a href="?modul=upl_files" title="Buat Soal" data-toggle="modal" class="nav-link ">
										<i class="icon-cloud-upload"></i>
										<span class="title">Upload File Pendukung</span>
										
									</a>
								</li>
								<li class="nav-item  ">
									<a href="?modul=upl_tugas" title="Buat Soal" data-toggle="modal" class="nav-link ">
										<i class="icon-arrow-up"></i>
										<span class="title">Upload Nilai Tugas</span>
										
									</a>
								</li>
								
							</ul>
						</li>					
<?php } ?> 

<!-- //////// ADMIN (1) ////////  -->
<?php if($loginx=="1"){?>
						<li class="nav-item">
                                <a href="#" class="nav-link nav-toggle ">
                                    <i class="icon-printer"></i>
                                    <span class="title">Cetak</span>
                                    <span class="arrow open"></span>
								</a>
							<ul class="sub-menu">
								<li class="nav-item  ">
									<a href="#" data-toggle="modal" data-target="#myCetakKartu" class="nav-link ">
										<i class="icon-credit-card"></i>
										<span class="title"> Kartu Ujian</span>
										
									</a>
								</li>
								<li class="nav-item  ">
									<a href="#" data-toggle="modal" data-target="#myDaftarHadir" class="nav-link ">
										<i class="icon-docs"></i>
										<span class="title">Daftar Hadir</span>
										
									</a>
								</li>
								<li class="nav-item  ">
									<a href="?modul=berita_acara" class="nav-link ">
										<i class="icon-docs"></i>
										<span class="title">Berita Acara</span>
										
									</a>
								</li>
								<li class="nav-item  ">
									<a href="#" data-toggle="modal" data-target="#myCetakHasil" class="nav-link ">
										<i class="icon-calculator"></i>
										<span class="title">Daftar Nilai</span>
										
									</a>
								</li>
								<li class="nav-item  ">
									<a href="#" data-toggle="modal" data-target="#myCetakTO" class="nav-link ">
										<i class="icon-book-open"></i>
										<span class="title">Hasil TryOut</span>
										
									</a>
								</li>
							</ul>
						</li>
						
						<li class="nav-item ">
                                <a href="#" class="nav-link nav-toggle ">
                                    <i class="icon-note"></i>
                                    <span class="title">Status Tes</span>
                                    <span class="arrow open"></span>
								</a>
							<ul class="sub-menu">
								<li class="nav-item  ">
									<a href="?modul=daftar_tesbaru" class="nav-link ">
										<i class="icon-settings"></i>
										<span class="title">Setting Ujian</span>
										
									</a>
								</li>
								<li class="nav-item  ">
									<a href="?modul=aktifkan_jadwaltes" class="nav-link ">
										<i class="icon-clock"></i>
										<span class="title">Jadwal Tes</span>
										
									</a>
								</li>
								<li class="nav-item  ">
									<a href="?modul=daftar_waktu" class="nav-link ">
										<i class="icon-clock"></i>
										<span class="title">Edit Jadwal Tes</span>
										
									</a>
								</li>
								<li class="nav-item  ">
									<a href="?modul=daftar_waktu_db" class="nav-link ">
										<i class="icon-clock"></i>
										<span class="title">Database Ujian</span>
										
									</a>
								</li>
							</ul>
						</li>
						
						<li class="nav-item ">
                                <a href="?modul=daftar_peserta" class="nav-link nav-toggle">
                                    <i class="icon-user"></i>
                                    <span class="title">Status Peserta</span>
									<span class="selected"></span>
                                    
								</a>
						</li>
						<li class="nav-item ">
                                <a href="?modul=aktifkan_jadwaltes" class="nav-link nav-toggle"">
                                    <i class="icon-refresh"></i>
                                    <span class="title">Reset Login Peserta</span>
									<span class="selected"></span>
                                    
								</a>
						</li>
<?php } ?> 


	<!-- /////// ADMIN (1) atau GURU (2) ////// -->
<?php if($loginx=="1"||$loginx=="2") {?>
						<li class="nav-item ">
                                <a href="?modul=analisasoal" class="nav-link nav-toggle ">
                                    <i class="icon-notebook"></i>
                                    <span class="title">Analisa</span>
									<span class="selected"></span>
                                    
								</a>
						</li>
						
<?php } if($loginx=="1") { if ($xserver=="pusat"){?>
						<li class="nav-item ">
                                <a href="?modul=upload_hasil" class="nav-link nav-toggle ">
                                    <i class="fa fa-cloud-upload"></i>
                                    <span class="title">Upload Hasil Ujian</span>
									<span class="selected"></span>
                                    
								</a>
						</li>
<!-- /////// ADMIN (1) atau GURU (2) atau SISWA (3) ////// -->
<?php }} if($loginx=="1"||$loginx=="2"||$loginx=="3"){?>
						<li class="nav-item " bgcolor="#8c0023">
                                <a href="logout.php" class="nav-link nav-toggle ">
                                    <i class="icon-logout"></i>
                                    <span class="title">Logout</span>
									<span class="selected"></span>
                                    
								</a>
						</li>
						
<?php } ?>    </ul>
      <!-- /.navbar-static-side -->

	</div>
		<!-- /.sidebar-collapse -->
	</div>
			
<!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper" >
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content" >
				<!-- BEGIN PAGE HEADER-->
                        <!-- BEGIN THEME PANEL -->
                        <div class="theme-panel hidden-xs ">
                           
                            <div class="toggler-close"> </div>
                            <div class="theme-options">
                                <div class="theme-option theme-colors clearfix">
								<span> THEME COLOR </span>
                                    <ul>
                                        <li class="color-default current tooltips" data-style="default" data-container="body" data-original-title="Default"> </li>
                                        <li class="color-darkblue tooltips" data-style="darkblue" data-container="body" data-original-title="Dark Blue"> </li>
                                        <li class="color-blue tooltips" data-style="blue" data-container="body" data-original-title="Blue"> </li>
                                        <li class="color-grey tooltips" data-style="grey" data-container="body" data-original-title="Grey"> </li>
                                        <li class="color-light tooltips" data-style="light" data-container="body" data-original-title="Light"> </li>
                                        <li class="color-light2 tooltips" data-style="light2" data-container="body" data-html="true" data-original-title="Light 2"> </li>
                                    </ul>
                                </div>
                                <div class="theme-option">
                                    <span> Theme Style </span>
                                    <select class="layout-style-option form-control input-sm">
                                        <option value="square" selected="selected">Square corners</option>
                                        <option value="rounded">Rounded corners</option>
                                    </select>
                                </div>
                                <div class="theme-option">
                                    <span> Layout </span>
                                    <select class="layout-option form-control input-sm">
                                        <option value="fluid" selected="selected">Fluid</option>
                                        <option value="boxed">Boxed</option>
                                    </select>
                                </div>
                                <div class="theme-option">
                                    <span> Header </span>
                                    <select class="page-header-option form-control input-sm">
                                        <option value="fixed" selected="selected">Fixed</option>
                                        <option value="default">Default</option>
                                    </select>
                                </div>
                                <div class="theme-option">
                                    <span> Top Menu Dropdown</span>
                                    <select class="page-header-top-dropdown-style-option form-control input-sm">
                                        <option value="light" selected="selected">Light</option>
                                        <option value="dark">Dark</option>
                                    </select>
                                </div>
                                <div class="theme-option">
                                    <span> Sidebar Mode</span>
                                    <select class="sidebar-option form-control input-sm">
                                        <option value="fixed">Fixed</option>
                                        <option value="default" selected="selected">Default</option>
                                    </select>
                                </div>
                                <div class="theme-option">
                                    <span> Sidebar Menu </span>
                                    <select class="sidebar-menu-option form-control input-sm">
                                        <option value="accordion" selected="selected">Accordion</option>
                                        <option value="hover">Hover</option>
                                    </select>
                                </div>
                                <div class="theme-option">
                                    <span> Sidebar Style </span>
                                    <select class="sidebar-style-option form-control input-sm">
                                        <option value="default" selected="selected">Default</option>
                                        <option value="light">Light</option>
                                    </select>
                                </div>
                                <div class="theme-option">
                                    <span> Sidebar Position </span>
                                    <select class="sidebar-pos-option form-control input-sm">
                                        <option value="left" selected="selected">Left</option>
                                        <option value="right">Right</option>
                                    </select>
                                </div>
                                <div class="theme-option">
                                    <span> Footer </span>
                                    <select class="page-footer-option form-control input-sm">
                                        <option value="fixed">Fixed</option>
                                        <option value="default" selected="selected">Default</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- END THEME PANEL -->
								
                    <!-- BEGIN PAGE BAR-->
                    <div class="page-bar">
                        
						<!-- BEGIN PAGE BREADCRUMB -->
						<ul class="page-breadcrumb">
						
                        <li>
                            <a href="index.php">Beranda</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span>
						 <small><?php
							if(isset($bread)){
							echo $bread;} ?> | BeeSmart Education Partner</small></span>
                        </li>
						
						</ul>
						
                            
                       
						<!-- END PAGE BREADCRUMB -->	
                        <!-- END PAGE TITLE -->
                        <!-- BEGIN PAGE TOOLBAR -->
                        <div class="page-toolbar" >
						<div id="dashboard-report-range" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom" data-original-title="<?php echo $hari; echo date('d M Y');?>">
                                    <i class="icon-calendar"></i>&nbsp;
                                    <span class="thin uppercase hidden-xs"></span><?php echo $hari; echo date('d M Y'); echo "&nbsp;&nbsp;[&nbsp;&nbsp;";?>
									<a id="clockDisplay"></a><?php	echo "&nbsp;&nbsp;".$w."&nbsp; ]";?>
                                    <i class="fa fa-angle-down"></i>
                                </div>
                            </div>
<script>
function renderTime(){
	 var currentTime = new Date();
	 var h = currentTime.getHours();
	 var m = currentTime.getMinutes();
	 var s = currentTime.getSeconds();
	 if (h == 0){h = 24;}
	 if (h < 10){h = "0" + h;}
	 if (m < 10){m = "0" + m;}
	 if (s < 10){s = "0" + s;}
	 var myClock = document.getElementById('clockDisplay');
	 myClock.textContent = h + ":" + m + ":" + s + "";    
	 setTimeout ('renderTime()',1000);}
renderTime();
</script>		
						
                    
                    </div>
                    <!-- END PAGE BAR-->
						<h1 class="page-title"> 
                        </h1>
					 <!-- BEGIN PAGE BASE CONTENT -->
                    
                  
			
		<?php	if(isset($_REQUEST['modul'])==""){include "none.php";}	
				elseif($_REQUEST['modul']=="aktifkan_jadwaltes"){include "daftar_tes.php";}			
				elseif($_REQUEST['modul']=="buat_paketsoal"){include "buat_paketbaru.php";}	
				elseif($_REQUEST['modul']=="buat_soal"){include "buat_banksoal.php";}
				elseif($_REQUEST['modul']=="daftar_kelas"){include "daftar_kelas.php";}	
				elseif($_REQUEST['modul']=="daftar_mapel"){include "daftar_mapel.php";}	
				elseif($_REQUEST['modul']=="daftar_peserta"){include "daftarpeserta.php";}
				elseif($_REQUEST['modul']=="daftar_siswa"){include "daftar_siswa.php";}
				elseif($_REQUEST['modul']=="daftar_soal"){include "daftar_soal.php";}		
				elseif($_REQUEST['modul']=="daftar_tesbaru"){include "daftar_tesbaru.php";}	
				elseif($_REQUEST['modul']=="daftar_waktu"){include "daftar_waktu.php";}			
				elseif($_REQUEST['modul']=="data_skul"){include "daftar_sekolah.php";}
				elseif($_REQUEST['modul']=="data_user"||$_REQUEST['modul']=="hapus_user"){include "daftar_user.php";}			
				elseif($_REQUEST['modul']=="detil_siswa"){include "detil_siswa.php";}				
				elseif($_REQUEST['modul']=="edit_biodata"){include "edit_biodata.php";}	
				elseif($_REQUEST['modul']=="edit_biodata_pass"){include "edit_biodata_pass.php";}			
				elseif($_REQUEST['modul']=="edit_biodata_siswa"){include "edit_biodata_siswa.php";}
				elseif($_REQUEST['modul']=="edit_biodata_siswa_pass"){include "edit_biodata_siswa_pass.php";}				
				elseif($_REQUEST['modul']=="edit_soal"){include "edit_daftar_soal.php";}			
				elseif($_REQUEST['modul']=="edit_soal_esai"){include "bank_soal.php";}			
				elseif($_REQUEST['modul']=="edit_data_soal")
					{if($_REQUEST['jum']==5){include "bank_soal5.php";}
					elseif($_REQUEST['jum']==4){include "bank_soal4.php";}
					elseif($_REQUEST['jum']==3){include "bank_soal3.php";}
					elseif($_REQUEST['jum']==1){include "bank_soal.php";} }
				elseif($_REQUEST['modul']=="info_skul"){include "upl_skul.php";}	
				elseif($_REQUEST['modul']=="status_tes"){include "status_tes.php";}
				elseif($_REQUEST['modul']=="pilih_banksoal"){include "buat_paketbaru.php";}	
				
				elseif($_REQUEST['modul']=="reset_peserta"){include "resetpeserta.php";}									
				elseif($_REQUEST['modul']=="set_server"){include "set_server.php";}
				elseif($_REQUEST['modul']=="upl_soal"){include "upload_soal.php";}
				elseif($_REQUEST['modul']=="upl_files"){include "upload_files.php";}
				elseif($_REQUEST['modul']=="upl_filesoal"){include "upload_file.php";}
				elseif($_REQUEST['modul']=="file_pendukung"){include "gambar.php";}
				elseif($_REQUEST['modul']=="upl_foto"){include "upload_foto.php";}	
				elseif($_REQUEST['modul']=="upload_filesoal"){include "upload_filesoal.php";}
				elseif($_REQUEST['modul']=="upl_user"||$_REQUEST['modul']=="uploaduser"){include "upload_user.php";}				
				elseif($_REQUEST['modul']=="upl_kelas"||$_REQUEST['modul']=="uploadkelas"){include "upload_kelas.php";}		
				elseif($_REQUEST['modul']=="upl_mapel"||$_REQUEST['modul']=="uploadmapel"){include "upload_mapel.php";}	
				elseif($_REQUEST['modul']=="upl_siswa"||$_REQUEST['modul']=="uploadsiswa"){include "upload_siswa.php";}
				elseif($_REQUEST['modul']=="upl_soal"||$_REQUEST['modul']=="uploadsoal"){include "upload_soal.php";}	
				elseif($_REQUEST['modul']=="upl_tugas"||$_REQUEST['modul']=="uploadtugas"){include "upload_tugas.php";}				
				elseif($_REQUEST['modul']=="tambah_soal")
					{if($_REQUEST['jum']==5){include "tambah_soal5.php";}
						elseif($_REQUEST['jum']==4){include "tambah_soal4.php";}
						elseif($_REQUEST['jum']==3){include "tambah_soal3.php";}
						elseif($_REQUEST['jum']==1){include "tambah_soal.php";} }
				elseif($_REQUEST['modul']=="hapus_nosoal"){include "hapus_nosoal.php";}	
				elseif($_REQUEST['modul']=="cetak_kartu_to"){include "cetak_kartu_to.php";}				
				elseif($_REQUEST['modul']=="cetak_kartu"){include "cetak_kartu.php";}																																									
				elseif($_REQUEST['modul']=="cetak_absensi"){include "cetak_absen.php";}	
				elseif($_REQUEST['modul']=="cetak_berita"){include "cetak_berita.php";}	
				elseif($_REQUEST['modul']=="cetak_hasil"){include "cetak_hasil_ujian.php";}	
				elseif($_REQUEST['modul']=="cetak_TO"){include "cetak_hasil_TO.php";}	
				elseif($_REQUEST['modul']=="hasil_peserta"){include "cetak_hasil_analisa.php";}	
				elseif($_REQUEST['modul']=="jawabansiswa"){include "jawabansiswa.php";}	
				elseif($_REQUEST['modul']=="jawabanesai"){include "jawabanesai_siswa.php";}	
				elseif($_REQUEST['modul']=="analisasoal"){include "analisa_soal.php";}	
				elseif($_REQUEST['modul']=="analisajawaban"){include "analisa_jawaban.php";}																																																								
				elseif($_REQUEST['modul']=="analisabutir"){include "analisa_butirsoal.php";}	
				elseif($_REQUEST['modul']=="sebaran_nilai"){include "sebaran_nilai.php";}	
				elseif($_REQUEST['modul']=="lks"){include "lks.php";}	
				elseif($_REQUEST['modul']=="backup"){include "backup.php";}
				elseif($_REQUEST['modul']=="restore"){include "../../database/restore.php";}
				elseif($_REQUEST['modul']=="backup_db"){include "../../database/cbt_jawaban.php";}	
				elseif($_REQUEST['modul']=="edit_tes"){include "edit_tes.php";}	
				elseif($_REQUEST['modul']=="sinkron"||$_REQUEST['modul']=="sinkronsatu"){include "sinkron.php";}	
				elseif($_REQUEST['modul']=="berita_acara"){include "berita_acara.php";}	
				elseif($_REQUEST['modul']=="cetak_banksoal"){include "cetak_banksoal.php";}	
				elseif($_REQUEST['modul']=="database_ujian"){include "database_ujian.php";}
				elseif($_REQUEST['modul']=="daftar_waktu_db"){include "daftar_waktu_db.php";}
				elseif($_REQUEST['modul']=="daftar_nilai"){include "daftar_nilai.php";}	
				elseif($_REQUEST['modul']=="upl_hasil"){include "upload_hasil_proses.php";}
				elseif($_REQUEST['modul']=="upload_hasil"){include "upload_hasil.php";}		
				elseif($_REQUEST['modul']=="rekapesai"){include "rekapesai.php";}	
		?>
		
			
		
			
			
			</div> 
			<!-- END PAGE-CONTENT -->
			
			
		</div> 
		<!-- END PAGE-CONTENT WARAPER -->
	

	<!-- END CONTAINNER 	-->
		<div class="page-footer-fixed">
		<div class="page-footer" style="background-color:#364150">
				<div class="page-footer-inner">
				<center>
					<font align="center"> BeesmartV3.R5 Copyright &copy;&nbsp;2017&nbsp;By &nbsp;
					<a target="_blank" href="http://smpn6makassar.sch.id"><?php echo strtoupper($skull); ?></a> &nbsp;|&nbsp;Supported &nbsp;
					<a href="http://tuwagapat.com">BEESMART-Education Patner</a></font></center>
				</div>
				<div class="scroll-to-top" style="display: block;">
					<i class="icon-arrow-up"></i>
				</div>
		</div>
		</div>
		<!-- END PAGE-FOOTER 	-->	
	</div>
		<!-- END PAGE-wraper 	-->	

 



<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="jquery-1.4.js"></script>
<script src="date/jquery.js"></script>
<script src="jquery.datetimepicker.full.js"></script>
<script>
	/* window.onerror = function(errorMsg) {$('#console').html($('#console').html()+'<br>'+errorMsg)}*/
	$.noConflict();
	jQuery( document ).ready(function( $ ) {
		$.datetimepicker.setLocale('en');
		$('#datetimepicker_format').datetimepicker({value:'2015/04/15 05:03', format: $("#datetimepicker_format_value").val()});
			//console.log($('#datetimepicker_format').datetimepicker('getValue'));
		$("#datetimepicker_format_change").on("click", function(e){$("#datetimepicker_format").data('xdsoft_datetimepicker').setOptions({format: $("#datetimepicker_format_value").val()});});
		$("#datetimepicker_format_locale").on("change", function(e){$.datetimepicker.setLocale($(e.currentTarget).val()); });
		$('#datetimepicker').datetimepicker({dayOfWeekStart : 1, lang:'en', disabledDates:['1986/01/08','1986/01/09','1986/01/10'], startDate:	'1986/01/05' });
		$('#datetimepicker').datetimepicker({value:'2015/04/15 05:03',step:10});
		$('.some_class').datetimepicker();
		$('#default_datetimepicker').datetimepicker({ formatTime:'H:i',	formatDate:'d.m.Y',	defaultDate:'+03.01.1970', defaultTime:'10:00',	timepickerScrollbar:false });
		$('#tanggal1').datetimepicker({	timepicker:false, format:'m/d/Y', formatDate:'d/m/Y', });
		$('#datetimepicker_mask').datetimepicker({ mask:'9999/19/39 29:59' });
		$('#mulai1').datetimepicker({ datepicker:false, format:'H.i', step:5 });
		$('#akhir1').datetimepicker({ datepicker:false,	format:'H.i', step:5 });
		$('#datetimepicker_dark').datetimepicker({theme:'dark'}) 
	}); 

</script>


		
		
 <div class="modal fade" id="myInfo" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
		<form action="?&header5=yes" method="post">
            <div class="panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title page-label" align="center">
                    <a href="http://www.madiponegorobandung1.blogspot.com" target="_blank"><span style="color: #1B06CF;"><?php echo $skull; ?>-CBT </span></a>  </h2>
                </div>
				
				<?php if ($loginx=="1") { ?>
					<div class="panel-body">
						<div class="inner-content">
							<div class="wysiwyg-content">
								<p align="center"> <img src="../../images/beesmart.png" width="470"></p>
								<p align="center"> <br><b>BeeSMART</b> on Internet : <br>							
									<br><a href="https://www.youtube.com/watch?v=aceevCaKKH8&list=PLaRJCwMbrhIIj44b9JY08hf9C-FyJMtEt" target="_blank"><img src="images/youtube.png" width="60"></a> 
										&nbsp;&nbsp;&nbsp;&nbsp; 
										<a href="https://t.me/joinchat/AAAAAAtB2PtpcsPMaFEuKQ" target="_blank"><img src="images/telegram.png" width="30"></a> 
										&nbsp;&nbsp;&nbsp;&nbsp; 
										<a href="https://www.facebook.com/BSMARTLabs/" target="_blank"><img src="images/fb.png" width="30"> </a> 
										&nbsp;&nbsp;&nbsp;&nbsp;
										
									</br>
								</p>						
							</div>
						</div>
					</div>
					<div class="panel-footer" align="center">
						<div class="row">
						
							<a href="../../file-excel/panduan_cbt.pdf" target="_blank">
											<button type="button" class="btn btn-success btn-sm"><i class="fa fa-file-pdf-o"></i> &nbsp;Tutorial PDF</button>
										</a>
					
								
							<button type="submit" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>
						</div>
				<?php } else if ($loginx=="2") {?>
					
					<div class="panel-body">
						<?php 	echo " 
							<font color=#0714F7><center>ASSALAMU'ALAIKUM 
							<br> Selamat Datang di Aplikasi UASBK ".$skull."
							<br>Semoga Hari Anda Menyenangkan
							<p>Anda Login Sebagai GURU, Fitur yang bisa anda gunakan adalah sebagai berikut:
							</font><font color=#675B80>
							<p>1. Anda dapat melakukan Edit Biodata dan Foto Profil Anda
							<br>2. Anda dapat mengganti Password guna kerahasiaan akun anda
							<br>3. Anda dapat Membuat Bank Soal dan Edit Soal.
							<br>4. Anda dapat mendownload/print Analisa Hasil Ujian Siswa.
							<p></font>
							<br><font color=#646473> CARA MEMBUAT BANK SOAL</font>
							<br><font color=#675B80>
							<br>1. Membuat Bank Soal sesuai format excel template(oleh Guru)
<br>2. Upload File excel (oleh Guru/Admin)
<br>3.Edit Soal apabila dirasa perlu , seperti equation dan insert gambar (oleh Guru) dan jangan lupa pengacakan soal dan Kunci Jawaban harus diisi
<br>4. Mengaktifkan Status Bank Soal (oleh Guru/Admin), sehingga akan nampak pada halaman administrator untuk dibuat Paket Soal bersama Bank soal dari guru lain apabila akan melakukan tes pada waktu yang bersamaan.
<br>5. Buat jadwal/aktifkan ujian & generate Token (oleh Admin)
<br></font>
<br><font color=#646473>Catatan: </font><font color=#675B80>
<br>- Bank Soal tidak bisa dihapus atau diedit selama Sedang AKTIF digunakan ujian
<br>- Bank Soal yang aktif belum bisa dipergunakan untuk ujian bila belum di buat jawdwal ujian oleh Admin.
<br>- Tombol Delete/Hapus Bank Soal Disable bila Bank Soal sedang dipakai ujian, menghapus Bank Soal berarti juga menghapus daftar Analisa Hasil Ujian
							</font>

						"; ?>
					</div>
					<div class="panel-footer" align="center">
						<div class="arow">
							<button type="submit" class="btn btn-success btn-sm" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;&nbsp;Tutup</button>
						</div>
					</div>
				<?php } else { ?>
					<div class="panel-body">
						<?php 	echo " 
							<font color=#0714F7><center>ASSALAMU'ALAIKUM 
							<br> Selamat Datang di Aplikasi UASBK ".$skull."
							<br>Semoga Hari Anda Menyenangkan
							<p>Anda Login Sebagai SISWA, Fitur yang bisa anda gunakan adalah sebagai berikut:</font>
							<font color=#675B80>
							<p>1. Anda dapat melakukan Edit Biodata dan Foto Profil Anda
							<br>2. Anda dapat mengganti Password guna kerahasiaan akun anda
							<br>3. Anda dapat melihat data hasil nilai ujian pribadi dan teman Anda (juga kelas lain).
							<p></font>
							<br><font color=#646473> PERHATIAN !!!</font>
							<br><font color=#675B80>
							<br>Setelah Anda berhasil LOGIN Ubah Password yang diberikan Progtor/Teknisi, guna kerahasiaan Akun Anda karena Username dan Password awal Anda belum rahasia (hasil pengumuman).
							</font>
						"; ?>
					</div>
					<div class="panel-footer" align="center">
						<div class="arow">
							<button type="submit" class="btn btn-success btn-sm" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;&nbsp;Tutup</button>
						</div>
					</div>
				<?php } ?>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>


    <!-- Modal -->
<div class="modal fade in" id="myDaftarHadir" tabindex="-1" style="z-index:99999:" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <!-- Modal content-->
<div class="col-md-12">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
<h4 class="modal-title">Print Daftar Hadir</h4>
</div>
<div class="modal-body">
<form action="?modul=cetak_absensi" method="post">
    <table width="100%">
			<tr height="30px"><td><?php echo $rombel;?> </td><td>: &nbsp;&nbsp;<td>                          
                <select class="form-control" id="jur1"  name="jur1">
					<?php 	$sqk = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_kelas group by XKodeJurusan");
							while($rs = mysqli_fetch_array($sqk)){echo "<option value='$rs[XKodeJurusan]'>$rs[XKodeJurusan]</option>";} 
					?>                                
                </select>
			</td></tr> 
            <tr height="30px"><td width="30%">Kelas </td><td>: <td>
                <select class="form-control" id="iki1"  name="iki1">
					<?php 	$sqk = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_kelas group by XKodeKelas");
							while($rs = mysqli_fetch_array($sqk)){
                            echo "<option value='$rs[XKodeKelas]'>$rs[XKodeKelas]</option>";} 
					?>                                
                </select>
            </td></tr>
            <tr height="30px"><td width="30%">Sesi </td><td>: <td>
                <select class="form-control" id="sesi1"  name="sesi1">
					<?php	$sqk = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_siswa group by XSesi");
							while($rs = mysqli_fetch_array($sqk)){echo "<option value='$rs[XSesi]'>$rs[XSesi]</option>";} 
					?>                                
                </select>
            </td></tr> 
            <tr height="30px"><td width="30%">Ruang </td><td>: <td>
                <select class="form-control" id="ruang1"  name="ruang1">
					<?php	$sqk = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_siswa group by XRuang");
							while($rs = mysqli_fetch_array($sqk)){echo "<option value='$rs[XRuang]'>$rs[XRuang]</option>";} 
					?>                                
                </select>
            </td></tr>					
			<tr height="30px"><td width="30%">Mata Pelajaran </td><td>: <td>
                <select class="form-control" id="mapel1"  name="mapel1">
					<?php // edit Broo
							$sqk = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_mapel group by XKodeMapel");
							while($rs = mysqli_fetch_array($sqk)){echo "<option value='$rs[XNamaMapel]'>$rs[XKodeMapel] - $rs[XNamaMapel]</option>";} 
					?>                              
				</select>
			</td></tr>
			
			<tr height="30px"><td width="30%">Tanggal </td><td>: <td>
				<input class="form-control" id="tanggal1" name="tanggal1" type="text"/>
					<?php $tanggal1 = !empty($_POST['tanggal1']) ? $_POST['tanggal1'] : ''; ?> 
			<tr height="30px"><td width="30%">Jam Mulai </td><td>: <td>
				<input class="form-control" id="mulai1" name="mulai1" type="text"/>
					<?php $mulai1 = !empty($_POST['mulai1']) ? $_POST['mulai1'] : ''; ?> 
            </td></tr>
			<tr height="30px"><td width="30%">Jam Selesai </td><td>: <td>
                <input class="form-control" id="akhir1" name="akhir1" type="text"/>
					<?php $akhir1 = !empty($_POST['akhir1']) ? $_POST['akhir1'] : ''; ?> 
                                </td></tr>
	</table>
   
   
    </div>
	
    <div class="modal-footer">
        <button type="submit" class="btn btn-default btn-sm">
        <i class="glyphicon glyphicon-print"></i> Print Preview</button>
        <button type="submit" class="btn btn-default btn-sm" data-dismiss="modal"><i class="glyphicon glyphicon-minus-sign"></i> Tutup</button>
    </div>
    
</form>
 
</div>
</div>
</div>
</div>

<!-- Awal Modal myCetakKartu -->
<div class="modal fade" id="myCetakKartu" role="dialog">
	<div class="modal-dialog">
	<!-- Modal content-->
	<div class="modal-content">
	<div class="panel-default">
	<div class="panel-heading">
		<h1 class="panel-title page-label"><i class="glyphicon glyphicon-print"></i> | Kartu Ujian</h1>
	</div>

		<form action="?modul=cetak_kartu" method="post">
			<div class="panel-body">
			<div class="inner-content">
			<div class="wysiwyg-content">
				<p><table width="100%"  border="0" >
					<tr ><td><?php echo $rombel;?> </td><td>:&nbsp;&nbsp;<td>                                
						<select class="form-control" id="jur2"  name="jur2">
							<?php 	$sqk = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_kelas group by XKodeJurusan");
									while($rs = mysqli_fetch_array($sqk)){
									echo "<option value='$rs[XKodeJurusan]'>$rs[XKodeJurusan]</option>";} 
							?>                                
						</select>
					</td></tr> 
					<tr ><td >Kelas </td><td>: <td>
						<select class="form-control" id="iki2"  name="iki2">
							<?php 	$sqk = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_kelas group by XKodeKelas");
									while($rs = mysqli_fetch_array($sqk)){
									echo "<option value='$rs[XKodeKelas]'>$rs[XKodeKelas]</option>";} 
							?>                                
						 </select>
					</td></tr>
				</table></p>
			</div>
			</div>
			</div>
			
			<div class="panel-footer">
			<div class="row">
			<div class="col-xs-offset-7 col-xs-6">
				<button type="submit" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-print"></i> Print Preview</button>
				<button type="submit" class="btn btn-default btn-sm" data-dismiss="modal"><i class="glyphicon glyphicon-minus-sign"></i> Tutup</button>
			</div>
			</div>
			</div>
		</form>
	</div>
	</div>
	</div>
</div>
<!-- Ahir Modal myCetakKartu -->

<!-- Awal Modal myCetakKartuTO -->
<div class="modal fade" id="myCetakKartuTO" role="dialog">
	<div class="modal-dialog">
	<!-- Modal content-->
	<div class="modal-content">
	<div class="panel-default">
	<div class="panel-heading">
		<h1 class="panel-title page-label"><i class="glyphicon glyphicon-print"></i> | Kartu Ujian Try-Out</h1>
	</div>

		<form action="?modul=cetak_kartu_to" method="post">
			<div class="panel-body">
			<div class="inner-content">
			<div class="wysiwyg-content">
				<p><table width="100%"  border="0" >
					<tr ><td><?php echo $rombel;?> </td><td>:&nbsp;&nbsp;<td>                                
						<select class="form-control" id="jur2"  name="jur2">
							<?php 	$sqk = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_kelas group by XKodeJurusan");
									while($rs = mysqli_fetch_array($sqk)){
									echo "<option value='$rs[XKodeJurusan]'>$rs[XKodeJurusan]</option>";} 
							?>                                
						</select>
					</td></tr> 
					<tr ><td >Kelas </td><td>: <td>
						<select class="form-control" id="iki2"  name="iki2">
							<?php 	$sqk = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_kelas group by XKodeKelas");
									while($rs = mysqli_fetch_array($sqk)){
									echo "<option value='$rs[XKodeKelas]'>$rs[XKodeKelas]</option>";} 
							?>                                
						 </select>
					</td></tr>
				</table></p>
			</div>
			</div>
			</div>
			
			<div class="panel-footer">
			<div class="row">
			<div class="col-xs-offset-7 col-xs-6">
				<button type="submit" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-print"></i> Print Preview</button>
				<button type="submit" class="btn btn-default btn-sm" data-dismiss="modal"><i class="glyphicon glyphicon-minus-sign"></i> Tutup</button>
			</div>
			</div>
			</div>
		</form>
	</div>
	</div>
	</div>
</div>
<!-- Ahir Modal myCetakKartuTO -->


    <!-- Modal -->
<div class="modal fade" id="myCetakHasil" role="dialog">
<div class="modal-dialog">
    <!-- Modal content-->
<div class="modal-content">
<div class="panel-default">
<div class="panel-heading">
    <h1 class="panel-title page-label"><i class="glyphicon glyphicon-print"></i> | Hasil Ujian Ujian</h1>
</div>

<form action="?modul=cetak_hasil" method="post">
    <div class="panel-body">
    <div class="inner-content">
    <div class="wysiwyg-content">
        <p><table width="100%">
			<tr height="40px"><td>Jenis Tes</td><td>: &nbsp;&nbsp;<td>                                  
                <select class="form-control" id="tes3"  name="tes3">
					<?php	$sqk = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_tes");
							echo "<option value='ALL' selected>SEMUA</option>";	
							while($rs = mysqli_fetch_array($sqk)){echo "<option value=$rs[XKodeUjian]>$rs[XNamaUjian]</option>";} 							
					?>  
                </select>
			</td></tr>        
            <tr height="40px"><td width="30%">Semester</td><td>:<td>  
                <select class="form-control" id="sem3"  name="sem3">
					<option class="form-control" value="1">SEMUA</option>
					<option value=1>Ganjil</option>; 
					<option value=2>Genap</option>; 
                </select>
            </td></tr>
            <tr height="40px"><td><?php echo $rombel;?> </td><td>:<td>                                  
                <select class="form-control" id="jur3"  name="jur3">
					<?php	$sqk = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_kelas group by XKodeJurusan");
							while($rs = mysqli_fetch_array($sqk)){echo "<option value='$rs[XKodeJurusan]'>$rs[XKodeJurusan]</option>";} 
					?>                                
                </select>
			</td></tr> 
            <tr height="40px"><td width="30%">Kelas </td><td>:<td>  
                <select class="form-control" id="iki3"  name="iki3">
					<?php	$sqk = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_kelas group by XKodeKelas");
							while($rs = mysqli_fetch_array($sqk)){echo "<option value='$rs[XKodeKelas]'>$rs[XKodeKelas]</option>";}
					?>                                
                </select>
            </td></tr>
            <tr height="40px"><td>Mata Pelajaran </td><td>:<td>                               
                <select class="form-control" id="map3"  name="map3">
					<?php	$sqk = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_mapel");
								while($rs = mysqli_fetch_array($sqk)){echo "<option value='$rs[XKodeMapel]'>$rs[XKodeMapel] - $rs[XNamaMapel]</option>";} 
					?>                                
                </select>
			</td></tr> 
		</table></p>
    </div>
    </div>
    </div>
	<div class="panel-footer">
    <div class="row">
    <div class="col-xs-offset-7 col-xs-6">
        <button type="submit" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-print"></i> Print Preview</button>
        <button type="submit" class="btn btn-default btn-sm" data-dismiss="modal"><i class="glyphicon glyphicon-minus-sign"></i> Tutup</button>
    </div>
    </div>
    </div>
</form>
</div>
</div>
</div>
</div>

    <!-- Modal -->
<div class="modal fade" id="myCetakTO" role="dialog">
<div class="modal-dialog">
    <!-- Modal content-->
<div class="modal-content">
<div class="panel-default">
<div class="panel-heading"> <h1 class="panel-title page-label"><i class="glyphicon glyphicon-print"></i> | Hasil Ujian Try Out</h1></div>
<form action="?modul=cetak_TO" method="post">
    <div class="panel-body">
    <div class="inner-content">
    <div class="wysiwyg-content">
        <p><table width="100%">
			<tr height="40px"><td>Jenis Tes</td><td>:  &nbsp;&nbsp;<td>                                  
                <select class="form-control" id="tes3"  name="tes3">
					<?php	$sqk = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_tes"); echo "<option value='TO' >Try Out</option>"; ?>                                
                </select>
			</td></tr>        
            <tr height="40px"><td width="30%">Semester</td><td>:<td>   
                <select class="form-control" id="sem3"  name="sem3">
					<?php echo "<option value=1>Ganjil</option>"; echo "<option value=2>Genap</option>"; ?>                                
                </select>
            </td></tr>
            <tr height="40px"><td><?php echo $rombel;?> </td><td>:<td>                                  
                <select class="form-control" id="jur3"  name="jur3">
					<?php	$sqk = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_kelas group by XKodeJurusan");
							while($rs = mysqli_fetch_array($sqk)){echo "<option value='$rs[XKodeJurusan]'>$rs[XKodeJurusan]</option>";} 
					?>                                
                </select>
			</td></tr> 
            <tr height="40px"><td width="30%">Kelas </td><td>:<td>   
                <select class="form-control" id="iki3"  name="iki3">
					<?php	$sqk = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_kelas group by XKodeKelas");
							while($rs = mysqli_fetch_array($sqk)){echo "<option value='$rs[XKodeKelas]'>$rs[XKodeKelas]</option>";} 
					?>                                
                </select>
            </td></tr>
            <tr height="40px"><td>Mata Pelajaran </td><td>:<td>                               
                <select class="form-control" id="map3"  name="map3">
					<?php	$sqk = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_mapel");
							while($rs = mysqli_fetch_array($sqk)){echo "<option value='$rs[XKodeMapel]'>$rs[XKodeMapel]-$rs[XNamaMapel]</option>";} 
					?>                                
                </select>
			</td></tr> 
		</table></p>
    </div>
    </div>
    </div>
    <div class="panel-footer">
    <div class="row">
    <div class="col-xs-offset-7 col-xs-6">
        <button type="submit" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-print"></i> Print Preview</button>
		<button type="submit" class="btn btn-default btn-sm" data-dismiss="modal"><i class="glyphicon glyphicon-minus-sign"></i> Tutup</button>
    </div>
    </div>
    </div>
</form>
</div>
</div>
</div>
</div>

<!-- modal Mode Server -->
<div class="modal fade" id="myServer" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
		<!-- MEMBUAT FORM -->
			
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-gears fa-fw"></i> |  Mode Server</h4>
			</div>
			<form action="?&simpan5=yes" method="post">	
			<div class="modal-body">
			<div class="form-group">
					<label class="control-label">Mode Server </label>
						<select class="form-control" id="server1" name="server1">
							<option value='lokal' <?php if ($mode=="lokal") {echo "selected";} ?>>Mode Server PUSAT </option>
							<option value='pusat' <?php if ($mode=="pusat") {echo "selected";} ?>>Mode Server LOKAL </option>
						</select>
			</div>
			<div class="form-group">
					<label class="control-label">Zona Waktu</label>
						<select class="form-control" id="zona1" name="zona1">
							<option value='Asia/Jakarta' <?php if ($zo=="Asia/Jakarta") {echo "selected";} ?>>Asia/Jakarta (WIB)</option>
							<option value='Asia/Makassar' <?php if ($zo=="Asia/Makassar") {echo "selected";} ?>>Asia/Makassar (WITA)</option>
							<option value='Asia/Jayapura' <?php if ($zo=="Asia/Jayapura") {echo "selected";}?>>Asia/Jayapura (WIT) </option>
						</select>
			</div>
			<div class="form-group">
					<label class="control-label">Hak Akses</label>
						<select class="form-control" id="hakakses" name="hakakses">
							<option value='0' <?php if ($hakakses=="0") {echo "selected";} ?>>Tiga Hak Akses (Admin | Siswa | Guru)</option>
							<option value='1' <?php if ($hakakses=="1") {echo "selected";} ?>>Dua Hak Akses (Admin | Guru)</option>
						</select>
			</div>
			<div class="form-group">
					<label class="control-label">Nilai Kelas Login Siswa</label>
						<select class="form-control" id="nilaikelas" name="nilaikelas">
							<option value='0' <?php if ($nilaikelas=="0") {echo "selected";} ?>>Nilai Kelas Sembunyi</option>
							<option value='1' <?php if ($nilaikelas=="1") {echo "selected";} ?>>Nilai Kelas Tampil </option>
						</select>
			</div>
			<div class="form-group">
					<label class="control-label">Header  Ujian</label>
						<select class="form-control" id="headerujian" name="headerujian">
							<option value='0' <?php if ($headerujian=="0") {echo "selected";} ?>>Header Ujian Tampil</option>
							<option value='1' <?php if ($headerujian=="1") {echo "selected";} ?>>Header Ujian Sembunyi</option>
						</select>
			</div>
			<div class="form-group">
					<label class="control-label">Header Utama</label>
						<select class="form-control" id="header" name="header">
							<option value='0' <?php if ($header=="0") {echo "selected";} ?>>Header Modern</option>
							<option value='1' <?php if ($header=="1") {echo "selected";} ?>>Header Klasik </option>
						</select>	
			</div>
			</div>
			
			<div class="modal-footer">
						<button class="btn btn-primary" type="submit" class="btn btn-primary" style="margin-top:0px"><i class="fa fa-laptop"></i> Simpan</button>
						<button type="submit" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp; Batal &nbsp;&nbsp;</button>
			</div>
		</form>	
		</div>
	</div>
</div>


<!-- modal Mode Server -->
<div class="modal fade" id="db_server" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
		<!-- MEMBUAT FORM -->
		<form action="?&simpan_bd=yes" method="post">		
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-gear fa-fw"></i> | Install DataBase Server Baru</h4>
			</div>
			<div class="modal-body">
				<table width="80%" border="0" >
					<tr><td> &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;<td>Ubah db/Install db Baru<td >:&nbsp;&nbsp; &nbsp;<td >
						<?php echo "<input type='text' class='form-control' name='db_server' value='$db'>"; ?>
					</td><td></tr>
				</table>
			</div>
			<div class="modal-footer">
						<button class="btn btn-primary" type="submit" class="btn btn-primary" style="margin-top:0px"><i class="fa fa-laptop"></i> Simpan</button>
						<button type="submit" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp; Batal &nbsp;&nbsp;</button>
			</div>
		</form>	
		</div>
	</div>
</div>



		<script> function disableBackButton() { window.history.forward(); } setTimeout("disableBackButton()", 0); </script>
 <!-- BEGIN CORE PLUGINS -->
        <script src="../../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="../../assets/global/plugins/moment.min.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
		<script src="../../assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
		<script src="../../assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/amcharts/amcharts/pie.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/amcharts/amcharts/radar.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/amcharts/amcharts/themes/light.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/amcharts/amcharts/themes/patterns.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/amcharts/amcharts/themes/chalk.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/amcharts/ammap/ammap.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/amcharts/ammap/maps/js/worldLow.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/amcharts/amstockcharts/amstock.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/horizontal-timeline/horizontal-timeline.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="../../assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="../../assets/pages/scripts/dashboard.min.js" type="text/javascript"></script>
		
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="../../assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <script src="../../assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
        <script src="../../assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="../../assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
		
</body>

</html>