<?php
require_once 'src/layouts/header.php';
require_once 'app/User.php';

$user = $User->getUsersBId($_SESSION['user_id'])[0];
// var_dump($user);
?>

<div class="max-w-4xl mx-auto p-8 bg-white shadow-lg rounded-lg my-10">
  <div class="text-center">
    <h1 class="text-4xl font-bold text-gray-900"><?= $user['username'] ?></h1>
    <h2 class="text-2xl text-gray-700 mt-2"><?= $user['fullname'] ?></h2>
  </div>
  <div class="mt-8">
    <h3 class="text-lg font-medium text-gray-700">Email</h3>
    <p class="text-gray-600"><?= $user['email'] ?></p>
  </div>
  <div class="mt-4">
    <h3 class="text-lg font-medium text-gray-700">Phone</h3>
    <p class="text-gray-600"><?= $user['phone'] ?></p>
  </div>
  <div class="mt-4">
    <h3 class="text-lg font-medium text-gray-700">Address</h3>
    <p class="text-gray-600"><?= $user['address'] == null ? '-' : $user['address'] ?></p>
  </div>
</div>


<?php require_once 'src/layouts/footer.php'; ?>