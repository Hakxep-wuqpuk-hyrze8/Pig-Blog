<?php
// 包含資料庫連接檔案
require_once './db/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  $updateUser = "UPDATE Users SET username = ?, email = ?, password = ? WHERE userID = ?;";
  $params = array($username, $email, $password, $_COOKIE['userID']);
  sqlsrv_query($conn, $updateUser, $params);
}

$name = "name";
$email = "email";
$password = "password";

// 從 cookie 中取得使用者ID
if (isset($_COOKIE['userID'])) {
  $userID = $_COOKIE['userID'];
  $sql = "SELECT * FROM Users WHERE userID = ?";
  $params = array($userID);

  $user = sqlsrv_query($conn, $sql, $params);

  $row = sqlsrv_fetch_array($user, SQLSRV_FETCH_ASSOC);
  $name = $row['username'];
  $email = $row['email'];
  $password = $row["password"];
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


    <!-- user function -->
    <main class="flex flex-col w-2/3 mb-6">
      <h1 class="font-bold text-4xl my-6">使用者資料</h1>
      <form method="POST" action="editUser.php" class="w-1/2 flex flex-col gap-4">
        <div class="mb-6">
          <label for="username" class="font-bold block mb-1 text-lg  text-gray-500 ">名稱</label>
          <input type="text" id="username" name="username" class="outline-0 outline-orange-200 waveOutline p-2.5 text-sm font-bold border-width border-orange-300 border-b-2 w-1/2 transition-width duration-500 hover:w-full" value="<?php echo $name; ?>" placeholder="onandon" required>
        </div>

        <div class="mb-6">
          <label for="email" class="font-bold block mb-1 text-lg  text-gray-500 ">電子郵件</label>
          <input type="email" id="email" name="email" class="outline-0 outline-orange-200 waveOutline p-2.5 text-sm font-bold border-width border-orange-300 border-b-2 w-1/2 transition-width duration-500 hover:w-full" placeholder="john.doe@company.com" value="<?php echo $email; ?>" required>
        </div>
        <div class="mb-6">
          <label for="password" class="font-bold block mb-1 text-lg  text-gray-500 ">密碼</label>
          <input type="text" id="password" name="password" class="outline-0 outline-orange-200 waveOutline p-2.5 text-sm font-bold border-width border-orange-300 border-b-2 w-1/2 transition-width duration-500 hover:w-full" placeholder="•••••••••" value="<?php echo $password; ?>" required>
        </div>


        <button type="submit" class="w-2/12 text-white bg-orange-300 hover:bg-orange-200 font-medium rounded-lg text-sm /px-5 py-2.5 mr-2 mb-2">修改</button>
      </form>
    </main>




  </div>

</body>

</html>