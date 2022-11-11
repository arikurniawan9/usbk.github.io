
<?php
include "../../config/server.php";
if($mode=="pusat"){
$sqlklien = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_admin");
$sk = mysqli_fetch_array($sqlklien);
$kodesekolah = $sk['XKodeSekolah'];
//echo $kodesekolah;
        include "../../config/ipserver.php";
              if(isset($_SERVER['SERVER_NAME'])){
              $serverIP = $_SERVER['SERVER_NAME'];
              $alamat2 = $_SERVER['SERVER_PORT'];
              }

        $domain =$ipserver;
        
        if ($domain=="" or $db_userm=="" or $db_pasw=="" or $db_nama==""){
            echo"";
        } else {

        if ($sock = @fsockopen($ipserver, 80, $num, $error, 5)){

        $status_server = 1;
        //$status_internet = "Tidak ada koneksi Internet | Offline"; ?>
        
        <?php
         $host_name = gethostbyaddr($_SERVER['REMOTE_ADDR']); //untuk mendeteksi computer name
        // echo"Nama Komputer : $host_name";
        ?>
        <?php
        $pc_client = $host_name;
        //echo "Server : $pc_client";z
        include "../../config/server_status.php";       
        
        $tglujian = date("Y-m-d");
        $xjam1 = date("H:i:s");   
        
        //echo $status_konek;
        if($status_konek=='1'){
        //$sqlhost = mysqli_query($GLOBALS["___mysqli_ston"], "select * from server_sekolah where XServerName = '$pc_client' and XServerId = '$kodesekolah'");
        $sqlhost = mysqli_query($GLOBALS["___mysqli_ston"], "select * from server_sekolah where XServerId = '$kodesekolah'");
        $sqlstatus = mysqli_num_rows($sqlhost);
        //echo "select * from server_sekolah where XServerName = '$pc_client'";
        $sq = mysqli_fetch_array($sqlhost);
        $var_status = $sq['XStatus'];
        $mulai = $sq['XMulai'];
        $selesai = $sq['XSelesai'];
                }
        else{
        $var_status = '';$mulai = '';$selesai = '';$sqlstatus = 9;}       
        //echo "var_server : |$var_status|,sqlstatus : $sqlstatus ";
        
            if($sqlstatus>0&&$var_status=='0'){
                $warna = "warning"; $server_status = "STANDBY";$txt_server_status = "Akses ke Server Pusat Ditutup SN sudah terdaftar di Server Pusat";$huruf ="#789BCC";$bg=
                "#789BCC";
                }
            elseif($var_status==''&&$sqlstatus>0){
                $warna = "danger"; $server_status = "OFFLINE";$txt_server_status = "CBTSync tidak terkoneksi ke server pusat";$huruf ="red";$bg=
                "red";}
            elseif($sqlstatus==0&&$var_status=='') { 
                $warna = "warning"; $server_status = "STANDBY";$txt_server_status = "ID Server / SN tidak sesuai dengan data server pusat"; $huruf ="#ffca01";$bg="#ffca01";}
            elseif($sqlstatus>0&&$var_status>0&&$xjam1>=$mulai&&$xjam1<=$selesai){
                $warna = "info"; $server_status = "AKTIF";$txt_server_status = "CBTSync Siap Digunakan"; $huruf ="#10d8f3";$bg="#15c0d7"; }
            
            elseif($sqlstatus>0&&$var_status>0&&$xjam1>=$selesai){
                $warna = "info"; $server_status = "STANDBY";$txt_server_status = "Akses ke Server Pusat Ditutup SN sudah terdaftar di Server Pusat"; $huruf ="#789BCC";$bg="#789BCC"; }
            
            elseif($sqlstatus>0&&$var_status>0&&$xjam1<=$mulai){
                $warna = "info"; $server_status = "STANDBY";$txt_server_status = "Akses ke Server Pusat Ditutup SN sudah terdaftar di Server Pusat"; $huruf ="#789BCC";$bg="#789BCC"; }
        ?>       
        <?php 
        }else { 
        $warna = "danger"; $server_status = "OFFLINE";$txt_server_status = "CBTSync Tidak Terhubung dengan Internet"; $huruf ="red";$bg="red";
        ?>      
        <?php
        }}
}else{

include "../../config/server.php";
$host_name = gethostbyaddr($_SERVER['REMOTE_ADDR']); //untuk mendeteksi computer name
?>
<?php
}
?>
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
        $headerujiann =$hdr['HeaderUjian'];
        $nilaikelass =$hdr['XNilaiKelas'];
        $hakaksess =$hdr['HakAkses'];
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
    elseif($_REQUEST['modul']=="daftar_jenis_tes"){$bread = "<font color=#646473>Daftar Jenis Tes </font>| Hapus, & Edit Jenis Tes";}  
    elseif($_REQUEST['modul']=="update_sekolah"){$bread = "<font color=#646473>Update dan Setting </font>| Sekolah";}           
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
    elseif($_REQUEST['modul']=="backup_data"){$bread = "<font color=#646473>BackUp & Restore</font> | BackUp, Hapus & Restor DataBase";}
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

            elseif($_REQUEST['modul']=="reset_peserta_test"){
            $bread = "Reset Login Peserta";
            } 
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
    elseif($_REQUEST['modul']=="status_tes"){$bread = "Status Tes";}       

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
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title><?php echo $skull; ?> | Administrator</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #6 for statistics, charts, recent events and reports" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN LAYOUT FIRST STYLES -->
        <link href="//fonts.googleapis.com/css?family=Oswald:400,300,700" rel="stylesheet" type="text/css" />
        <!-- END LAYOUT FIRST STYLES -->
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="../assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="../assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="../assets/layouts/layout6/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/layouts/layout6/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="../../images/icon.png" /> </head>
    <!-- END HEAD -->

