<?php 
include "../../config/server.php";	
?>
<?php
$sqlselesai = mysqli_query($GLOBALS["___mysqli_ston"], "update cbt_ujian set XStatusUjian = '9' where Urut = '$_REQUEST[txt_ujian]'");
?>

