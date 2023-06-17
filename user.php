<?php
// 包含資料庫連接檔案
require_once './db/db_connect.php';

$name = "name";

// 從 cookie 中取得使用者ID
if (isset($_COOKIE['userID'])) {
  $userID = $_COOKIE['userID'];
  $sql = "SELECT * FROM Users WHERE userID = ?";
  $params = array($userID);

  $user = sqlsrv_query($conn, $sql, $params);

  $row = sqlsrv_fetch_array($user, SQLSRV_FETCH_ASSOC);
  $name = $row['username'];
} else {
  // header("Location: login.php"); // 重新導向到登入頁面
  $value = 'login';
  $url = 'error.php?type=' . urlencode($value);
  header('Location: ' . $url);

  exit(); // 結束腳本執行
}

if (isset($_POST['logout'])) {
  // 刪除使用者的 Cookies
  setcookie('userID', '', time() - 72000, '/');

  // 重定向到登出後的頁面或首頁
  header('Location: home.php'); // 假設 logout.php 是登出後的頁面
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link href="style.css" rel="stylesheet" type="text/css" />
  <link rel="icon" href="./assets/logo.png" type="image/x-icon">
  <title>Pig's Blogs</title>
</head>

<body>
  <?php include './components/navbar.php'; ?>

  <!-- background -->
  <div class="bg-[url('./assets/cesar-couto-TIvFLeqZ4ec-unsplash.jpg')]  bg-no-repeat bg-cover bg-center h-64 w-full relative bottom-3">
  </div>

  <div class="flex justify-center flex-row w-full">
    <!-- user profile -->
    <?php include './components/usersidebar.php'; ?>

    <!-- user posts -->
    <div class="flex flex-col w-2/3"></div>
  </div>

</body>

</html>