<?php
include "../../config/server.php";
$passlama = md5($_POST['passlama']);
$passbaru = md5($_POST['passbaru']);
$pass = $_POST['passbaru']; //peringatan password berhasil diubah
$konfirmasi = md5($_POST['konfirmasi']);
$username = $_POST['username'];
$cekuser = "select * from cbt_user where Username = '$username' and Password = '$passlama' and '$konfirmasi' = '$passbaru'";
$querycekuser = mysqli_query($GLOBALS["___mysqli_ston"], $cekuser);
$count = mysqli_num_rows($querycekuser);
if ($count > 0){
$updatepassword = "update cbt_user set Password = '$passbaru' where Username = '$username'";
$updatequery = mysqli_query($GLOBALS["___mysqli_ston"], $updatepassword);
if($updatequery)
{
echo "Password telah diganti menjadi <b>$pass</b>";
}}else{echo "Variable tidak Sama Perubahan <b>Tidak Berhasil</b>";}


?>