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

  <div class="flex justify-center flex-col my-5 w-1/2 px-32">

    <header class="mb-5">
      <h1 class="my-2 text-4xl font-extrabold leading-none tracking-tight text-gray-900 dark:text-black">
        建立你的帳號
      </h1>
      <div class="mb-2 avatarh-[2px] w-1/5 bg-pink-200"></div>
      <p class="text-lg font-normal text-gray-500 dark:text-gray-400">
        欸 說的都對 路過彰化的 onandon都要收費
      </p>
    </header>

    <main class="flex items-center justify-center w-full">
      <form method="POST" action="./db/register_action.php" class="flex flex-col w-full">
        <!-- <div class="mb-6">
          <label for="username" class="font-bold block mb-2 text-base text-gray-900 dark:text-black">名稱</label>
          <input type="text" name="username" id="username" placeholder="onandon" class="text-sm text-gray-900 w-full p-2.5 border-b-orange-300" required >
        </div> -->
        <div class="mb-6">
          <label for="username" class="font-bold block mb-1 text-base text-gray-500 ">名稱</label>
          <input type="text" id="username" name="username" class="outline-0 outline-orange-200 waveOutline p-2.5 text-sm font-bold border-width border-orange-300 border-b-2 w-1/4 transition-width duration-500 hover:w-full" placeholder="onandon" required>
        </div>
        <div class="mb-6">
          <label for="email" class="font-bold block mb-1 text-sm  text-gray-500 ">電子郵件</label>
          <input type="email" id="email" name="email" class="outline-0 outline-orange-200 waveOutline p-2.5 text-sm font-bold border-width border-orange-300 border-b-2 w-1/2 transition-width duration-500 hover:w-full" placeholder="john.doe@company.com" required>
        </div>
        <div class="mb-6">
          <label for="password" class="font-bold block mb-1 text-sm  text-gray-500 ">密碼</label>
          <input type="password" id="password" name="password" class="outline-0 outline-orange-200 waveOutline p-2.5 text-sm font-bold border-width border-orange-300 border-b-2 w-1/4 transition-width duration-500 hover:w-full" placeholder="•••••••••" required>
        </div>
        <div class="mb-6">
          <label for="confirm_password" class="font-bold block mb-1 text-sm text-gray-500 ">確認密碼</label>
          <input type="password" id="confirm_password" class="outline-0 outline-orange-200 waveOutline p-2.5 text-sm font-bold border-width border-orange-300 border-b-2 w-1/4 transition-width duration-500 hover:w-full" placeholder="•••••••••" required>
        </div>

        <!-- 有空再說 西八 -->
        <!-- <div class="flex items-start mb-6">
          <div class="flex items-center h-5">
          <input id="remember" type="checkbox" value=""
            class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800"
            required>
        </div>
        <label for="remember" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">I agree with the <a
            href="#" class="text-blue-600 hover:underline dark:text-blue-500">terms and conditions</a>.</label>
      </div> -->

        <button type="submit" class="text-white bg-gradient-to-br from-pink-300 to-orange-500 hover:bg-gradient-to-bl focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-base px-5 py-2.5 text-center mb-2">
          註冊
        </button>


      </form>
    </main>

  </div>



</body>

</html>