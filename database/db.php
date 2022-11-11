<?php
function &backup_tables($host, $user, $pass, $name, $tables = '*'){
  $data = "\n/*---------------------------------------------------------------".
          "\n  SQL DB BACKUP ".date("d.m.Y H:i")." ".
          "\n  HOST: {$host}".
          "\n  DATABASE: {$name}".
          "\n  TABLES: {$tables}".
          "\n  ---------------------------------------------------------------*/\n";
  $link = @($GLOBALS["___mysqli_ston"] = mysqli_connect($host, $user, $pass));
  mysqli_select_db($link, $name);
  mysqli_query( $link ,  "SET NAMES `utf8` COLLATE `utf8_general_ci`" ); // Unicode

  if($tables == '*'){ //get all of the tables
    $tables = array();
    $result = mysqli_query($GLOBALS["___mysqli_ston"], "SHOW TABLES");
    while($row = mysqli_fetch_row($result)){
      $tables[] = $row[0];
    }
  }else{
    $tables = is_array($tables) ? $tables : explode(',',$tables);
  }

  foreach($tables as $table){
    $data.= "\n/*---------------------------------------------------------------".
            "\n  TABLE: `{$table}`".
            "\n  ---------------------------------------------------------------*/\n";           
    $data.= "DROP TABLE IF EXISTS `{$table}`;\n";
    $res = mysqli_query( $link, "SHOW CREATE TABLE `{$table}`");
    $row = mysqli_fetch_row($res);
    $data.= $row[1].";\n";

    $result = mysqli_query( $link, "SELECT * FROM `{$table}`");
    $num_rows = mysqli_num_rows($result);    

    if($num_rows>0){
      $vals = Array(); $z=0;
      for($i=0; $i<$num_rows; $i++){
        $items = mysqli_fetch_row($result);
        $vals[$z]="(";
        for($j=0; $j<count($items); $j++){
          if (isset($items[$j])) { $vals[$z].= "'".mysqli_real_escape_string( $link ,  $items[$j])."'"; } else { $vals[$z].= "NULL"; }
          if ($j<(count($items)-1)){ $vals[$z].= ","; }
        }
        $vals[$z].= ")"; $z++;
      }
      $data.= "INSERT INTO `{$table}` VALUES ";      
      $data .= "  ".implode(";\nINSERT INTO `{$table}` VALUES ", $vals).";\n";
    }
  }
  ((is_null($___mysqli_res = mysqli_close( $link ))) ? false : $___mysqli_res);
  return $data;
}

// create backup
//////////////////////////////////////
$backup_file = 'bee-backup-'.time().'.sql';

// get backup
$mybackup = backup_tables("localhost:3306","root","",$db_server,"*");

// save to file
$handle = fopen($backup_file,'w+');
fwrite($handle,$mybackup);
fclose($handle);
