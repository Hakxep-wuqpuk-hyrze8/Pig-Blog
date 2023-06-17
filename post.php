<?php
// 包含資料庫連接檔案
require_once './db/db_connect.php';

$postID = $_GET['postID'];
$userID = $_COOKIE['userID'];
$postID = $_GET['postID'];
$star = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['comment'])) {
    $comment = $_POST['comment'];
    $postComment = "INSERT INTO Comments (postID, userID, content) VALUES (?, ?, ?);";
    $params = array($postID, $userID, $comment);
    sqlsrv_query($conn, $postComment, $params);
  } else {
    $selectCollections = "SELECT postID FROM Collections WHERE userID = ? AND postID = ?;";
    $params = array($userID, $postID);
    $collectionsQuery = sqlsrv_query($conn, $selectCollections, $params);
    $collections = sqlsrv_fetch_array($collectionsQuery);

    if ($collections) {
      $deleteCollections = "DELETE Collections WHERE userID = ? AND postID = ?;";
      sqlsrv_query($conn, $deleteCollections, $params);
      $star = false;
    } else {
      $insertCollections = "INSERT INTO Collections (userID, postID) VALUES (?, ?);";
      $params = array($userID, $postID);
      sqlsrv_query($conn, $insertCollections, $params);
      $star = true;
    }
  }
}

?>
<?php
// 貼文資訊
$selectPost = "SELECT Users.userID, Users.username, Posts.title, Posts.createdAt, Posts.content FROM Posts 
JOIN Users ON Users.userID = Posts.userID
WHERE Posts.postID = ?;";
$params = array($_GET['postID']);
$postQuery = sqlsrv_query($conn, $selectPost, $params);
$post = sqlsrv_fetch_array($postQuery, SQLSRV_FETCH_ASSOC);

// 貼文數量
$selectNumOfPosts = "SELECT COUNT(Posts.postID) AS '貼文數量' FROM Posts;";
$postsCountQuery = sqlsrv_query($conn, $selectNumOfPosts);
$postsConut = sqlsrv_fetch_array($postsCountQuery, SQLSRV_FETCH_ASSOC);

// 確認是否有加入收藏
$selectCollections = "SELECT postID FROM Collections WHERE userID = ? AND postID = ?;";
$params = array($userID, $postID);
$collectionsQuery = sqlsrv_query($conn, $selectCollections, $params);
$collections = sqlsrv_fetch_array($collectionsQuery);

if ($collections) {
  $star = true;
} else {
  $star = false;
}

// 標籤
$selectTagsName = "SELECT DISTINCT Tags.name FROM Tags;";
$tagsQuery = sqlsrv_query($conn, $selectTagsName);

