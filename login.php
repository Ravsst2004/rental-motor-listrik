<?php
require_once 'src/layouts/header.php';
require_once "app/User.php";

// check if user is login
session_start();
if (isset($_SESSION['username']))
  header("Location: index.php");

$error = null;
if (isset($_POST['login'])) {
  if (!$User->login($_POST)) {
    $error = true;
  }
}
?>

<?php if ($error): ?>
  <div id="errorAlert"
    class="flex items-center p-4 mb-4 text-sm rounded-lg shadow-xl bg-yellow-50 text-yellow-700 w-fit absolute top-[90%] left-[85%] transform -translate-x-1/2 -translate-y-1/2"
    role="alert">
    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
      fill="currentColor" viewBox="0 0 20 20">
      <path
        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
    </svg>
    <span class="sr-only">Info</span>
    <div class="w-96">
      <span>Credentials incorrect</span>
    </div>
  </div>
<?php endif; ?>

<section class="bg-gray-50">
  <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
    <div class="w-full bg-white rounded-lg shadow border md:mt-0 sm:max-w-md xl:p-0">
      <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
        <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
          Sign in to your account
        </h1>
        <form class="space-y-4 md:space-y-6" action="#" method="POST">
          <div>
            <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
            <input type="text" name="username" id="username"
              class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
              placeholder="username" required="">
          </div>
          <div>
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
            <input type="password" name="password" id="password" placeholder="••••••••"
              class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
              required="">
          </div>
          <button type="submit" name="login"
            class="w-full text-slate-50 bg-slate-600  hover:bg-slate-800 focus:ring-4 focus:outline-none focus:ring-slate-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Sign
            in</button>
          <div class="flex justify-center items-center">
            <a href="registration.php" class="text-sm font-light text-slate-800 hover:underline">
              Don’t have an account?
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<?php require_once 'src/layouts/footer.php'; ?>