<link rel="stylesheet" type="text/css" href="jquery.datetimepicker.css"/>


<script type="text/javascript">
function mousedwn(e){try{if(event.button==2||event.button==3)return fancyboxlse}catch(e){if(e.which==3)return false}}document.oncontextmenu=function(){return false};document.ondragstart=function(){return false};document.onmousedown=mousedwn
</script>
<script type="text/javascript">
window.addEventListener("keydown",function(e){if(e.ctrlKey&&(e.which==65||e.which==66||e.which==67||e.which==73||e.which==80||e.which==83||e.which==85||e.which==86)){e.preventDefault()}});document.keypress=function(e){if(e.ctrlKey&&(e.which==65||e.which==66||e.which==67||e.which==73||e.which==80||e.which==83||e.which==85||e.which==86)){}return false}
</script>
<script type="text/javascript">
document.onkeydown=function(e){e=e||window.event;if(e.keyCode==123||e.keyCode==18){return false}}
</script>











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
startDate:  '1986/01/05'
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
    <body class="">
        <!-- BEGIN HEADER -->
        <header class="page-header">
            <nav class="navbar" role="navigation">
                <div class="container-fluid">
                    <div class="havbar-header">
                               <?php
             if ($xserver=="pusat"){?>

                        <a href="index.php">
                        <img src="../../images/<?php echo "$skul_ban"; ?>" alt="logo" class="logo-default" style="width:320px; margin-top: 10px"   /> </a>
                        <!-- END LOGO -->
                        <!-- BEGIN TOPBAR ACTIONS -->
                        <div class="topbar-actions">
                            <div class="btn-group-notification btn-group" id="header_notification_bar">
              <table width="100%" border="0"><tr>
                <td align="right" width="30%">                   
                   <label style="text-align:center; font-size:18px; margin-top:-25px; margin-right:35px">&nbsp;<h4 style="color:<?php echo $huruf; ?>; font-size:35px"><p><b><?php echo $server_status; ?></b></p></h4></label></td></tr>
             </table>
            <?php } else { ?>

                        <a href="index.php">
                        <img src="../../images/<?php echo "$skul_ban"; ?>" alt="logo" class="logo-default" style="width:320px"   /> </a>
                        <!-- END LOGO -->
                        <!-- BEGIN TOPBAR ACTIONS -->
                        <div class="topbar-actions">
                            <div class="btn-group-notification btn-group" id="header_notification_bar">
              <table width="100%" border="0"><tr>
                <td align="right" width="30%">                   
                   <label style="text-align:center; font-size:18px; margin-top:-30px; margin-right:35px">&nbsp;<h4 style="color: #10d8f3; font-size:35px"><p><b>SERVER</b></p></h4></label></td></tr>
             </table>
                        <?php }?>
                            </div>
                        </div>
                        <!-- END TOPBAR ACTIONS -->
                    </div>
                </div>
                <!--/container-->
            </nav>
        </header>
        <!-- END HEADER -->
        <!-- BEGIN CONTAINER -->
        <div class="container-fluid">
            <div class="page-content page-content-popup">
                <div class="page-content-fixed-header">
                    <!-- BEGIN BREADCRUMBS -->
                    <ul class="page-breadcrumb">
                        <li>
                            <a href="index.php">Dashboard</a>
                        </li>
                        <li><?php
                            if(isset($bread)){
                            echo $bread;} ?></li>
                    </ul>
                    <!-- END BREADCRUMBS -->
                    <div class="content-header-menu">
                        <!-- BEGIN DROPDOWN AJAX MENU -->
                        
                        <!-- END DROPDOWN AJAX MENU -->
                        <!-- BEGIN MENU TOGGLER -->
                        <button type="button" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="toggle-icon">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </span>
                        </button>
                        <!-- END MENU TOGGLER -->
                    </div>
                </div>

                <div class="page-sidebar-wrapper">
                    <!-- BEGIN SIDEBAR -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <div class="page-sidebar navbar-collapse collapse">
                        <!-- BEGIN SIDEBAR MENU -->
                        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                            <?php if($loginx=="1"){?>           
                            <li class="nav-item  ">
                                <a href="index.php" class="nav-link ">
                                    <i class="icon-home"></i>
                                    <span class="title">Beranda</span>
                                </a>
                            </li>

                            <?php
                            if ($xserver=="pusat"){?>
                            <?php if($server_status == "AKTIF"){ ?>
                            <li class="nav-item  ">
                                <a href="?modul=sinkron" class="nav-link ">
                                    <i class="icon-cloud-download"></i>
                                    <span class="title">Status Download</span>
                                </a>
                            </li> 

                                                            <?php } else { ?>
                                                            
                                                            <?php } ?> <?php } else { ?><?php }?>
                            <li class="nav-item  ">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-screen-desktop"></i>
                                    <span class="title">System Server</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item  ">
                                        <a href="#" data-toggle="modal" data-target="#myServer"  class="nav-link " data-scroll>
                                            <i class="icon-drawer"></i>
                                            <span class="title">Setting Server</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <?php if ($xserver=="lokal"){?>
                                        <a href="?modul=data_skul" class="nav-link ">
                                            <i class="icon-feed"></i>
                                            <span class="title">Server Sekolah (Klien)</span> 
                                        </a>
                                        <?php } else { ?>
                                        <a href="?modul=set_server" class="nav-link ">
                                            <i class="icon-feed"></i>
                                            <span class="title">Server Pusat</span> 
                                        </a>
                                        <?php }?>
                                    </li>
                                    <li class="nav-item ">
                                        <a href="?modul=data_user" class="nav-link ">
                                            <i class="icon-user-follow"></i>
                                            <span class="title">Manajemen User</span>   
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="#" data-toggle="modal" data-target="#db_server" class="nav-link " >
                                            <i class="icon-folder"></i>
                                            <span class="title">Ubah Database</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item  ">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-notebook"></i>
                                    <span class="title">Administrative</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item  ">
                                        <a href="?modul=info_skul" class="nav-link ">
                                            <i class="icon-graduation"></i>
                                            <span class="title">Identitas Sekolah</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="?modul=daftar_kelas" class="nav-link ">
                                            <i class="icon-list"></i>
                                            <span class="title">Daftar Kelas</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="?modul=daftar_mapel" class="nav-link ">
                                            <i class="icon-docs"></i>
                                            <span class="title">Mata Pelajaran</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="?modul=daftar_jenis_tes" class="nav-link ">
                                            <i class="icon-check"></i>
                                            <span class="title">Jenis Tes</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item  ">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-book-open"></i>
                                    <span class="title">Bank Soal</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item  ">
                                        <a href="?modul=daftar_soal" class="nav-link ">
                                            <i class="icon-folder-alt"></i>
                                            <span class="title">Daftar Bank Soal</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="?modul=file_pendukung" class="nav-link ">
                                            <i class="icon-film"></i>
                                            <span class="title">File Pendukung</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="?modul=upl_tugas" class="nav-link ">
                                            <i class="icon-arrow-up"></i>
                                            <span class="title">Nilai Tugas</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item  ">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-printer"></i>
                                    <span class="title">Cetak</span>
                                    <span class="arrow"></span>
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
                             <li class="nav-item  ">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-pencil"></i>
                                    <span class="title">Setting Test</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    
                                <li class="nav-item  ">
                                    <a href="?modul=daftar_tesbaru" class="nav-link ">
                                        <i class="icon-reload"></i>
                                        <span class="title">Setting Ujian</span>
                                        
                                    </a>
                                </li>
                                <li class="nav-item  ">
                                    <a href="?modul=aktifkan_jadwaltes" class="nav-link ">
                                        <i class="icon-paper-plane"></i>
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
                                        <i class="icon-loop"></i>
                                        <span class="title">Database Ujian</span>
                                        
                                    </a>
                                </li>
                                </ul>
                            </li>
                            <li class="nav-item  ">
                                <a href="?modul=daftar_siswa" class="nav-link ">
                                    <i class="icon-docs"></i>
                                    <span class="title">Daftar Peserta</span>
                                </a>
                            </li>
                            <li class="nav-item  ">
                                <a href="?modul=status_tes" class="nav-link ">
                                    <i class="icon-note"></i>
                                    <span class="title">Status Test</span>
                                </a>
                            </li>
                            <li class="nav-item  ">
                                <a href="?modul=daftar_peserta" class="nav-link ">
                                    <i class="icon-user-following"></i>
                                    <span class="title">Status Peserta</span>
                                </a>
                            </li>
                            <li class="nav-item  ">
                                <a href="?modul=reset_peserta_test" class="nav-link ">
                                    <i class="icon-refresh"></i>
                                    <span class="title">Reset Login Peserta</span>
                                </a>
                            </li>
                            <li class="nav-item  ">
                                <a href="?modul=analisasoal" class="nav-link ">
                                    <i class="icon-graph"></i>
                                    <span class="title">Laporan</span>
                                </a>
                            </li>                            
                            <?php
                            if ($xserver=="pusat"){?>
                              <li class="nav-item ">
                                    <a href="?modul=upload_hasil" class="nav-link nav-toggle ">
                                        <i class="icon icon-cloud-upload"></i>
                                        <span class="title">Upload Hasil Ujian</span>
                                        <span class="selected"></span>
                                        
                                    </a>
                            </li><?php } else { ?><?php }?>
                            <li class="nav-item  ">
                                <a href="?modul=backup" class="nav-link ">
                                    <i class="icon-settings"></i>
                                    <span class="title">Back up & Hapus</span>
                                </a>
                            </li>
                            <li class="nav-item  ">
                                <a href="?modul=upl_foto" class="nav-link ">
                                    <i class="icon-screen-smartphone"></i>
                                    <span class="title">Foto Peserta Tes</span>
                                </a>
                            </li>
                            <li class="nav-item  ">
                                <a href="logout.php" class="nav-link ">
                                    <i class="icon-logout"></i>
                                    <span class="title">Logout</span>
                                </a>
                            </li>
                            <?php } ?> 


                             <!-- LOGIN SEKOLAH -->
                            <?php if($loginx=="2"){?>           
                            <li class="nav-item  ">
                                <a href="index.php" class="nav-link ">
                                    <i class="icon-home"></i>
                                    <span class="title">Beranda</span>
                                </a>
                            </li>
                           
                            <li class="nav-item  ">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-book-open"></i>
                                    <span class="title">Bank Soal</span>
                                    <span class="arrow"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item  ">
                                        <a href="?modul=daftar_soal" class="nav-link ">
                                            <i class="icon-folder-alt"></i>
                                            <span class="title">Daftar Bank Soal</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="?modul=file_pendukung" class="nav-link ">
                                            <i class="icon-film"></i>
                                            <span class="title">File Pendukung</span>
                                        </a>
                                    </li>
                                    <li class="nav-item  ">
                                        <a href="?modul=upl_tugas" class="nav-link ">
                                            <i class="icon-arrow-up"></i>
                                            <span class="title">Nilai Tugas</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item  ">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-printer"></i>
                                    <span class="title">Cetak</span>
                                    <span class="arrow"></span>
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

                            <li class="nav-item  ">
                                <a href="?modul=analisasoal" class="nav-link ">
                                    <i class="icon-graph"></i>
                                    <span class="title">Laporan</span>
                                </a>
                            </li>                        
                            <?php
                            if ($xserver=="pusat"){?>
                            <li class="nav-item ">
                                    <a href="?modul=upload_hasil" class="nav-link nav-toggle ">
                                        <i class="icon icon-cloud-upload"></i>
                                        <span class="title">Upload Hasil Ujian</span>
                                        <span class="selected"></span>
                                        
                                    </a>
                            </li>  <?php } else { ?><?php }?>

                            <li class="nav-item  ">
                                <a href="logout.php" class="nav-link ">
                                    <i class="icon-logout"></i>
                                    <span class="title">Logout</span>
                                </a>
                            </li>
                        <?php } ?> 
                        
                        <?php if ($_COOKIE['beelogin']=="siswa"){?>
                        <li>
                            <a  href="?modul=daftar_nilai">
                                <i class="icon icon-list"></i> Daftar Nilai</a>
                        </li>
                        <li>
                            <a href="logout.php">
                                <i class="icon-logout"></i> Log Out </a>
                        </li>
                        <?php } ?>
                        </ul>
                        <!-- END SIDEBAR MENU -->
                    </div>
                    <!-- END SIDEBAR -->
                </div>
                <div class="page-fixed-main-content">





























                    <div class="clearfix"></div>
                    <!-- END DASHBOARD STATS 1-->
    

     
                    <div class="row">
                        <div class="col-lg-12 col-xs-12 col-sm-12">
                         <div class="portlet light bordered">
                                

        <?php   if(isset($_REQUEST['modul'])==""){include "none.php";}  
                elseif($_REQUEST['modul']=="aktifkan_jadwaltes"){include "daftar_tes.php";}         
                elseif($_REQUEST['modul']=="buat_paketsoal"){include "buat_paketbaru.php";} 
                elseif($_REQUEST['modul']=="buat_soal"){include "buat_banksoal.php";}
                elseif($_REQUEST['modul']=="daftar_kelas"){include "daftar_kelas.php";} 
                elseif($_REQUEST['modul']=="daftar_jenis_tes"){include "jenis_ujian.php";} 
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
                elseif($_REQUEST['modul']=="update_sekolah"){include "update_sekolah.php";}
                elseif($_REQUEST['modul']=="info_skul"){include "upl_skul.php";}    
                elseif($_REQUEST['modul']=="status_tes1"){include "status_tes.php";}
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
                elseif($_REQUEST['modul']=="status_tes"){include "rilis_token.php";}              
                elseif($_REQUEST['modul']=="cetak_absensi"){include "cetak_absen.php";} 
                elseif($_REQUEST['modul']=="cetak_berita"){include "cetak_berita.php";} 
                elseif($_REQUEST['modul']=="cetak_hasil"){include "cetak_hasil_ujian.php";} 
                elseif($_REQUEST['modul']=="cetak_TO"){include "cetak_hasil_TO.php";}   
                elseif($_REQUEST['modul']=="hasil_peserta"){include "cetak_hasil_analisa.php";} 
                elseif($_REQUEST['modul']=="jawabansiswa"){include "jawabansiswa.php";} 
                elseif($_REQUEST['modul']=="jawabanesai"){include "jawabanesai_siswa.php";} 
                elseif($_REQUEST['modul']=="analisasoal"){include "analisa_soal.php";}  
                elseif($_REQUEST['modul']=="analisajawaban"){include "analisa_jawaban.php";}
                elseif($_REQUEST['modul']=="reset_peserta_test"){include "daftar_tes_reset.php";} 
                elseif($_REQUEST['modul']=="analisabutir"){include "analisa_butirsoal.php";}    
                elseif($_REQUEST['modul']=="sebaran_nilai"){include "sebaran_nilai.php";}   
                elseif($_REQUEST['modul']=="lks"){include "lks.php";}   
                elseif($_REQUEST['modul']=="backup"){include "backup.php";} 
                elseif($_REQUEST['modul']=="backup_data"){include "backup_data.php";}
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
                        </div>
                    </div>
                    <!-- END PAGE BASE CONTENT -->
                </div>
                <!-- BEGIN FOOTER -->
                <p class="copyright-v2">Copyright &copy; 2018 Computer Based Test -
                    <a target="_blank" href="http://ginanjar-ru.com"> Ginanjar Restu U., S.Pd.</a>
                </p>
                <!-- BEGIN QUICK SIDEBAR TOGGLER -->
              
                <!-- END QUICK SIDEBAR TOGGLER -->
                <a href="#index" class="go2top">
                    <i class="icon-arrow-up"></i>
                </a>
                <!-- END FOOTER -->
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
            <tr height="30px"><td width="30%">Jenis Ujian </td><td>: <td>
                <select class="form-control" id="jenisuji"  name="jenisuji">
                    <?php   $sqk = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_tes group by Urut");
                            while($rs = mysqli_fetch_array($sqk)){
                            echo "<option value='$rs[XKodeUjian]'>$rs[XNamaUjian]</option>";} 
                    ?>                                
                </select>
            </td></tr>
            <tr height="30px"><td><?php echo $rombel;?> </td><td>: &nbsp;&nbsp;<td>                          
                <select class="form-control" id="jur1"  name="jur1">
                    <?php   $sqk = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_kelas group by XKodeJurusan");
                            while($rs = mysqli_fetch_array($sqk)){echo "<option value='$rs[XKodeJurusan]'>$rs[XKodeJurusan]</option>";} 
                    ?>                                
                </select>
            </td></tr>
            <tr height="30px"><td width="30%">Kelas </td><td>: <td>
                <select class="form-control" id="iki1"  name="iki1">
                    <?php   $sqk = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_kelas group by XKodeKelas");
                            while($rs = mysqli_fetch_array($sqk)){
                            echo "<option value='$rs[XKodeKelas]'>$rs[XKodeKelas]</option>";} 
                    ?>                                
                </select>
            </td></tr>
            <tr height="30px"><td width="30%">Sesi </td><td>: <td>
                <select class="form-control" id="sesi1"  name="sesi1">
                    <?php   $sqk = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_siswa group by XSesi");
                            while($rs = mysqli_fetch_array($sqk)){echo "<option value='$rs[XSesi]'>$rs[XSesi]</option>";} 
                    ?>                                
                </select>
            </td></tr> 
            <tr height="30px"><td width="30%">Ruang </td><td>: <td>
                <select class="form-control" id="ruang1"  name="ruang1">
                    <?php   $sqk = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_siswa group by XRuang");
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
        <button type="submit" class="btn green">
        <i class="glyphicon glyphicon-print"></i> Print Preview</button>
        <button type="submit" class="btn dark btn-outline" data-dismiss="modal"><i class="glyphicon glyphicon-minus-sign"></i> Tutup</button>
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
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-print fa-fw"></i> |  Kartu Ujian</h4>
    </div>

        <form action="?modul=cetak_kartu" method="post">
            <div class="modal-body">
            <div class="form-group">
                <p><table width="100%"  border="0" >
                    <tr ><td><?php echo $rombel;?> </td><td>:&nbsp;&nbsp;<td>                                
                        <select class="form-control" id="jur2"  name="jur2">
                            <?php   $sqk = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_kelas group by XKodeJurusan");
                                    while($rs = mysqli_fetch_array($sqk)){
                                    echo "<option value='$rs[XKodeJurusan]'>$rs[XKodeJurusan]</option>";} 
                            ?>                                
                        </select>
                    </td></tr> 
                    <tr ><td >Kelas </td><td>: <td>
                        <select class="form-control" id="iki2"  name="iki2">
                            <?php   $sqk = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_kelas group by XKodeKelas");
                                    while($rs = mysqli_fetch_array($sqk)){
                                    echo "<option value='$rs[XKodeKelas]'>$rs[XKodeKelas]</option>";} 
                            ?>                                
                         </select>
                    </td></tr>
                </table></p>
            </div>
            </div>
            
            <div class="panel-footer">
            <div class="row">
            <div class="col-xs-offset-7 col-xs-6">
                <button type="submit" class="btn green"><i class="glyphicon glyphicon-print"></i> Print Preview</button>
                <button type="submit" class="btn dark btn-outline" data-dismiss="modal"><i class="glyphicon glyphicon-minus-sign"></i> Tutup</button>
            </div>
            </div>
            </div>
        </form>
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
                            <?php   $sqk = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_kelas group by XKodeJurusan");
                                    while($rs = mysqli_fetch_array($sqk)){
                                    echo "<option value='$rs[XKodeJurusan]'>$rs[XKodeJurusan]</option>";} 
                            ?>                                
                        </select>
                    </td></tr> 
                    <tr ><td >Kelas </td><td>: <td>
                        <select class="form-control" id="iki2"  name="iki2">
                            <?php   $sqk = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_kelas group by XKodeKelas");
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
                    <?php   $sqk = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_tes");
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
                    <?php   $sqk = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_kelas group by XKodeJurusan");
                            while($rs = mysqli_fetch_array($sqk)){echo "<option value='$rs[XKodeJurusan]'>$rs[XKodeJurusan]</option>";} 
                    ?>                                
                </select>
            </td></tr> 
            <tr height="40px"><td width="30%">Kelas </td><td>:<td>  
                <select class="form-control" id="iki3"  name="iki3">
                    <?php   $sqk = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_kelas group by XKodeKelas");
                            while($rs = mysqli_fetch_array($sqk)){echo "<option value='$rs[XKodeKelas]'>$rs[XKodeKelas]</option>";}
                    ?>                                
                </select>
            </td></tr>
            <tr height="40px"><td>Mata Pelajaran </td><td>:<td>                               
                <select class="form-control" id="map3"  name="map3">
                    <?php   $sqk = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_mapel");
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
                    <?php   $sqk = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_tes"); echo "<option value='TO' >Try Out</option>"; ?>                                
                </select>
            </td></tr>        
            <tr height="40px"><td width="30%">Semester</td><td>:<td>   
                <select class="form-control" id="sem3"  name="sem3">
                    <?php echo "<option value=1>Ganjil</option>"; echo "<option value=2>Genap</option>"; ?>                                
                </select>
            </td></tr>
            <tr height="40px"><td><?php echo $rombel;?> </td><td>:<td>                                  
                <select class="form-control" id="jur3"  name="jur3">
                    <?php   $sqk = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_kelas group by XKodeJurusan");
                            while($rs = mysqli_fetch_array($sqk)){echo "<option value='$rs[XKodeJurusan]'>$rs[XKodeJurusan]</option>";} 
                    ?>                                
                </select>
            </td></tr> 
            <tr height="40px"><td width="30%">Kelas </td><td>:<td>   
                <select class="form-control" id="iki3"  name="iki3">
                    <?php   $sqk = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_kelas group by XKodeKelas");
                            while($rs = mysqli_fetch_array($sqk)){echo "<option value='$rs[XKodeKelas]'>$rs[XKodeKelas]</option>";} 
                    ?>                                
                </select>
            </td></tr>
            <tr height="40px"><td>Mata Pelajaran </td><td>:<td>                               
                <select class="form-control" id="map3"  name="map3">
                    <?php   $sqk = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_mapel");
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
                            <option value='0' <?php if ($hakaksess=="0") {echo "selected";} ?>>Tampilkan Hak Akses</option>
                            <option value='1' <?php if ($hakaksess=="1") {echo "selected";} ?>>Sembunyikan Hak Akses</option>
                        </select>
            </div>
            <div class="form-group">
                    <label class="control-label">Nilai Kelas Login Siswa</label>
                        <select class="form-control" id="nilaikelas" name="nilaikelas">
                            <option value='0' <?php if ($nilaikelass=="0") {echo "selected";} ?>>Nilai Kelas Sembunyi</option>
                            <option value='1' <?php if ($nilaikelass=="1") {echo "selected";} ?>>Nilai Kelas Tampil </option>
                        </select>
            </div>
            <div class="form-group">
                    <label class="control-label">Jenis Client</label>
                        <select class="form-control" id="headerujian" name="headerujian">
                            <option value='0' <?php if ($headerujiann=="0") {echo "selected";} ?>>Komputer/PC/Laptop</option>
                            <option value='1' <?php if ($headerujiann=="1") {echo "selected";} ?>>HP/Smartphone/Tablet</option>
                        </select>
            </div>
            <div class="form-group" hidden="">
                    <label class="control-label">Header Utama</label>
                        <select class="form-control" id="header" name="header">
                            <option value='0' <?php if ($header=="0") {echo "selected";} ?>>Header Modern</option>
                            <option value='1' <?php if ($header=="1") {echo "selected";} ?>>Header Klasik </option>
                        </select>   
            </div>
            </div>
            
            <div class="modal-footer">
                        <button class="btn green" type="submit"  style="margin-top:0px"><i class="fa fa-laptop"></i> Simpan</button>
                        <button type="submit" class="btn dark btn-outline" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp; Batal &nbsp;&nbsp;</button>
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
                        <button class="btn green" type="submit" style="margin-top:0px"><i class="fa fa-laptop"></i> Simpan</button>
                        <button type="submit" class="btn dark btn-outline" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp; Batal &nbsp;&nbsp;</button>
            </div>
        </form> 
        </div>
    </div>
</div>









        <div class="quick-nav-overlay"></div>
        <script src="../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="../assets/global/plugins/moment.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/amcharts/amcharts/pie.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/amcharts/amcharts/radar.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/amcharts/amcharts/themes/light.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/amcharts/amcharts/themes/patterns.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/amcharts/amcharts/themes/chalk.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/amcharts/ammap/ammap.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/amcharts/ammap/maps/js/worldLow.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/amcharts/amstockcharts/amstock.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/horizontal-timeline/horizontal-timeline.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="../assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->

        <script src="../assets/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script>
        <script src="../assets/pages/scripts/dashboard.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="../assets/layouts/layout6/scripts/layout.min.js" type="text/javascript"></script>
        <script src="../assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="../assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
        <script>
            $(document).ready(function()
            {
                $('#clickmewow').click(function()
                {
                    $('#radio1003').attr('checked', 'checked');
                });
            })
        </script>
    </body>

</html>