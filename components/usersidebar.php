<div class="flex flex-col w-1/3 box-border px-16 relative bottom-24">
  <!-- user avatar -->
  <div class="flex flex-col select-none mb-4">
    <img class="w-1/3 rounded-full" src='./assets/pig.jpg' />
  </div>

  <!-- user name -->
  <h1 class="font-bold text-4xl capitalize"><?php echo $name; ?></h1>
  <div class="h-0.5 w-1/4 bg-orange-300"></div>

  <!-- edit user information -->
  <span class="inline-flex mt-6">
    <a href="editUser.php">

      <h2 class="font-bold text-lg hover:text-orange-400">
        <i class="fa-solid fa-pen-to-square mr-2"></i>
        使用者資料
      </h2>
    </a>
  </span>

  <!-- edit user posts -->
  <span class="inline-flex mt-6 mb-6">
    <a href="myPosts.php">
      <h2 class="font-bold text-lg hover:text-orange-400">
        <i class="fa-solid fa-signs-post mr-2"></i>
        貼文
      </h2>
    </a>
  </span>

  <!-- logout button -->
  <form method="post" action="user.php">
    <button type="submit" name="logout" class="select-none w-1/5 text-white bg-rose-400 hover:bg-rose-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none">
      登出
    </button>
  </form>
</div>