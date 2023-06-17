<?php
// 包含資料庫連接檔案
require_once 'db_connect.php';

// 創建使用者資料
$username = $_POST['username'];
$password = $_POST['password'];

// 建立 SQL 查詢語句
$sql = "SELECT * FROM users WHERE username = ? AND password = ?";
$params = array($username, $password);

// 執行查詢
$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
  die(print_r(sqlsrv_errors(), true));
}

// 檢查是否有匹配的記錄
if (sqlsrv_has_rows($stmt)) {
  echo "登入成功！";

  $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

  // 設定 cookies
  setcookie('userID', $row['userID'], time() + 72000, '/');

  header('Location: ../home.php');
} else {
  echo "帳號或密碼錯誤！";
}

// 釋放資源
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);