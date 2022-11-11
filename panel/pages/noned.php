                           
<?php 
if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
	if($_COOKIE['beelogin']=="siswa"||$_COOKIE['beelogin']=="guru"){
		echo "";
		
	}else{
		$re = mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_user WHERE Username='$_COOKIE[beeuser]'"));
		$poto  = $re['XPoto'];
		$loginx = $re['login'];
		$nama  =$re['Nama'];
	

	if($poto==''){$gambar="avatar.gif";} else {$gambar=$poto;} 
	if($loginx=='1'){$ucap="Admin"; $ucap2 ="Administrator" ;} else  if($loginx=='2'){$ucap="Guru"; $ucap2 ="Guru Mapel" ;}  else {$ucap="Siswa"; $ucap2="Nama Siswa";} 
	
	
	}
	
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
		
		if ($sock = @fsockopen($ipserver, 80, $num, $error, 5)){
		$status_server = 1;
		
		 $host_name = gethostbyaddr($_SERVER['REMOTE_ADDR']); //untuk mendeteksi computer name
		// echo"Nama Komputer : $host_name";
		
		$pc_client = $host_name;
		//echo "Server : $pc_client";z
		include "../../config/server_status.php";		
		
		//echo $status_konek;
		if($status_konek=='1'){
		//$sqlhost = mysql_query("select * from server_sekolah where XServerName = '$pc_client' and XServerId = '$kodesekolah'");
		$sqlhost = mysqli_query($GLOBALS["___mysqli_ston"], "select * from server_sekolah where XServerId = '$kodesekolah'");
		$sqlstatus = mysqli_num_rows($sqlhost);
		//echo "select * from server_sekolah where XServerName = '$pc_client'";
		$sq = mysqli_fetch_array($sqlhost);
		$var_status = $sq['XStatus'];}
		else{
		$var_status = '';$sqlstatus = 9;}		
		//echo "var_server : |$var_status|,sqlstatus : $sqlstatus ";
		
			if($sqlstatus>0&&$var_status=='0'){
				$warna = "warning"; $server_status = "STANDBY";$txt_server_status = "Akses ke Server Pusat Ditutup SN sudah terdaftar di Server Pusat";$huruf ="#ffca01";$bg=
				"#ffca01";
				}
			elseif($var_status==''&&$sqlstatus>0){
				$warna = "danger"; $server_status = "STANDBY";$txt_server_status = "CBTSync tidak terkoneksi ke server pusat";$huruf ="red";$bg=
				"red";}
			elseif($sqlstatus==0&&$var_status=='') { 
				$warna = "danger"; $server_status = "OFFLINE";$txt_server_status = "ID Server / SN tidak sesuai dengan data server pusat"; $huruf ="red";$bg="red";}
			elseif($sqlstatus>0&&$var_status>0){
				$warna = "info"; $server_status = "AKTIF";$txt_server_status = "CBTSync Aktif, Sinkronisasi Siap Digunakan"; $huruf ="#10d8f3";$bg="#2693ff"; }
			
		?>
		<link href="../assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="../assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
		<link href="../assets/animate.min.css" rel="stylesheet" type="text/css" />
		
		<link href="../assets/loader.main.css" rel="stylesheet" type="text/css" />
		
	

		<div class="row">
		<div class="col-md-12">	
		<div class="portlet-body">
		
									<div class="form-group">
										<h2 style="color:<?php echo $huruf; ?>; font-size:45px">
										<p><b><strong><?php echo "$server_status"; ?></strong></b>
										<span style="color:#999; font-size:14px"><?php //echo $status_internet; ?></span></p></h2>
                                    </div>
                                                
											<div class="alert alert-<?php echo $warna; ?>">
											<?php echo "$txt_server_status"; ?>
											</div>
										<br><br>
									<div class="form-group">
										<h3>ID Server :
                                        <span class="label" for="textfield" style="background-color:<?php echo $bg; ?>; padding-left:40px; padding-right:40px;  padding-top:6px; padding-bottom:6px; font-size:20px ;">
                                        <FONT style="background-color:#32C5D2;height:20px" color="#FFFFFF" ><?php echo "$kodesekolah"; ?></FONT></span></h3>
									</div>
									<div class="form-group">
								    <?php if($server_status == "AKTIF"){ ?>
									 <a href="?modul=sinkron"><button type="button"  class="btn btn-success" aria-hidden="true">Sinkronisasi</button></a>
									<?php } else { ?>
									<button type="button"  class="btn btn-default" aria-hidden="true" disabled="disabled">Sinkronisasi</button>
									<?php } ?>
									</div>
							
							</div>
						</div>						
			</div>			
				
		
		<?php 
		}

}else{

include "../../config/server.php";
$host_name = gethostbyaddr($_SERVER['REMOTE_ADDR']); //untuk mendeteksi computer name

$pc_client = $host_name;
$status_server = 0;
$status_internet = "Jaringan server ke Internet : Terhubung";

// Penambahan SQL Statistik  - 2017/03/09
$jumkelas = mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_kelas"));
$jumsiswa = mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_siswa"));
$jummapel = mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_mapel"));
$jumsoal = mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_paketsoal"));
$jumsek = mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "select * from server_sekolah"));
$jummedia = mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_upload_file"));
?>

	<h1 class="page-title">Beranda Admin
                            <small>Beesmart Education Partner</small>
                        </h1>
	
		
			
			
					
