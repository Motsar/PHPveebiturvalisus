<?php
//Server,Kasutaja,parool ja andmebaas
$db_server = '';
$db_database = '';
$db_user = '';
$db_password = '';

//yhenduse loomine
$yhendus = mysqli_connect($db_server,$db_user,$db_password,$db_database);
//yhenduse kontroll
if(!$yhendus) {
    die('Ei saa ühendust andmebaasiga');
}

$db_connection = new PDO('mysql:host=localhost;dbname=np12313_praktika_2020_1', '', '');

?>