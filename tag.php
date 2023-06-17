<?php
// 包含資料庫連接檔案
require_once './db/db_connect.php';

// 貼文資訊
$selectPostJoinUserWithTags = "SELECT Users.username, Posts.postID, Posts.title, Posts.createdAt
FROM Posts
JOIN Users ON Users.userID = Posts.userID
WHERE Posts.postID IN (
	SELECT Tags.postID FROM Tags WHERE Tags.name = ?
);";

// 貼文數量
$selectNumOfPosts = "SELECT COUNT(Posts.postID) AS '貼文數量'
FROM Posts
WHERE Posts.postID IN (
	SELECT Tags.postID FROM Tags WHERE Tags.name = ?
);";

// 標籤
$selectTagsName = "SELECT DISTINCT Tags.name FROM Tags;";

if (isset($_GET['tag'])) {
  $params = array($_GET['tag']);
} else {
  header('Location: taglist.php');
}

$postsQuery = sqlsrv_query($conn, $selectPostJoinUserWithTags, $params);

$numOfPostsQuery = sqlsrv_query($conn, $selectNumOfPosts, $params);
$numOfPosts = sqlsrv_fetch_array($numOfPostsQuery, SQLSRV_FETCH_ASSOC);

$tagsQuery = sqlsrv_query($conn, $selectTagsName);
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

    <main class="w-3/5 flex flex-col gap-y-6 justify-items-center">

      <?php
      while ($row = sqlsrv_fetch_array($postsQuery, SQLSRV_FETCH_ASSOC)) {
        $createdAt = $row["createdAt"]->format("Y-m-d");

        // blogs
        echo '
              <div class="py-4 px-16 flex flex-row shadow rounded-lg transition-transform duration-500 ease-in-out transform hover:-translate-y-1 select-none">
                  <!-- user section -->
                  <div class="w-1/6 pr-12">
                      <img class="avatar rounded-full outline outline-2 outline-orange-200" src="./assets/pig.jpg" alt="avatar" />
                      <h1 class="text-lg font-bold text-slate-500">' . $row["username"] . '</h1>
                  </div>
                  <!-- blog content -->
                    <a href="post.php?postID=' . $row["postID"] . '" class="py-1.5 flex flex-col justify-items-start justify-between">
                        <h1 class="text-3xl font-bold">' . $row["title"] . '</h1>
                        <h5 class="text-sm font-extrabold text-slate-400">' . $createdAt . '</h5>
                    </a>
              </div>
            ';
      }
      ?>

    </main>

    <side class="w-2/5 px-16 flex flex-col gap-y-8 items-center">

      <!-- counter -->
      <div class="w-1/2 border border-gray-200 rounded-lg shadow">

        <!-- counter title -->
        <ul class="text-sm font-medium text-center text-gray-500 divide-x divide-gray-200 rounded-lg sm:flex"
          id="fullWidthTab" data-tabs-toggle="#fullWidthTabContent" role="tablist">
          <li class="w-full">
            <button id="stats-tab" data-tabs-target="#stats" type="button" role="tab" aria-controls="stats"
              aria-selected="true"
              class="text-lg font-bold text-zinc-700 inline-block w-full p-4 rounded-tl-lg bg-orange-200 hover:bg-orange-100 focus:outline-none">總計</button>
          </li>
        </ul>

        <div class="border-t border-gray-200">
          <div class="p-4 bg-white rounded-lg md:p-8" id="stats" role="tabpanel">
            <dl class="flex flex-col max-w-screen-xl gap-8 p-4 mx-auto text-gray-900">
              <div class="flex flex-col items-center justify-center">
                <dt class="mb-2 text-3xl font-extrabold"><?php echo $numOfPosts['貼文數量'] ?></dt>
                <dd class="text-gray-500">Posts</dd>
              </div>
            </dl>
          </div>
        </div>
      </div>

      <!-- tag section -->
      <div class="w-1/2 border border-gray-200 rounded-lg shadow">

        <!-- counter title -->
        <ul class="text-sm font-medium text-center text-gray-500 divide-x divide-gray-200 rounded-lg sm:flex"
          id="fullWidthTab" data-tabs-toggle="#fullWidthTabContent" role="tablist">
          <li class="w-full">
            <button id="stats-tab" data-tabs-target="#stats" type="button" role="tab" aria-controls="stats"
              aria-selected="true"
              class="text-lg font-bold text-zinc-700 inline-block w-full p-4 rounded-tl-lg bg-orange-200 hover:bg-orange-100 focus:outline-none">標籤</button>
          </li>
        </ul>

        <div class="border-t border-gray-200">
          <div class="bg-white rounded-lg" id="stats" role="tabpanel">
            <dl class="flex flex-row flex-wrap max-w-screen-xl gap-8 p-4 mx-auto">
              <div class="flex flex-col items-center justify-center">

                <!-- Tags -->
                <div class="p-4">
                  <div class="flex flex-wrap gap-4">

                    <?php
                    while ($tags = sqlsrv_fetch_array($tagsQuery, SQLSRV_FETCH_ASSOC)) {
                      if ($tags['name'] == $_GET['tag']) {
                        echo '<span class="cursor-pointer select-none inline-flex items-center px-3 py-2 text-lg font-bold leading-none text-gray-600 bg-orange-200 rounded-lg hover:outline hover:outline-orange-300">
                            ' . $tags['name'] . '
                        </span>';
                        continue;
                      };
                      echo '<span class="cursor-pointer select-none inline-flex items-center px-3 py-2 text-lg font-bold leading-none text-gray-800 bg-gray-100 rounded-lg hover:outline hover:outline-orange-300">
                        <a href="tag.php?tag=' . $tags['name'] . '">
                          ' . $tags['name'] . ' 
                        </a>
                      </span>';
                    }
                    ?>

                  </div>
                </div>

              </div>
            </dl>
          </div>
        </div>
      </div>




    </side>
  </div>

</body>

</html>