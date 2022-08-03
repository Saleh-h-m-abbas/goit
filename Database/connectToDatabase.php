<?php
//open session to work with auth
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//Database variables name
$servername_karam = "localhost";
$username_karam_database = "root";
$password_karam_database = "root";
$dbname_karam_database = "goit_network";
//Database create connection
$conn = new mysqli($servername_karam, $username_karam_database, $password_karam_database, $dbname_karam_database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//set the utf8 for arabic language
mysqli_set_charset($conn,'utf8');
//this for many group by query
$SQLSettingQ = "SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))";
$SQLSettingQResult = $conn->query($SQLSettingQ);
