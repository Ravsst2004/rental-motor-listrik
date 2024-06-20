<?php
require_once 'src/layouts/header.php';
require_once 'app/Motorcycle.php';
require_once 'app/Location.php';

$motorcycles = $Motorcycle->getMotorcycles();
$locations = $Location->getLocations();

$error = false;
$success = $_GET['success'] ?? null;
$text = $_GET['text'] ?? "";

// Add Motorcycle
if (isset($_POST['add_motorcycles'])) {
  // var_dump($_POST);
  // var_dump($_FILES);
  $result = $Motorcycle->addMotorcycles($_POST);
  if ($result === true) {
    // include 'functions/generate_qr.php';
    $text = "Motorcycle added successfully";
    $success = true;
  } else {
    $error = $result;
  }
}

// Edit Motorcycle
if (isset($_POST["edit_motorcycle"])) {
  $result = $Motorcycle->updateMotorcycles($_POST);
  if ($result === true) {
    $text = "Motorcycle updated successfully";
    $success = true;
  } else {
    $error = $result;
  }
}




// pagination
$total_motorcycles = count($motorcycles);
$motorcycles_per_page = 8;
$total_pages = ceil($total_motorcycles / $motorcycles_per_page);
$current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
if ($current_page < 1) {
  $current_page = 1;
} elseif ($current_page > $total_pages) {
  $current_page = $total_pages;
}
$offset = ($current_page - 1) * $motorcycles_per_page;
$motorcycles = $Motorcycle->getMotorcyclesWithPagination($motorcycles_per_page, $offset);
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


