<?php
include "../../config/server.php";
$sql1 = "delete from cbt_soal where XKodeSoal = '$_REQUEST[txt_mapel]'";
mysqli_query($GLOBALS["___mysqli_ston"],  $sql1);
