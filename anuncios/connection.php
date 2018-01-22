<?php
/*
// mysql_connect("database-host", "username", "password")
$conn = mysqli_connect("localhost","root","rf1299adv2017") 
            or die("cannot connected");
 
// mysql_select_db("database-name", "connection-link-identifier")
@mysql_select_db("test2",$conn);
*/
 
/**
 * mysql_connect is deprecated
 * using mysqli_connect instead
 */
 
$databaseHost = 'localhost';
$databaseName = 'asteriskrealtime';
$databaseUsername = 'root';
$databasePassword = 'rf1299adv2017';
 
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName); 
?>