<!-- Content -->
<div class="p-4 sm:ml-64">
  <div class="flex w-full gap-x-5">
    <!-- Form Add Motorcycle -->
    <div class="w-[30%]">
      <div class="w-full">
        <form class="bg-white shadow-md border border-slate-200 rounded px-8 pt-6 pb-8 mb-4" method="POST"
          enctype="multipart/form-data">
          <!-- Input for Merk -->
          <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="merk">Merk</label>
            <input
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              id="merk" name="merk" type="text" placeholder="Enter merk">
          </div>
          <!-- Input for Model -->
          <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="model">Model</label>
            <input
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              id="model" name="model" type="text" placeholder="Enter model">
          </div>
          <!-- Input for Year -->
          <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="year">Year</label>
            <input
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              id="year" name="year" type="number" placeholder="Enter year">
          </div>
          <!-- Input for Hourly Rental Price -->
          <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="hourly_rental_price">Hourly Rental
              Price</label>
            <input
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              id="hourly_rental_price" name="hourly_rental_price" type="number" placeholder="Enter hourly rental price">
          </div>
          <!-- Input for image -->
          <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="image">Image </label>
            <input
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              id="image" name="image" type="file">
            <p class="text-red-500 text-sm italic">Allowed extensions .png | .jpg | .jpeg</p>
          </div>
          <!-- Dropdown for Lokasi -->
          <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="location">Lokasi</label>
            <select
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              id="location" name="location_id">
              <?php foreach ($locations as $location): ?>
                <option value="<?= $location['location_id'] ?>"><?= $location['location_name'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <!-- Submit Button -->
          <div class="flex items-center justify-between">
            <button
              class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
              name="add_motorcycles" type="submit">
              Add Motorcycle
            </button>
          </div>
        </form>
      </div>
    </div>
    <!-- Table Motorcycle List -->
    <div class="w-[70%]">
      <div class="overflow-x-auto border border-slate-200 rounded-md shadow-md">
        <h1 class="text-2xl px-5 py-2 font-bold leading-tight tracking-tight text-gray-900 ">Motorcycle List</h1>
        <hr>
        <div class="mx-5 border border-slate-200 rounded-md my-2">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  No</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Merk</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Model</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Year</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Hourly Rental Price</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Status</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Location</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Action</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <?php $number = ($current_page - 1) * $motorcycles_per_page + 1; ?>
              <?php foreach ($motorcycles as $motorcycle): ?>
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900"><?= $number++ ?></div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900"><?= $motorcycle['merk'] ?></div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900"><?= $motorcycle['model'] ?></div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900"><?= $motorcycle['year'] ?></div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900"><?= $motorcycle['hourly_rental_price'] ?></div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900"><?= $motorcycle['status'] == 1 ? 'Tersedia' : 'Tidak Tersedia' ?>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900"><?= $motorcycle['location_name'] ?></div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap flex gap-x-2">
                    <a class="btnModalEditLocation bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                      data-motorcycle-id="<?= $motorcycle['motorcycle_id'] ?>"
                      data-motorcycle-merk="<?= $motorcycle['merk'] ?>"
                      data-motorcycle-model="<?= $motorcycle['model'] ?>"
                      data-motorcycle-year="<?= $motorcycle['year'] ?>"
                      data-motorcycle-hourly-rental-price="<?= $motorcycle['hourly_rental_price'] ?>"
                      data-motorcycle-status="<?= $motorcycle['status'] ?>"
                      data-motorcycle-location="<?= $motorcycle['location_id'] ?>"
                      data-motorcycle-image="<?= $motorcycle['image_url'] ?>"">
                      Edit
                    </a>
                <a href=" #"
                      onclick="showConfirmDelete(event, 'functions/motorcycle_delete.php?motorcycle_id=<?= $motorcycle['motorcycle_id'] ?>')"
                      class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                      Delete
                    </a>

                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
      <!-- Pagination button -->
      <div class="flex gap-x-4 mt-4">
        <div>
          <?php if ($current_page > 1): ?>
            <a href="?page=<?= $current_page - 1 ?>"
              class="text-slate-100 rounded-lg p-2 border bg-blue-700 hover:bg-blue-900">Previous</a>
          <?php endif; ?>
        </div>
        <div>
          <?php if ($current_page < $total_pages): ?>
            <a href="?page=<?= $current_page + 1 ?>"
              class="text-slate-100 rounded-lg p-2 border bg-blue-700 hover:bg-blue-900">Next</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Confirm  -->
<div id="customConfirm" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
  <div class="relative top-1/4 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
    <div class="mt-3 text-center">
      <h3 class="text-lg leading-6 font-medium text-gray-900">Are you sure?</h3>
      <div class="mt-2 px-7 py-3">
        <p class="text-sm text-gray-500">You won't be able to revert this!</p>
      </div>
      <div class="items-center px-4 py-3">
        <button id="confirmButton"
          class="px-4 py-2 bg-red-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-red-600">Yes,
          delete it!</button>
        <button id="cancelButton"
          class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-600 mt-2">Cancel</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit Motorcycle -->
<div id="modalEditLocation"
  class="fixed top-0 left-0 z-50 flex items-center justify-center w-full h-full bg-black bg-opacity-50 hidden">
  <div class="bg-white rounded-lg shadow-lg w-1/3">
    <div class="flex items-center justify-between bg-gray-200 px-6 py-4">
      <h2 class="text-lg font-semibold">Edit Motorcycle</h2>
      <button id="closeModalEditLocation" class="text-gray-600 hover:text-gray-800 focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
    </div>
    <div class="p-6">
      <!-- Form Edit Motorcycle -->
      <form id="formEditLocation" method="POST" enctype="multipart/form-data">
        <input type="hidden" id="edit_motorcycle_id" name="edit_motorcycle_id">

        <!-- Input for Merk -->
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_merk">Merk</label>
          <input type="text" id="edit_merk" name="edit_merk"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            placeholder="Enter merk">
        </div>

        <!-- Input for Model -->
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_model">Model</label>
          <input type="text" id="edit_model" name="edit_model"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            placeholder="Enter model">
        </div>

        <!-- Input for Year -->
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_year">Year</label>
          <input type="number" id="edit_year" name="edit_year"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            placeholder="Enter year">
        </div>

        <!-- Input for Hourly Rental Price -->
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_hourly_rental_price">Hourly Rental
            Price</label>
          <input type="number" id="edit_hourly_rental_price" name="edit_hourly_rental_price"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            placeholder="Enter hourly rental price">
        </div>

        <!-- Input Image -->
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_image">Image</label>
          <input type="file" id="edit_image" name="edit_image"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            placeholder="Enter hourly rental price">
        </div>

        <!-- Dropdown for Lokasi -->
        <div class="mb-4">
          <label class="block  text-gray-700 text-sm font-bold mb-2" for="edit_location">Lokasi</label>
          <select id="edit_location" name="edit_location_id"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            <?php foreach ($locations as $location): ?>
              <option value="<?= $location['location_id'] ?>"><?= $location['location_name'] ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-between">
          <button type="submit" name="edit_motorcycle"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Save Changes
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  const modalEditLocation = document.getElementById('modalEditLocation');
  const closeModalEditLocation = document.getElementById('closeModalEditLocation');
  const editButtons = document.querySelectorAll('.btnModalEditLocation');

  editButtons.forEach(button => {
    button.addEventListener('click', (event) => {
      modalEditLocation.classList.remove('hidden');


      const motorcycleId = button.getAttribute('data-motorcycle-id');
      const motorcycleMerk = button.getAttribute('data-motorcycle-merk');
      const motorcycleModel = button.getAttribute('data-motorcycle-model');
      const motorcycleYear = button.getAttribute('data-motorcycle-year');
      const motorcycleHourlyRentalPrice = button.getAttribute('data-motorcycle-hourly-rental-price');
      const motorcycleStatus = button.getAttribute('data-motorcycle-status');
      const motorcycleLocation = button.getAttribute('data-motorcycle-location');
      const motorcycleImageUrl = button.getAttribute('data-motorcycle-image');

      document.getElementById('edit_motorcycle_id').value = motorcycleId;
      document.getElementById('edit_merk').value = motorcycleMerk;
      document.getElementById('edit_model').value = motorcycleModel;
      document.getElementById('edit_year').value = motorcycleYear;
      document.getElementById('edit_hourly_rental_price').value = motorcycleHourlyRentalPrice;
      document.getElementById('edit_image').value = motorcycleImageUrl;
      document.getElementById('edit_location').value = motorcycleLocation;
    });
  });

  closeModalEditLocation.addEventListener('click', (event) => {
    modalEditLocation.classList.add('hidden');
  });

  const alertClose = document.getElementById("alert-close");
  alertClose.addEventListener("click", function () {
    document.getElementById("alert").classList.add("hidden");
    window.location.href = "motor.php";
  })


  function showConfirmDelete(e, url) {
    e.preventDefault();

    const confirmDialog = document.getElementById('customConfirm');
    confirmDialog.classList.remove('hidden');

    const confirmButton = document.getElementById('confirmButton');
    confirmButton.onclick = function () {
      window.location.href = url;
    };

    const cancelButton = document.getElementById('cancelButton');
    cancelButton.onclick = function () {
      confirmDialog.classList.add('hidden');
    };
  }


</script>

<?php require_once 'src/layouts/footer.php'; ?>