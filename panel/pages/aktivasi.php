<?php
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
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.7
Version: 4.7.5
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Metronic Admin Theme #6 | Tabs, Accordions & Navs</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #6 for metronic and bootstrap custom navbars, tabs, pills, accordions and resizable tabs based on bootstrap-tabdrop plugin" name="description" />
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
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="../assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="../assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="../assets/layouts/layout6/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/layouts/layout6/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->

    <body class="">
        <div class="container-fluid">
            <div class="page-content page-content-popup">
                
                




















                    <!-- BEGIN PAGE BASE CONTENT -->
                        <div class="col-md-12">
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-social-dribbble font-purple-soft"></i>
                                        <span class="caption-subject font-purple-soft bold uppercase">CBT Tools</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#tab_1_1" data-toggle="tab"> Auto Patch </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_2" data-toggle="tab"> Upgrade </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_3" data-toggle="tab"> Hak Akses </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_4" data-toggle="tab"> Setting Database </a>
                                        </li>
                                        <li>
                                            <a href="#tab_1_5" data-toggle="tab"> Aktivasi </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade active in" id="tab_1_1">
                                            <p> Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher
                                                retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi
                                                qui. </p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_2">
                                            <p> Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft
                                                beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica
                                                VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester
                                                stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park. </p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_3">
                                            <p> Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard
                                                locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie
                                                etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr. </p>
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
                                        <div class="tab-pane fade" id="tab_1_4">
                                            <p> Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore
                                                wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh
                                                craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan. </p>
                                        </div>
                                        <div class="tab-pane fade" id="tab_1_5">
                                            <p> Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft
                                                beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica
                                                VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester
                                                stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park. </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <!-- END PAGE BASE CONTENT -->
                </div>
                <!-- BEGIN FOOTER -->
                <p class="copyright-v2"> 2016 &copy; Metronic Theme By
                    <a target="_blank" href="http://keenthemes.com">Keenthemes</a> &nbsp;|&nbsp;
                    <a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" title="Purchase Metronic just for 27$ and get lifetime updates for free" target="_blank">Purchase Metronic!</a>
                </p>
            </div>
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN QUICK SIDEBAR -->

        <!-- END QUICK SIDEBAR -->
        <!-- BEGIN QUICK NAV -->
      
        <div class="quick-nav-overlay"></div>
        <!-- END QUICK NAV -->
        <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<script src="../assets/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="../assets/global/plugins/bootstrap-tabdrop/js/bootstrap-tabdrop.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="../assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
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