<?php
// 处理表单提交或其他逻辑

// 检查是否提交了表单或执行其他操作
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // 处理表单提交
}

// 获取用户数据或设置其他变量
$userName = 'John Doe';

// 检查是否点击了下拉菜单
$showDropdown = false;
if (isset($_GET['showDropdown']) && $_GET['showDropdown'] === 'true') {
  $showDropdown = true;
}
?>

<div class="relative ml-3">
  <div>
    <button type="button" class="flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="<?php echo $showDropdown ? 'true' : 'false'; ?>" aria-haspopup="true">
      <span class="sr-only">Open user menu</span>
      <img class="h-8 w-8 rounded-full" src="./assets/pig.jpg" alt="pig" />
    </button>
  </div>

  <!--
    Dropdown menu, show/hide based on menu state.

    Entering: "transition ease-out duration-100"
      From: "transform opacity-0 scale-95"
      To: "transform opacity-100 scale-100"
    Leaving: "transition ease-in duration-75"
      From: "transform opacity-100 scale-100"
      To: "transform opacity-0 scale-95"
  -->

</div>

<div class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1" style="display: <?php echo $showDropdown ? 'block' : 'none'; ?>;">
  <!-- Active: "bg-gray-100", Not Active: "" -->
  <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
  <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>
  <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</a>
</div>