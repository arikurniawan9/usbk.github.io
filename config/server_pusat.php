<?php
include "ipserver.php";
$link = @($GLOBALS["___mysqli_ston"] = mysqli_connect($ipserver,  $db_userm,  $db_pasw));
mysqli_select_db( $link, $db_nama) or die('Koneksi-2 CBTSync belum di setting');

date_default_timezone_set("$zo");