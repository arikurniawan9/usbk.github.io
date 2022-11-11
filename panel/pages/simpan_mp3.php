<?php
include "config/server.php";
//if($_REQUEST['anu']==0){
$sql = mysqli_query($GLOBALS["___mysqli_ston"], "update cbt_audio set XMulai = '34', XPutar = '2'");
//} else {
//$sql = mysql_query("update cbt_audio set XMulai = '$_REQUEST[anu]'");
//}
?>
