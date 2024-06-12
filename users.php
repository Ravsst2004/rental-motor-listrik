<?php
require_once 'src/layouts/header.php';
require_once 'app/User.php';

$users = $User->getUsers();
?>

<div class="p-4 sm:ml-64">
  <div class="overflow-x-auto border border-slate-200 rounded-md shadow-md">
    <h1 class="text-2xl px-5 py-2 font-bold leading-tight tracking-tight text-gray-900 ">Customers List</h1>
    <hr>
    <div class="mx-5 border border-slate-200 rounded-md my-2">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Username</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Email</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Full Name</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Address</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Phone</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <?php foreach ($users as $user): ?>
            <?php if ($user['role'] != 1): ?>
              <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900"><?= $user['username'] ?></div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900"><?= $user['email'] ?></div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900"><?= $user['fullname'] ?></div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900"><?= $user['address'] > 0 ? $user['address'] : '-' ?></div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900"><?= $user['phone'] ?></div>
                </td>
              </tr>
            <?php endif; ?>
          <?php endforeach; ?>

        </tbody>
      </table>
    </div>
  </div>

</div>
<?php require_once 'src/layouts/footer.php'; ?>