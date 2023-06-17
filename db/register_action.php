<?php
// 包含資料庫連接檔案
require_once 'db_connect.php';

// 創建使用者資料
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// 檢查帳號是否已存在
$sql = "SELECT * FROM users WHERE username = ?";
$params = array($username);
$stmt = sqlsrv_query($conn, $sql, $params);
if ($stmt === false) {
  die(print_r(sqlsrv_errors(), true));
}
if (sqlsrv_has_rows($stmt)) {
  // 帳號已存在，顯示錯誤訊息或進行其他相關處理
  echo "該帳號已被使用，請選擇其他帳號";
  exit(); // 終止腳本執行
}

$sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
$params = array($username, $email, $password);
$stmt = sqlsrv_query($conn, $sql, $params);

header('Location: ../login.php');

if ($stmt === false) {
  die(print_r(sqlsrv_errors(), true));
}
