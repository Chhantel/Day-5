<?php  

// $db_host = "localhost";
// $uname = "root";
// $password = "";

// $db_name = "my_db";
// try{
// 	$db = new PDO("mysql:host={$db_host};dbname={$db_name}", $uname, $password);
// 	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// }
// catch(PDOEXCEPTION $e){
// 	$e->getMessage();
// }



$db_host = "localhost";
$port="5432";
$uname = "postgres";
$password = "bal@123";

$db_name = "my_db";

$postgis_db = "postgis_31_sample";
try{
    $db = new PDO("pgsql:host={$db_host};port={$port};dbname={$db_name}", $uname, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $postgis_db = new PDO("pgsql:host={$db_host};port={$port};dbname={$postgis_db}", $uname, $password);
    $postgis_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOEXCEPTION $e){
    $e->getMessage();
}