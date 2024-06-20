<?php
require_once 'src/layouts/header.php';
require_once 'app/Rental.php';
require_once 'app/Motorcycle.php';

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$motorcycles = $Motorcycle->getMotorcycles();

$success = isset($_GET['success']);
?>

<div class="flex justify-center items-center mx-auto gap-x-9">


  <!-- Alert -->
  <?php if ($success): ?>
    <div id="alert"
      class="absolute w-[30rem] top-96 p-4 mb-4 text-green-800 border border-green-300 rounded-lg bg-green-50"
      role="alert">
      <div class="flex items-center">
        <h3 class="text-lg font-medium">Rental Status: Confirmed</h3>
      </div>
      <div class="mt-2 mb-4 text-sm">
        Thank you for rental our bike.
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


  <!-- Motorcycles Card-->
  <div class="grid grid-cols-4 gap-4 mx-auto pt-5 mt-24">
    <?php foreach ($motorcycles as $motorcycle): ?>
      <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow">
        <img class="w-full h-64 rounded-lg" src="src/image/motor/<?= $motorcycle['image_url'] ?>" alt="motorcycle image">
        <a href="#">
          <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900"><?= $motorcycle['merk'] ?> -
            <?= $motorcycle['model'] ?>
          </h5>
        </a>
        <p class="mb-3 font-normal text-gray-400">Price/hour Rp. <?= $motorcycle['hourly_rental_price'] ?></p>
        <?php if (($motorcycle['status'] == 1) && $user_id): ?>
          <button data-id="<?= $motorcycle['motorcycle_id'] ?>" data-merk="<?= $motorcycle['merk'] ?>"
            data-model="<?= $motorcycle['model'] ?>" data-year="<?= $motorcycle['year'] ?>"
            data-price="<?= $motorcycle['hourly_rental_price'] ?>"
            class="open-modal inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg focus:ring-4 focus:outline-none bg-slate-600 hover:bg-slate-700 focus:ring-slate-800">
            Rent now!
          </button>
        <?php elseif ($motorcycle['status'] != 1 && $user_id): ?>
          <button
            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-slate-900 cursor-not-allowed line-through">
            Not available
          </button>
        <?php else: ?>
          <a href="login.php"
            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg focus:ring-4 focus:outline-none bg-slate-600 hover:bg-slate-700 focus:ring-slate-800">
            Login now for rent
          </a>
        <?php endif ?>
      </div>
    <?php endforeach ?>
  </div>
</div>



<!-- Modal -->
<div id="modalRentMotorcycle"
  class="hidden fixed top-0 left-0 z-50 flex items-center justify-center w-full h-full bg-black bg-opacity-50">
  <div class="bg-white rounded-lg shadow-lg max-w-sm w-full">
    <div class="flex items-center justify-between bg-gray-200 px-6 py-4 rounded-t-lg">
      <h2 class="text-lg font-semibold">Rental Motorcycle</h2>
      <button id="closemodalRentMotorcycle" class="text-gray-600 hover:text-gray-800 focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
    </div>
    <div class="p-6">
      <h5 id="modal_merk_model" class="mb-2 text-2xl font-bold tracking-tight text-gray-900"></h5>
      <p id="modal_year" class="mb-3 font-normal text-gray-700"></p>
      <p id="modal_price" class="mb-3 font-normal text-gray-700"></p>

      <form id="rentalForm" method="POST" action="functions/process_rental.php">
        <input type="hidden" id="modal_motorcycle_id" name="motorcycle_id">
        <input type="hidden" id="modal_user_id" name="user_id" value="<?= $user_id ?>">
        <button type="submit"
          class="bg-slate-500 hover:bg-slate-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
          Confirm Rent
        </button>
      </form>
    </div>
  </div>
</div>



<script>
  document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("modalRentMotorcycle");
    const closeModalBtn = document.getElementById("closemodalRentMotorcycle");
    const openModalBtns = document.querySelectorAll(".open-modal");

    openModalBtns.forEach(button => {
      button.addEventListener("click", function () {
        const motorcycleId = this.getAttribute("data-id");
        const merk = this.getAttribute("data-merk");
        const model = this.getAttribute("data-model");
        const year = this.getAttribute("data-year");
        const price = this.getAttribute("data-price");

        document.getElementById("modal_motorcycle_id").value = motorcycleId;
        document.getElementById("modal_merk_model").textContent = `${merk} - ${model}`;
        document.getElementById("modal_year").textContent = `Year: ${year}`;
        document.getElementById("modal_price").textContent = `Price/hour: Rp. ${price}`;

        modal.classList.remove("hidden");
      });
    });

    closeModalBtn.addEventListener("click", function () {
      modal.classList.add("hidden");
    });
  });

  const alertClose = document.getElementById("alert-close");
  alertClose.addEventListener("click", function () {
    document.getElementById("alert").classList.add("hidden");
    window.location.href = "service.php";
  })
</script>

<?php require_once 'src/layouts/footer.php'; ?>