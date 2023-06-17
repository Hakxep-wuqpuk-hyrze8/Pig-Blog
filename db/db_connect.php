<?php
header("Content-Type:text/html; charset=utf-8");
$serverName = "LAPTOP-ETHD0JGH\SQLEXPRESS";
$connectionInfo = array("Database" => "Pigblog", "UID" => "sa", "PWD" => "asd112233", "CharacterSet" => "UTF-8");
$conn = sqlsrv_connect($serverName, $connectionInfo);
if ($conn) {
  // echo "Success!!!<br />";
} else {
  echo "Error!!!<br />";
  die(print_r(sqlsrv_errors(), true));
}