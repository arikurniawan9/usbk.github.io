<?php
include "../../config/server.php";
$id=$_POST['txt_soal'];
$sql = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_soal where XKodeSoal='$id'");
$s = mysqli_fetch_array($sql);
$soal = str_replace(" ","",$s['XKodeSoal']);

$sql1 = "delete from cbt_soal where XKodeSoal = '$soal'";
mysqli_query($GLOBALS["___mysqli_ston"],  $sql1);

$sql2 = "delete from cbt_paketsoal where XKodeSoal='$id'";
mysqli_query($GLOBALS["___mysqli_ston"],  $sql2);

$sql3 = "delete from cbt_ujian where XKodeSoal='$id'";
mysqli_query($GLOBALS["___mysqli_ston"],  $sql3);

$sql4 = "delete from cbt_jawaban where XKodeSoal='$id'";
mysqli_query($GLOBALS["___mysqli_ston"],  $sql4);

$sql5 = "delete from cbt_siswa_ujian where XKodeSoal='$id'";
mysqli_query($GLOBALS["___mysqli_ston"],  $sql5);

$sql6 = "delete from cbt_nilai where XKodeSoal='$id'";
mysqli_query($GLOBALS["___mysqli_ston"],  $sql6);

?>