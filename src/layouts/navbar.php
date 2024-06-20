<?php
require_once 'app/User.php';
require_once 'app/Roles.php';

// check if user is login
session_start();
$user = isset($_SESSION['username']) ? $_SESSION['username'] : null;
$role = isset($_SESSION['role']) ? $_SESSION['role'] : null;

// check if user is logout
if (isset($_POST['logout'])) {
  $User->logout();
}

$current_page = basename($_SERVER['PHP_SELF']);
?>

<nav class="bg-white border-gray-200 border-b-2">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto py-4 px-6 md:px-10 xl:px-0">
    <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
      <span class="self-center text-2xl font-bold whitespace-nowrap">E-Moto Rentals</span>
    </a>
    <button data-collapse-toggle="navbar-dropdown" type="button" id="navbar-dropdown-button"
      class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
      aria-controls="navbar-dropdown" aria-expanded="false">
      <span class="sr-only">Open main menu</span>
      <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M1 1h15M1 7h15M1 13h15" />
      </svg>
    </button>
    <div class="hidden w-full md:block md:w-auto" id="navbar-dropdown">
      <ul
        class="flex flex-col font-medium p-4 md:p-0 mt-4 border md:items-center border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white">
        <li>
          <a href="index.php"
            class="<?= $current_page == 'index.php' ? 'text-blue-700' : 'text-slate-800' ?> block py-2 px-3 bg-blue-700 rounded md:bg-transparent md:p-0"
            aria-current="page">Home</a>
        </li>
        <?php if ($user): ?>
          <li>
            <a href="service.php"
              class="<?= $current_page == 'service.php' ? 'text-blue-700' : 'text-slate-800' ?> block py-2 px-3 bg-blue-700 rounded md:bg-transparent md:p-0">Services</a>
          </li>
        <?php endif ?>
        <li>
          <a href="contact.php"
            class="<?= $current_page == 'contact.php' ? 'text-blue-700' : 'text-slate-800' ?> block py-2 px-3 bg-blue-700 rounded md:bg-transparent md:p-0">Contact</a>
        </li>
        <?php if ($user): ?>
          <li>
            <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar"
              class="flex items-center justify-between w-full py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 md:w-auto"><?= $user ?>
              <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="m1 1 4 4 4-4" />
              </svg>
            </button>
            <!-- Dropdown menu -->
            <div id="dropdownNavbar"
              class="z-10 hidden absolute font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
              <ul class="py-2 text-sm  text-gray-700" aria-labelledby="dropdownLargeButton">
                <?php if ($user && $role == ROLE_ADMIN): ?>
                  <li>
                    <a href="admin-dashboard.php" class="block px-4 py-2 hover:bg-gray-100">Dashboard</a>
                  </li>
                <?php endif; ?>
                <li>
                  <a href="profile.php" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
                </li>
                <li>
                  <a href="customer-status.php" class="block px-4 py-2 hover:bg-gray-100">Status</a>
                </li>
              </ul>
              <div class="py-1">
                <form action="" method="POST">
                  <button type="submit" name="logout"
                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sign
                    out</button>
                </form>
              </div>
            </div>
          </li>
        <?php else: ?>
          <li>
            <a href="login.php"
              class="block py-2 px-3 text-slate-200 rounded bg-blue-500 border-blue-500 hover:bg-gray-100 md:hover:bg-transparent md:border-2 md:hover:text-blue-700 md:px-2 md:py-1">Login</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    const dropdownNavbarLink = document.querySelector('#dropdownNavbarLink');
    const dropdownNavbar = document.querySelector('#dropdownNavbar');
    if (dropdownNavbarLink) {
      dropdownNavbarLink.addEventListener("click", () => {
        dropdownNavbar.classList.toggle("hidden");
      });
    }

    const navbarDropdown = document.querySelector('#navbar-dropdown');
    const navbarDropdownButton = document.querySelector('#navbar-dropdown-button');
    navbarDropdownButton.addEventListener("click", () => {
      navbarDropdown.classList.toggle("hidden");
    });
  });
</script>