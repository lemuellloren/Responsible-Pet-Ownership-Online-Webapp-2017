<?php

function exportsql() {

//Our MySQL connection details.
$host = site()->dbhost();
$user = site()->dbusername();
$password = site()->dbpassword();
$database = site()->dbname();
 
//Connect to MySQL using PDO.
$pdo = new PDO("mysql:host=$host;dbname=$database", $user, $password);
 
//Create our SQL query.
// $sql = "SELECT u.id, u.email, u.firstname, u.lastname, u.postcode, u.last_login, p.id, p.name, p.user_id from users u left join pets p on u.id = p.user_id group by u.id order by firstname asc";

$sql = "SELECT * FROM users";

//Prepare our SQL query.
$statement = $pdo->prepare($sql);
 
//Executre our SQL query.
$statement->execute();
 
//Fetch all of the rows from our MySQL table.
$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
 
//Get the column names.
$columnNames = array();
if(!empty($rows)){
    //We only need to loop through the first row of our result
    //in order to collate the column names.
    $firstRow = $rows[0];
    foreach($firstRow as $colName => $val){
        $columnNames[] = $colName;
    }
}
 
//Setup the filename that our CSV will have when it is downloaded.
$fileName = 'mysql-export.csv';
 
//Set the Content-Type and Content-Disposition headers to force the download.
header('Content-Type: application/excel');
header('Content-Disposition: attachment; filename="' . $fileName . '"');
 
//Open up a file pointer
$fp = fopen('php://output', 'w');
 
//Start off by writing the column names to the file.
echo "Users Table \r\n";  
fputcsv($fp, $columnNames);
 
//Then, loop through the rows and write them to the CSV file.
foreach ($rows as $row) {
    fputcsv($fp, $row);
}
//Close the file pointer.
fclose($fp);



$sqlp = "SELECT * FROM pets";

//Prepare our SQL query.
$statementp = $pdo->prepare($sqlp);
 
//Executre our SQL query.
$statementp->execute();
 
//Fetch all of the rows from our MySQL table.
$rowsp = $statementp->fetchAll(PDO::FETCH_ASSOC);
 
//Get the column names.
$columnNamesp = array();
if(!empty($rowsp)){
    //We only need to loop through the first row of our result
    //in order to collate the column names.
    $firstRowp = $rowsp[0];
    foreach($firstRowp as $colNamep => $val){
        $columnNamesp[] = $colNamep;
    }
}
 
//Setup the filename that our CSV will have when it is downloaded.
 
//Open up a file pointer
$fpp = fopen('php://output', 'w');
 
//Start off by writing the column names to the file.
echo "\r\n";
echo "Pets Table \r\n";  
fputcsv($fpp, $columnNamesp);

//Then, loop through the rows and write them to the CSV file.
foreach ($rowsp as $rowp) {
    fputcsv($fpp, $rowp);
}

//Close the file pointer.
fclose($fpp);


$sqlpc = "SELECT * FROM courses";

//Prepare our SQL query.
$statementpc = $pdo->prepare($sqlpc);
 
//Executre our SQL query.
$statementpc->execute();
 
//Fetch all of the rows from our MySQL table.
$rowspc = $statementpc->fetchAll(PDO::FETCH_ASSOC);
 
//Get the column names.
$columnNamespc = array();
if(!empty($rowspc)){
    //We only need to loop through the first row of our result
    //in order to collate the column names.
    $firstRowpc = $rowspc[0];
    foreach($firstRowpc as $colNamepc => $val){
        $columnNamespc[] = $colNamepc;
    }
}
 
//Setup the filename that our CSV will have when it is downloaded.
 
//Open up a file pointer
$fppc = fopen('php://output', 'w');
 
//Start off by writing the column names to the file.
echo "\r\n";
echo "Courses Table \r\n";  
fputcsv($fppc, $columnNamespc);

//Then, loop through the rows and write them to the CSV file.
foreach ($rowspc as $rowpc) {
    fputcsv($fppc, $rowpc);
}

//Close the file pointer.
fclose($fppc);


$sqlpcm = "SELECT * FROM modules";

//Prepare our SQL query.
$statementpcm = $pdo->prepare($sqlpcm);
 
//Executre our SQL query.
$statementpcm->execute();
 
//Fetch all of the rows from our MySQL table.
$rowspcm = $statementpcm->fetchAll(PDO::FETCH_ASSOC);
 
//Get the column names.
$columnNamespcm = array();
if(!empty($rowspcm)){
    //We only need to loop through the first row of our result
    //in order to collate the column names.
    $firstRowpcm = $rowspcm[0];
    foreach($firstRowpcm as $colNamepcm => $val){
        $columnNamespcm[] = $colNamepcm;
    }
}
 
//Setup the filename that our CSV will have when it is downloaded.
 
//Open up a file pointer
$fppcm = fopen('php://output', 'w');
 
//Start off by writing the column names to the file.
echo "\r\n";
echo "Modules Table \r\n";  
fputcsv($fppcm, $columnNamespcm);

//Then, loop through the rows and write them to the CSV file.
foreach ($rowspcm as $rowpcm) {
    fputcsv($fppcm, $rowpcm);
}

//Close the file pointer.
fclose($fppcm);


$sqlpccu = "SELECT * FROM courses_users";

//Prepare our SQL query.
$statementpccu = $pdo->prepare($sqlpccu);
 
//Executre our SQL query.
$statementpccu->execute();
 
//Fetch all of the rows from our MySQL table.
$rowspccu = $statementpccu->fetchAll(PDO::FETCH_ASSOC);
 
//Get the column names.
$columnNamespccu = array();
if(!empty($rowspccu)){
    //We only need to loop through the first row of our result
    //in order to collate the column names.
    $firstRowpccu = $rowspccu[0];
    foreach($firstRowpccu as $colNamepccu => $val){
        $columnNamespccu[] = $colNamepccu;
    }
}
 
//Setup the filename that our CSV will have when it is downloaded.
 
//Open up a file pointer
$fppccu = fopen('php://output', 'w');
 
//Start off by writing the column names to the file.
echo "\r\n";
echo "Courses Users Table \r\n";  
fputcsv($fppccu, $columnNamespccu);

//Then, loop through the rows and write them to the CSV file.
foreach ($rowspccu as $rowpccu) {
    fputcsv($fppccu, $rowpccu);
}

//Close the file pointer.
fclose($fppccu);


$sqlpccucm = "SELECT * FROM courses_modules";

//Prepare our SQL query.
$statementpccucm = $pdo->prepare($sqlpccucm);
 
//Executre our SQL query.
$statementpccucm->execute();
 
//Fetch all of the rows from our MySQL table.
$rowspccucm = $statementpccucm->fetchAll(PDO::FETCH_ASSOC);
 
//Get the column names.
$columnNamespccucm = array();
if(!empty($rowspccucm)){
    //We only need to loop through the first row of our result
    //in order to collate the column names.
    $firstRowpccucm = $rowspccucm[0];
    foreach($firstRowpccucm as $colNamepccucm => $val){
        $columnNamespccucm[] = $colNamepccucm;
    }
}
 
//Setup the filename that our CSV will have when it is downloaded.
 
//Open up a file pointer
$fppccucm = fopen('php://output', 'w');
 
//Start off by writing the column names to the file.
echo "\r\n";
echo "Courses Modules Table \r\n";  
fputcsv($fppccucm, $columnNamespccucm);

//Then, loop through the rows and write them to the CSV file.
foreach ($rowspccucm as $rowpccucm) {
    fputcsv($fppccucm, $rowpccucm);
}

//Close the file pointer.
fclose($fppccucm);


$sqlpccucmucm = "SELECT * FROM users_courses_modules";

//Prepare our SQL query.
$statementpccucmucm = $pdo->prepare($sqlpccucmucm);
 
//Executre our SQL query.
$statementpccucmucm->execute();
 
//Fetch all of the rows from our MySQL table.
$rowspccucmucm = $statementpccucmucm->fetchAll(PDO::FETCH_ASSOC);
 
//Get the column names.
$columnNamespccucmucm = array();
if(!empty($rowspccucmucm)){
    //We only need to loop through the first row of our result
    //in order to collate the column names.
    $firstRowpccucmucm = $rowspccucmucm[0];
    foreach($firstRowpccucmucm as $colNamepccucmucm => $val){
        $columnNamespccucmucm[] = $colNamepccucmucm;
    }
}
 
//Setup the filename that our CSV will have when it is downloaded.
 
//Open up a file pointer
$fppccucmucm = fopen('php://output', 'w');
 
//Start off by writing the column names to the file.
echo "\r\n";
echo "Users Courses Modules Table \r\n";  
fputcsv($fppccucmucm, $columnNamespccucmucm);

//Then, loop through the rows and write them to the CSV file.
foreach ($rowspccucmucm as $rowpccucmucm) {
    fputcsv($fppccucmucm, $rowpccucmucm);
}

//Close the file pointer.
fclose($fppccucmucm);


$sqlpt = "SELECT * FROM pets_courses";

//Prepare our SQL query.
$statementpt = $pdo->prepare($sqlpt);
 
//Executre our SQL query.
$statementpt->execute();
 
//Fetch all of the rows from our MySQL table.
$rowspt = $statementpt->fetchAll(PDO::FETCH_ASSOC);
 
//Get the column names.
$columnNamespt = array();
if(!empty($rowspt)){
    //We only need to loop through the first row of our result
    //in order to collate the column names.
    $firstRowpt = $rowspt[0];
    foreach($firstRowpt as $colNamept => $val){
        $columnNamespt[] = $colNamept;
    }
}
 
//Setup the filename that our CSV will have when it is downloaded.
 
//Open up a file pointer
$fppt = fopen('php://output', 'w');
 
//Start off by writing the column names to the file.
echo "\r\n";
echo "Pets Courses Table \r\n";  
fputcsv($fppt, $columnNamespt);

//Then, loop through the rows and write them to the CSV file.
foreach ($rowspt as $rowpt) {
    fputcsv($fppt, $rowpt);
}

//Close the file pointer.
fclose($fppt);

exit();
}

