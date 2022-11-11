<?php ob_start();
 include "../../config/server.php";
 mysqli_query($GLOBALS["___mysqli_ston"], "delete from cbt_ujian where Urut='$_GET[urut]'");
 header('location:index.php');
?>