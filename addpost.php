<?php
// 包含資料庫連接檔案
require_once './db/db_connect.php';

// PO貼文
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = $_POST['title'];
  $content = $_POST['content'];

  $updatePost = "INSERT INTO Posts (content, title, userID) VALUES (?, ?, ?);";
  $params = array($content, $title, $_COOKIE['userID']);
  sqlsrv_query($conn, $updatePost, $params);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="style.css" rel="stylesheet" type="text/css" />
  <link rel="icon" href="./assets/logo.png" type="image/x-icon">
  <title>Pig's Blogs</title>
</head>

<body>
  <?php include './components/navbar.php'; ?>

  <!-- container -->
  <div class="w-full flex flex-row p-16">
    <form class="w-1/2 mx-auto select-none" method="post" action="addpost.php">
      <div class="mb-8">
        <label for="base-input" class="select-none text-3xl font-bold text-gray-900">標題</label>
        <input type="text" name="title" id="base-input" class="mt-4 bg-gray-50 border border-gray-300 select-none text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500  w-full p-2.5  ">
      </div>
      <div class="mb-8 w-full">
        <label for="message" class="select-none text-3xl font-bold text-gray-900">內容</label>
        <textarea id="message" name="content" rows="4" class="mt-4 p-2.5 w-full text-sm text-gray-900 bg-gray-50 select-none rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Write your content here..."></textarea>
      </div>

      <button type="submit" class="w-2/12 text-white bg-orange-300 hover:bg-orange-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">新增</button>
    </form>
  </div>
</body>

</html>