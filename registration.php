<?php
require_once "app/User.php";

session_start();
if (isset($_SESSION['username'])) {
  header("Location: index.php");
  exit;
}

$success = false;
$errors = null;
if (isset($_POST['registration'])) {
  $registrationResult = $User->registration($_POST);

  if ($registrationResult === true) {
    $success = true;
  } else {
    $errors = $registrationResult;
  }
}
?>
  

<?php require_once 'src/layouts/header.php'; ?>


<?php if (!empty($errors)): ?>
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
      <span><?= $errors ?></span>
    </div>
  </div>
<?php endif; ?>

<?php if ($success): ?>
  <div
    class="flex items-center p-4 mb-4 text-sm rounded-lg shadow-lg bg-green-50 text-green-600 absolute top-[10%] left-1/2 transform -translate-x-1/2 -translate-y-1/2"
    role="alert">
    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
      fill="currentColor" viewBox="0 0 20 20">
      <path
        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
    </svg>
    <div>
      <span class="">Your account succefuly registered</span>
    </div>
  </div>
  <script>
    setTimeout(function () {
      window.location.href = 'login.php';
    }, 1000);
  </script>
<?php endif; ?>

<section class="bg-gray-50">
  <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
    <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
      <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
        <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
          Create an account
        </h1>
        <form class="space-y-4 md:space-y-6" method="POST">
          <div>
            <label for="fullname" class="block mb-2 text-sm font-medium text-gray-900">Full Name</label>
            <input type="text" name="fullname" id="fullname"
              class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
              placeholder="Full Name">
          </div>
          <div>
            <label for="phone" class="block mb-2 text-sm font-medium text-gray-900">Phone Number</label>
            <input type="text" name="phone" id="phone"
              class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
              placeholder="Phone Number">
          </div>
          <div>
            <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
            <input type="text" name="username" id="username"
              class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
              placeholder="Username">
          </div>
          <div>
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Your email</label>
            <input type="email" name="email" id="email"
              class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
              placeholder="your@gmail.com">
          </div>
          <div>
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
            <input type="password" name="password" id="password" placeholder="••••••••"
              class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
          </div>
          <div>
            <label for="confirm-password" class="block mb-2 text-sm font-medium text-gray-900">Confirm
              password</label>
            <input type="password" name="confirm-password" id="confirm-password" placeholder="••••••••"
              class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
          </div>
          <div>
            <label for="address" class="block mb-2 text-sm font-medium text-gray-900">Address (Optional)</label>
            <textarea type="text" name="address" id="address" placeholder="Your address"
              class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"></textarea>
          </div>
          <button type="submit" name="registration"
            class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            Create an account
          </button>
          <div class="flex justify-center items-center">
            <a href="login.php" class="text-sm font-light text-blue-500 hover:underline">
              Already have an account?
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<?php require_once 'src/layouts/footer.php'; ?>