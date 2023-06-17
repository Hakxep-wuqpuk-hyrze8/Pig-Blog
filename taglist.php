<?php
// 包含資料庫連接檔案
require_once './db/db_connect.php';

// 標籤
$selectTagsName = "SELECT DISTINCT Tags.name FROM Tags;";
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
  <div class="w-full flex flex-row p-16 gap-8">
    <?php
    while ($tags = sqlsrv_fetch_array($tagsQuery, SQLSRV_FETCH_ASSOC)) {
      echo
      '
      <a href="tag.php?tag=' . $tags['name'] . '">
        <div class="py-4 px-16 flex flex-row shadow rounded-lg transition-transform duration-500 ease-in-out transform hover:-translate-y-1 hover:text-orange-400">
          
              <div class="py-1.5 flex flex-col justify-items-start justify-between">
                  <h1 class="text-3xl font-bold">
                    
                      ' . $tags['name'] . ' 
                  </h1>
              </div>

        </div>
      </a>
      ';
    }
    ?>
  </div>

</body>

</html>