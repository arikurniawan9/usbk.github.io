<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
?>
<?php
// Connect to mysql
include "../../config/server.php";

// Name of the file
$filename = '../../config/ubkmadiplokal.sql';
$mysql_database = 'ubkmadiplokal';

// Connect to mysql server
//mysql_connect($mysql_host, $mysql_username, $mysql_password) or die('Error connecting to mysql server: ' . mysql_error());
// Select database
mysqli_select_db($GLOBALS["___mysqli_ston"], $mysql_database) or die('Error selecting mysql database: ' . mysqli_error($GLOBALS["___mysqli_ston"]));

// Temporary variable, used to store current query
$templine = '';
// Read in entire file
$lines = file($filename);
// Loop through each line
foreach ($lines as $line)
{
// Skip it if it's a comment
if (substr($line, 0, 2) == '--' || $line == '')
    continue;

// Add this line to the current segment
$templine .= $line;
// If it has a semicolon at the end, it's the end of the query
if (substr(trim($line), -1, 1) == ';')
{
    // Perform the query
    mysqli_query($GLOBALS["___mysqli_ston"], $templine);// or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
    // Reset temp variable to empty
    $templine = '';
}
}
header('location:../pages/login.php');
 //echo "Tables imported successfully";
?>