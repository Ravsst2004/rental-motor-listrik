<?php
require_once 'src/layouts/header.php';
require_once 'app/User.php';

$user = isset($_SESSION['username']) ? $_SESSION['username'] : null;
$role = isset($_SESSION['role']) ? $_SESSION['role'] : null;
if ($user == null) {
  header("Location: /rental-motor-listrik/");
  exit();
}

$user_id = $_SESSION['user_id'];
$user = $User->getUsersBId($user_id)[0];


// var_dump($user);

$success = false;
$error = false;
$text = "";
if (isset($_POST['edit_user'])) {
  $result = $User->editUser($_POST);
  if ($result === true) {
    $text = "Success to updated";
    $success = true;
  } else {
    $error = $result;
  }
}
?>

<!-- Alert -->
<div class="flex justify-center items-center mx-auto">
  <?php if ($error): ?>
    <div id="alert" class="absolute w-[30rem] top-96 p-4 mb-4 text-red-800 border border-red-300 rounded-lg bg-red-50"
      role="alert">
      <div class="flex items-center">
        <h3 class="text-lg font-medium">Error</h3>
      </div>
      <div class="mt-2 mb-4 text-sm">
        <?= $error ?>
      </div>
      <div class="flex">
        <button type="button" id="alert-close"
          class="text-red-800 bg-transparent border border-red-800 hover:bg-red-900 hover:text-white focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-xs px-3 py-1.5 text-center"
          data-dismiss-target="#alert-additional-content-3" aria-label="Close">
          Close
        </button>
      </div>
    </div>
  <?php elseif ($success): ?>
    <div id="alert"
      class="absolute w-[30rem] top-96 p-4 mb-4 text-green-800 border border-green-300 rounded-lg bg-green-50"
      role="alert">
      <div class="flex items-center">
        <h3 class="text-lg font-medium">success</h3>
      </div>
      <div class="mt-2 mb-4 text-sm">
        <h1><?= $text ?></h1>
      </div>
      <div class="flex">
        <button type="button" id="alert-close"
          class="text-green-800 bg-transparent border border-green-800 hover:bg-green-900 hover:text-white focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-xs px-3 py-1.5 text-center"
          data-dismiss-target="#alert-additional-content-3" aria-label="Close">
          Close
        </button>
      </div>
    </div>
  <?php endif; ?>
</div>

<div class="bg-white mt-28 overflow-hidden shadow rounded-lg border max-w-5xl mx-auto">
  <div class="px-4 py-5 sm:px-6">
    <h3 class="text-lg leading-6 font-semibold text-gray-900">
      <?= $user['username'] ?>
    </h3>
  </div>
  <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
    <dl class="sm:divide-y sm:divide-gray-200">
      <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class="text-sm font-medium text-gray-500">
          Full name
        </dt>
        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
          <?= $user['fullname'] ?>
        </dd>
      </div>
      <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class="text-sm font-medium text-gray-500">
          Email address
        </dt>
        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
          <?= $user['email'] ?>
        </dd>
      </div>
      <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class="text-sm font-medium text-gray-500">
          Phone number
        </dt>
        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
          <?= $user['phone'] ?>
        </dd>
      </div>
      <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class="text-sm font-medium text-gray-500">
          Address
        </dt>
        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
          <?= $user['address'] == null ? '-' : $user['address'] ?>
        </dd>
      </div>
      <div class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
        <button
          class="btnModalEditLocation w-fit m-5 bg-slate-500 hover:bg-slate-700 text-white font-bold py-2 px-5 mt-6 rounded"
          data-user-id="<?= $user['user_id'] ?>" data-user-fullname="<?= $user['fullname'] ?>"
          data-user-email="<?= $user['email'] ?>" data-user-phone="<?= $user['phone'] ?>"
          data-user-address="<?= $user['address'] ?>">
          Edit
        </button>
      </div>

    </dl>
  </div>
</div>


<!-- Modal Edit User -->
<div id="modalEditUser"
  class="fixed top-0 left-0 z-50 flex items-center justify-center w-full h-full bg-black bg-opacity-50 hidden">
  <div class="bg-white rounded-lg shadow-lg w-1/3">
    <div class="flex items-center justify-between bg-gray-200 px-6 py-4">
      <h2 class="text-lg font-semibold">Edit</h2>
      <button id="closeModalEditUser" class="text-gray-600 hover:text-gray-800 focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
    </div>
    <div class="p-6">
      <!-- Form Edit User -->
      <form id="formEditUser" method="POST">
        <input type="hidden" id="edit_user_id" name="user_id">

        <!-- Input for fullname -->
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_fullname">Fullname</label>
          <input type="text" id="edit_fullname" name="fullname"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            placeholder="Enter fullname">
        </div>

        <!-- Input for email -->
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_email">Email</label>
          <input type="email" id="edit_email" name="email"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            placeholder="Enter email">
        </div>

        <!-- Input for phone -->
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_phone">Phone</label>
          <input type="number" id="edit_phone" name="phone"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            placeholder="Enter phone">
        </div>

        <!-- Input for Address-->
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_address">Address</label>
          <textarea type="text" id="edit_address" name="address"
            class="shadow appearance-none border rounded w-full py-2 px-3 h-32 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            placeholder="Enter address"></textarea>

        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-between">
          <button type="submit" name="edit_user"
            class="bg-slate-500 hover:bg-slate-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Save Changes
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  const modalEditUser = document.getElementById('modalEditUser');
  const closeModalEditUser = document.getElementById('closeModalEditUser');
  const editButtons = document.querySelectorAll('.btnModalEditLocation');

  editButtons.forEach(button => {
    button.addEventListener('click', (event) => {
      modalEditUser.classList.remove('hidden');

      const userId = button.getAttribute('data-user-id');
      const userFullname = button.getAttribute('data-user-fullname');
      const userEmail = button.getAttribute('data-user-email');
      const userPhone = button.getAttribute('data-user-phone');
      const userAddress = button.getAttribute('data-user-address');

      document.getElementById('edit_user_id').value = userId;
      document.getElementById('edit_fullname').value = userFullname;
      document.getElementById('edit_email').value = userEmail;
      document.getElementById('edit_phone').value = userPhone;
      document.getElementById('edit_address').value = userAddress;
    });
  });

  closeModalEditUser.addEventListener('click', (event) => {
    modalEditUser.classList.add('hidden');
  });

  const alertClose = document.getElementById("alert-close");
  alertClose.addEventListener("click", function () {
    document.getElementById("alert").classList.add("hidden");
    window.location.href = "profile.php";
  })
</script>


<?php require_once 'src/layouts/footer.php'; ?>