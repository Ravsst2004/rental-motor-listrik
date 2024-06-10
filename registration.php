<?php
require_once "app/User.php";

if (isset($_POST['registration'])) {
  if ($User->registration($_POST)) {
    echo "
            <script>
                alert('Registrasi sukses');
                document.location.href = 'login.php';
            </script>
        ";
  }
}

?>

<?php require_once 'src/layouts/header.php'; ?>

<section class="bg-gray-50">
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
          <div class="flex items-start">
            <div class="flex items-center h-5">
              <input id="terms" aria-describedby="terms" type="checkbox"
                class="w-4 h-4 border border-gray-300 rounded bg-gray-50 cursor-pointer focus:ring-3 focus:ring-primary-300"
                required="">
            </div>
            <div class="ml-3 text-sm">
              <label for="terms" class="font-light text-gray-500 cursor-pointer">I accept the <a
                  class="font-medium text-primary-600 cursor-pointer hover:underline" href="#">Terms and
                  Conditions</a></label>
            </div>
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