<?php
if($_COOKIE['beelogin']=="admin"){?>
<!-- Starting Statistik -->
					
			
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat blue">
                                <div class="visual">
                                    <i class="fa fa-home"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value=""><?php echo $jumkelas;?></span></div>
									<div class="desc">Kelas </div>
								</div>
                                <a class="more" href="?modul=daftar_kelas"> Lihat Detail
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>

   <!-- Statistik Siswa -->
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat red">
                                <div class="visual">
                                    <i class="fa fa-user"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value=""><?php echo "$jumsiswa";?></span></div>
                                    <div class="desc"> Siswa </div>
                                </div>
                                <a class="more" href="?modul=daftar_siswa"> Lihat Detail
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>
   
   <!-- Statistik Mapel -->
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat green">
                                <div class="visual">
                                    <i class="fa fa-book"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value=""><?php echo "$jummapel";?></span>
                                    </div>
                                    <div class="desc">Mapel </div>
                                </div>
                                <a class="more" href="?modul=daftar_mapel"> Lihat Detail
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>

   <!-- Statistik Soal -->
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat purple">
                                <div class="visual">
                                    <i class="fa fa-tasks"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="89"><?php echo "$jumsoal";?></span> </div>
                                    <div class="desc"> Bank Soal </div>
                                </div>
                                <a class="more" href="?modul=daftar_soal"> Lihat Detail
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>.
	<!-- Statistik Sekolah			
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat yellow">
                                <div class="visual">
                                    <i class="fa fa-home"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="89"><?php echo $jumsek;?></span> </div>
                                    <div class="desc"> Sekolah </div>
                                </div>
                                <a class="more" href="?modul=daftar_soal"> Lihat Detail
                                    <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div> 
   
<!-- End of Statistik 

					   <!-- Statistik Siswa 
					   <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						  <div class="dashboard-stat green">
							 <div class="visual">
								<i class="fa fa-laptop"></i>
							 </div>
								<div class="details">
									<div class="number">
										<span data-counter="counterup" data-value="89"><?php echo "$jummedia";?></div>
									  <div class="desc">File Media</div>
								</div> 
							 <a class="more" href="?modul=upl_filesoal">Upload File</span>
								   <i class="m-icon-swapright m-icon-white"></i>
							 </a>
						  </div>
					   </div>
		-->
			
			
		
<?php }} ?>	
	

	<div class="row">	
		<div class="portlet-body">
			<div class="col-md-6">	
						
					
						<div class="well wow zoomInLeft" style="background: #00d9a3">
						<div class="form-group">
						<h3 style="color:#fdfdff; font-size:30px"><p><b>SERVER LOKAL</b> <span style="color:#999; font-size:14px"><?php //echo $status_internet; ?></span></p>	
						</h3>
						</div>
						
						<div class="alert alert-info" style="background-color:15c0d7" align="left">
						<?php echo "CBTSync Lokal Akif terhubung sebagai Server PUSAT"; ?>
						</div>
					
						<div class="form-group">
						<h3>Server ID : 
						<span class="label" style="background-color:#2693ff; padding-left:10px; padding-right:10px;  padding-top:6px; padding-bottom:6px; font-size:20px ; border-radius:50%">
						<?php
						$sqlklient = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_admin");
						$sek = mysqli_fetch_array($sqlklient);
						$kodesek = $sek['XKodeSekolah'];
						echo "$kodesek "; ?>
						</span>
						</h3>
						</div>
					</div>	
					</div>
					
			
			<div class="col-md-6">
			<div class="note note-info" style="background: #f9f9f9" >
                        <p><font style="color:#008c46" size="4;">Selamat Datang!</font>,&nbsp;<font style="color:#ff4c4d" size="3"><a href="?modul=edit_biodata"><?php echo $nama; ?></a></font> </p>
						</div>
				<div class="form-group">
				<div class="well wow zoomInLeft" data-wow-delay="0.8s" style="background: #f9f9f9">
				Saat ini anda masuk sebagai&nbsp;<font style="color:#ff4c4d" size="2"><a href="?modul=edit_biodata"><?php echo $ucap; ?></a></font> serta anda dapat mengakses atau menggunakan 
				<?php if($_COOKIE['beelogin']=="guru"||['beelogin']=="siswa"){?>
				fitur-fitur berikut:
				<?php } ?>
				<?php if($_COOKIE['beelogin']=="admin"){?>
				seluruh fitur-fitur yang ada.
				
				<?php } ?>
				<ol>
				<?php if($_COOKIE['beelogin']=="guru"){?>
				<li>Pengelolaan siswa
				</li>
				<li>Pengelolaan mata pelajaran
				</li>
				<li>Pengelolaan kelas
				</li>
				<li>Pengelolaan berkas
				</li>
				<li>Pengelolaan bank soal
				</li>
				<li>Pengelolaan ujian & kuis
				</li>
				<li>Download laporan & arsip hasil ujian peserta
				</li>
				<?php } ?>
				
				<?php if($_COOKIE['beelogin']=="siswa"){?>
				<li>Pengubahan data pribadi (akun)
				</li>
				<li>Pengaturan autentikasi pada akun anda
				</li>
				<li>Download laporan & arsip hasil ujian peserta
				</li>
				<?php } ?>
				</ol>
				</div>
			  
			</div>   
			</div>
						
		
			
		
		</div>
	</div>				

				




<script src="../assets/wow.min.js" type="text/javascript"></script>
<!-- BEGIN HEADER & CONTENT DIVIDER -->
       