function exportcsv() {

    function EXPORT_TABLES($host,$user,$pass,$name,       $tables=false, $backup_name=false){ 
    set_time_limit(3000); $mysqli = new mysqli($host,$user,$pass,$name); $mysqli->select_db($name); $mysqli->query("SET NAMES 'utf8'");
    $queryTables = $mysqli->query('SHOW TABLES'); while($row = $queryTables->fetch_row()) { $target_tables[] = $row[0]; }    if($tables !== false) { $target_tables = array_intersect( $target_tables, $tables); } 
    $content = "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\r\nSET time_zone = \"+00:00\";\r\n\r\n\r\n/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;\r\n/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;\r\n/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;\r\n/*!40101 SET NAMES utf8 */;\r\n--\r\n-- Database: `".$name."`\r\n--\r\n\r\n\r\n";
    foreach($target_tables as $table){
        if (empty($table)){ continue; } 
        $result    = $mysqli->query('SELECT * FROM `'.$table.'`');      $fields_amount=$result->field_count;  $rows_num=$mysqli->affected_rows;     $res = $mysqli->query('SHOW CREATE TABLE '.$table);    $TableMLine=$res->fetch_row(); 
        $content .= "\n\n".$TableMLine[1].";\n\n";   $TableMLine[1]=str_ireplace('CREATE TABLE `','CREATE TABLE IF NOT EXISTS `',$TableMLine[1]);
        for ($i = 0, $st_counter = 0; $i < $fields_amount;   $i++, $st_counter=0) {
            while($row = $result->fetch_row())    { //when started (and every after 100 command cycle):
                if ($st_counter%100 == 0 || $st_counter == 0 )    {$content .= "\nINSERT INTO ".$table." VALUES";}
                    $content .= "\n(";    for($j=0; $j<$fields_amount; $j++){ $row[$j] = str_replace("\n","\\n", addslashes($row[$j]) ); if (isset($row[$j])){$content .= '"'.$row[$j].'"' ;}  else{$content .= '""';}       if ($j<($fields_amount-1)){$content.= ',';}   }        $content .=")";
                //every after 100 command cycle [or at last line] ....p.s. but should be inserted 1 cycle eariler
                if ( (($st_counter+1)%100==0 && $st_counter!=0) || $st_counter+1==$rows_num) {$content .= ";";} else {$content .= ",";}    $st_counter=$st_counter+1;
            }
        } $content .="\n\n\n";
    }
    $content .= "\r\n\r\n/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;\r\n/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;\r\n/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;";
    $backup_name = $backup_name ? $backup_name : $name.'___('.date('H-i-s').'_'.date('d-m-Y').').sql';
    ob_get_clean(); header('Content-Type: application/octet-stream');  header("Content-Transfer-Encoding: Binary");  header('Content-Length: '. (function_exists('mb_strlen') ? mb_strlen($content, '8bit'): strlen($content)) );    header("Content-disposition: attachment; filename=\"".$backup_name."\""); 
    echo $content; exit;
}      //see import.php too

    EXPORT_TABLES(site()->dbhost(),site()->dbusername(),site()->dbpassword(),site()->dbname());
}
?>