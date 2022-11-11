<?php include "../../config/server.php";

//$sql = mysql_query("insert into tes (nilai) values ('$_REQUEST[token]')");
$array =  explode(',', $_REQUEST['nama']);

foreach ($array as $item) {
	$sql0 = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_siswa_ujian where Urut = '$item' and XTokenUjian = '$_REQUEST[token]'");
	$s = mysqli_fetch_array($sql0);
	$status = $s['XStatusUjian'];
	$nomer = $s['XNomerUjian'];
	$sql = mysqli_query($GLOBALS["___mysqli_ston"], "update cbt_siswa_ujian set XGetIP = '' where  Urut = '$item' and XTokenUjian = '$_REQUEST[token]' and XNomerUjian = '$nomer'");

}