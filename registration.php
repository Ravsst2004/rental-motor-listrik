<?php
require_once "app/User.php";

// check if user is login
session_start();
if (isset($_SESSION['username']))
  header("Location: index.php");

$success = false;
$error = false;
if (isset($_POST['registration'])) {
  if ($User->registration($_POST)) {
    $success = true;
  } else {
    $error = true;
  }
}

?>

<?php require_once 'src/layouts/header.php'; ?>

<section class="bg-gray-50">

  <?php if ($success): ?>
    <div
      class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 absolute top-[4%] left-1/2 transform -translate-x-1/2 -translate-y-1/2"
      role="alert">
      <p class="font-bold">Success</p>
      <p>Your account succefuly registered</p>
    </div>
    <script>
      setTimeout(function () {
        window.location.href = 'login.php';
      }, 1000);
    </script>
  <?php endif; ?>

  <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
    <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
      <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
        <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl">
          Create an account
        </h1>
        <form class="space-y-4 md:space-y-6" action="#" method="POST">
          <div>
            <label for="fullname" class="block mb-2 text-sm font-medium text-gray-900">Full Name</label>
            <input type="text" name="fullname" id="fullname"
              class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
              placeholder="Full Name" required="">
          </div>
          <div>
            <label for="phone" class="block mb-2 text-sm font-medium text-gray-900">Phone Number</label>
            <input type="text" name="phone" id="phone"
              class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
              placeholder="Phone Number" required="">
          </div>
          <div>
            <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
            <input type="text" name="username" id="username"
              class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
              placeholder="Username" required="">
          </div>
          <div>
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Your email</label>
            <input type="email" name="email" id="email"
              class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
              placeholder="your@gmail.com" required="">
          </div>
          <div>
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
            <input type="password" name="password" id="password" placeholder="••••••••"
              class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
              required="">
          </div>
          <div>
            <label for="confirm-password" class="block mb-2 text-sm font-medium text-gray-900">Confirm password</label>
            <input type="password" name="confirm-password" id="confirm-password" placeholder="••••••••"
              class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
              required="">
          </div>
          <div>
            <label for="address" class="block mb-2 text-sm font-medium text-gray-900">Address</label>
            <textarea type="text" name="address" id="address" placeholder="Your address"
              class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
              required></textarea>
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