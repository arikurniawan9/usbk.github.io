<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
?>

          
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-bubble font-dark hide"></i>
                                        <h2><span class="caption-subject font-hide uppercase">Dashboard</span></h2>
                                    </div>
                                    
                                </div>
            <!-- /.row -->
<?php
include "../../config/server.php";
if($mode=="pusat"){
$sqlklien = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_user");
$sk = mysqli_fetch_array($sqlklien);
$kodesekolah = $sk['Username'];
//echo $kodesekolah;

		include "../../config/ipserver.php";
			  if(isset($_SERVER['SERVER_NAME'])){
			  $serverIP = $_SERVER['SERVER_NAME'];
			  $alamat2 = $_SERVER['SERVER_PORT'];
			  }

		$domain =$ipserver;
		
		if ($domain=="" or $db_userm=="" or $db_pasw=="" or $db_nama==""){
			echo"<h3><b><font color='#FF0000'>Silahkan Setting koneksi ke server pusat di menu \"Setting Server Pusat\"</b></h3> ";
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
				$warna = "info"; $server_status = "STANDBY";$txt_server_status = "Akses ke Server Pusat Ditutup SN sudah terdaftar di Server Pusat";$huruf ="#789BCC";$bg=
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
		<div style="width:55%">   
					<div class="row" style="width:75%">
						<div class="col-lg-6">
								<h4 style="color:<?php echo $huruf; ?>; font-size:35px"><p><b><?php echo $server_status; ?></b> <span style="color:#999; font-size:14px"><?php //echo $status_internet; ?></span></p></h4>
						</div>
					</div>
							<div class="alert alert-<?php echo $warna; ?>" style="background-color:15c0d7">
							<?php echo $txt_server_status; ?>
							</div>
		 <div class="well" style="">
								<h4>Server ID : 
								<span class="label" style="background-color:<?php echo $bg; ?>; padding-left:40px; padding-right:40px;  padding-top:6px; padding-bottom:6px; 
                                font-size:24px">
								<?php echo "$kodesekolah"; ?>
								</span></h4>
							</div>
		
		</div>
		<?php 
		}else { 
		$warna = "danger"; $server_status = "OFFLINE";$txt_server_status = "CBTSync Tidak Terhubung dengan Internet"; $huruf ="red";$bg="red";
		?>
		<div style="width:55%">   
					<div class="row" style="width:75%">
						<div class="col-lg-6">
								<h4 style="color:<?php echo $huruf; ?>; font-size:35px"><p><b><?php echo $server_status; ?></b> <span style="color:#999; font-size:14px"><?php //echo $status_internet; ?></span></p></h4>
						</div>
					</div>
							<div class="alert alert-<?php echo $warna; ?>" style="background-color:15c0d7">
							<?php echo $txt_server_status; ?>
							</div>
		 <div class="well" style="">
								<h4>Server ID : 
								<span class="label" style="background-color:<?php echo $bg; ?>; padding-left:40px; padding-right:40px;  padding-top:6px; padding-bottom:6px; 
                                font-size:24px">
								<?php echo "$kodesekolah"; ?>
								</span></h4>
							</div>
							
		
		</div>
		<?php
		}}

}else{

include "../../config/server.php";
$host_name = gethostbyaddr($_SERVER['REMOTE_ADDR']); //untuk mendeteksi computer name
?>
<?php
$pc_client = $host_name;
$status_server = 0;
$status_internet = "Jaringan server ke Internet : Terhubung";

// Penambahan SQL Statistik  - 2017/03/09
$jumkelas = mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_kelas"));
$jumsiswa = mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_siswa"));
$jummapel = mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_mapel"));
$jumsoal = mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_paketsoal"));
$jumsek = mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "select * from server_sekolah"));

?>
<div style="width:55%">           
	<div class="row">
		<div class="col-lg-9">
			<h4 style="color:#10d8f3; font-size:35px"><p><b>SERVER</b> <span style="color:#15c0d7; font-size:14px"><?php //echo $status_internet; ?></span></p>	
        	</h4>
    	</div>
	</div>
	<div class="alert alert-info" style="background-color:#d9edf7">
		<p style="color:#31708f;"><?php echo "CBTSync Terhubung ke Server Lokal"; ?></p>
	</div>
 	<div class="well" style="">
		<h4>Server ID : 
		<span class="label label-success" style="padding-left:40px; padding-right:40px;  padding-top:6px; padding-bottom:6px; font-size:20px">
			<b><?php echo "$pc_client "; ?></b>
        </span>
        </h4>
 	</div>
</div>
<?php
if($_COOKIE['beelogin']=="admin"){?>
<!-- Starting Statistik -->

<?php
}
?>
<?php
}
?>
</div>

