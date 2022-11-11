<?php
include "../../config/server.php";
$id=$_POST['txt_mapel'];
$sql = "delete from cbt_user where Urut='$id'";
mysqli_query($GLOBALS["___mysqli_ston"],  $sql);
?>