// 評論
$selectComments = "SELECT Users.username, Comments.content, Comments.createdAt
FROM Comments
JOIN Posts ON Posts.postID = Comments.postID
JOIN Users ON Users.userID = Comments.userID
WHERE Comments.postID = ?;
";
$params = array($postID);
$commentsQuery = sqlsrv_query($conn, $selectComments, $params);

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

  <!-- container -->
  <div class="w-full flex flex-row p-16 pl-24">

    <div class="m-2 mt-6 mr-6">
      <form method="post" action="post.php?postID=<?php echo $_GET['postID'] ?>">
        <button type="submit">
          <?php
          if ($star) {
            echo '<i class="fa-solid fa-star fa-2xl text-yellow-500 hover:text-zinc-500"></i>';
          } else {
            echo '<i class="fa-regular fa-star fa-2xl text-zinc-500 hover:text-yellow-500"></i>';
          };
          ?>
        </button>
      </form>
    </div>

    <main class="w-3/6 flex flex-col gap-y-6 pr-16">
      <!-- title -->
      <h1 class="text-5xl font-bold"><?php echo $post['title'] ?></h1>
      <!-- tags -->
      <!-- name createdAt -->
      <div class="flex flex-row gap-x-4">
        <h5 class="font-bold hover:text-orange-500 active:text-orange-500">
          <a href="#">
            #<?php echo $post['username']; ?>
          </a>
        </h5>
        <h5 class="text-zinc-400 font-bold"><?php echo $post['createdAt']->format("Y-m-d") ?></h5>
      </div>
      <!-- content -->
      <p class="text-xl mb-6"><?php echo $post['content'] ?></p>

      <!-- comment section -->
      <div class="h-fit w-full bg-gray-100 my-6 rounded-lg p-2">
        <h1 class="text-3xl font-bold">評論</h1>
      </div>

      <!-- all comments -->
      <?php
      while ($row = sqlsrv_fetch_array($commentsQuery, SQLSRV_FETCH_ASSOC)) {
        $createdAt = $row["createdAt"]->format("Y-m-d");

        echo '
          <div class="py-4 px-16 flex flex-row shadow rounded-lg transition-transform duration-500 ease-in-out transform hover:-translate-y-1 select-none">
              
              <div class="w-1/6 pr-12">
                  <img class="avatar rounded-full outline outline-2 outline-orange-200" src="./assets/pig.jpg" alt="avatar" />
                  <h1 class="text-lg font-bold text-slate-500">' . $row["username"] . '</h1>
              </div>
              
              <div class="flex flex-col justify-between py-2">
                <h1 class="text-3xl font-bold">' . $row["content"] . '</h1>
                <h5 class="text-sm font-extrabold text-slate-400">' . $createdAt . '</h5>
              </div>
          </div>
        ';
      }
      ?>



      <!-- post comment -->
      <form method="post" action="post.php?postID=<?php echo $_GET['postID'] ?>">
        <div class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50">
          <div class="px-4 py-2 bg-white rounded-t-lg">
            <label for="comment" class="sr-only">Your comment</label>
            <textarea name="comment" id="comment" rows="4" class="w-full px-0 text-base text-gray-900 bg-white border-0 focus:ring-0 focus-visible:outline-none" placeholder="Write a comment..." required></textarea>
          </div>
          <div class="flex items-center justify-between px-4 py-2 border-t">
            <button type="submit" class="inline-flex items-center py-2.5 px-5 text-base font-medium text-center text-white bg-orange-300 rounded-lg focus:ring-4 focus:ring-blue-200 hover:bg-orange-200">
              評論
            </button>
          </div>
        </div>
      </form>

    </main>

    <side class="w-5/12 px-16 flex flex-col gap-y-8 items-center">

      <!-- counter -->
      <div class="w-1/2 border border-gray-200 rounded-lg shadow">

        <!-- counter title -->
        <ul class="text-sm font-medium text-center text-gray-500 divide-x divide-gray-200 rounded-lg sm:flex" id="fullWidthTab" data-tabs-toggle="#fullWidthTabContent" role="tablist">
          <li class="w-full">
            <button id="stats-tab" data-tabs-target="#stats" type="button" role="tab" aria-controls="stats" aria-selected="true" class="text-lg font-bold text-zinc-700 inline-block w-full p-4 rounded-tl-lg bg-orange-200 hover:bg-orange-100 focus:outline-none">總計</button>
          </li>
        </ul>

        <div class="border-t border-gray-200">
          <div class="p-4 bg-white rounded-lg md:p-8" id="stats" role="tabpanel">
            <dl class="flex flex-col max-w-screen-xl gap-8 p-4 mx-auto text-gray-900">
              <div class="flex flex-col items-center justify-center">
                <dt class="mb-2 text-3xl font-extrabold"><?php echo $postsConut['貼文數量'] ?></dt>
                <dd class="text-gray-500">Posts</dd>
              </div>
            </dl>
          </div>
        </div>
      </div>

      <!-- tag section -->
      <div class="w-1/2 border border-gray-200 rounded-lg shadow">

        <!-- counter title -->
        <ul class="text-sm font-medium text-center text-gray-500 divide-x divide-gray-200 rounded-lg sm:flex" id="fullWidthTab" data-tabs-toggle="#fullWidthTabContent" role="tablist">
          <li class="w-full">
            <button id="stats-tab" data-tabs-target="#stats" type="button" role="tab" aria-controls="stats" aria-selected="true" class="text-lg font-bold text-zinc-700 inline-block w-full p-4 rounded-tl-lg bg-orange-200 hover:bg-orange-100 focus:outline-none">標籤</button>
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