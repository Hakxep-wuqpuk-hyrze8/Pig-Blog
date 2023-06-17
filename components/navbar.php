<?php
session_start();

$userIsLogin = False;

if (isset($_COOKIE['userID'])) {
  // 使用者已經登入
  // echo "使用者已登入：" . $_COOKIE['userID'];
  $userIsLogin = True;
} else {
  // 使用者尚未登入
  // echo "使用者尚未登入";
}

session_destroy();
?>

<div class='navbar'>
  <div class="navbar__left">
    <a href="home.php">
      <img class="logo" src="./assets/logo.png" alt="logo">
    </a>
    <div class='navlink'>
      <a href='home.php'>首頁</a>
      <a href='addpost.php'>POST</a>
      <a href='tag.php'>標籤</a>
      <a href='collect.php'>收藏</a>
    </div>
  </div>
  <div class="navbar__right">
    <?php
    if ($userIsLogin) {
      // 要從資料庫拿取照片
      echo "<a href='user.php'>
        <img class='avatar rounded-full outline outline-2 outline-orange-300' src='./assets/pig.jpg' alt='user' />
      </a>";
    } else {
      echo "<div class='navlink'><a href='login.php'>登入</a></div>";
      echo "<button class='relative inline-flex items-center justify-center p-0.5 mr-2 overflow-hidden text-lg font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-red-200 via-red-300 to-yellow-200 group-hover:from-red-200 group-hover:via-red-300 group-hover:to-yellow-200 dark:text-gray-900 dark:hover:text-white focus:ring-4 focus:outline-none focus:ring-red-100 dark:focus:ring-red-400'>
      <span class='w-full relative px-4 py-2 transition-all ease-in duration-75 bg-white dark:white rounded-md group-hover:bg-opacity-0'>
        <a href='register.php'>
          註冊
        </a>
      </span>
      </button>";
    }
    ?>
  </div>
</div>

<div class="underline"></div>