<?php
include "../../config/server.php";

if($_COOKIE['beelogin']=="guru"){
			
	$sql = mysqli_query($GLOBALS["___mysqli_ston"], "update cbt_user set 
	Username = '$_REQUEST[txt_user]',
	Nama = '$_REQUEST[txt_nama]',
	NIP = '$_REQUEST[txt_nip]',
	Alamat = '$_REQUEST[txt_alamat]',
	HP = '$_REQUEST[txt_telp]',
	Faxs = '$_REQUEST[txt_facs]',
	Email = '$_REQUEST[txt_email]'
	WHERE Username='$_COOKIE[beeuser]'");

	
}
else{
	$sql = mysqli_query($GLOBALS["___mysqli_ston"], "update cbt_user set 
	Username = '$_REQUEST[txt_user]',
	Nama = '$_REQUEST[txt_nama]',
	NIP = '$_REQUEST[txt_nip]',
	Alamat = '$_REQUEST[txt_alamat]',
	HP = '$_REQUEST[txt_telp]',
	Faxs = '$_REQUEST[txt_facs]',
	Email = '$_REQUEST[txt_email]'
	WHERE Username='$_COOKIE[beeuser]'");
}

echo "Ubah data berhasil !"; 
?>