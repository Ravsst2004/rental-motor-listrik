<?php
require_once 'src/layouts/header.php';
require_once 'app/User.php';
require_once 'app/Rental.php';
require_once 'app/Payment.php';

$rentals = $Rental->getRentedMotorcycle();
$payments = $Payment->getPayments();

// Pagination
$total_payments = count($payments);
$payments_per_page = 4;
$total_pages = ceil($total_payments / $payments_per_page);
$current_page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
if ($current_page < 1) {
  $current_page = 1;
} elseif ($current_page > $total_pages) {
  $current_page = $total_pages;
}
$offset = ($current_page - 1) * $payments_per_page;
$payments = $Payment->getPaymentsWithPagination($payments_per_page, $offset);
?>

<div class="p-4 sm:ml-64">
  <!-- Alert -->
  <div id="confirmation-card" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-[30rem]">
      <div class="flex items-center">
        <h3 class="text-lg font-medium">Confirm Payment</h3>
      </div>
      <div class="mt-2 mb-4 text-sm">
        Are you sure you want to approve this payment?
      </div>
      <div class="flex gap-x-4">
        <button type="button" id="confirm-approve" class="bg-green-500 text-white rounded-lg p-2">Approve</button>
        <button type="button" id="cancel-approve" class="bg-red-500 text-white rounded-lg p-2">Cancel</button>
      </div>
    </div>
  </div>

  <div>
    <h1 class="mt-5 font-bold text-2xl text-green-400">Payment Success</h1>
    <div class="grid grid-cols-2 gap-4">
      <?php foreach ($payments as $payment): ?>
        <?php if ($payment['status_pembayaran'] == 'berhasil'): ?>
          <div class="h-fit rounded-md border-4 border-l-green-500  p-5 flex flex-col gap-y-2 border-gray-50 shadow-lg">
            <span class="text-xs text-blue-600 uppercase">ID Transaksi: <?= $payment['payment_id'] ?></span>
            <h1 class="text-md">Customer name: <span class="font-light"><?= $payment['fullname'] ?></span></h1>
            <h1 class="text-md">Motorcycle: <span class="font-light"><?= $payment['merk'] ?> -
                <?= $payment['model'] ?></span>
            </h1>
            <h1 class="text-md">Rental Start: <span class="font-light"><?= $payment['waktu_sewa'] ?></span></h1>
            <h1 class="text-md">Return time: <span class="font-light"><?= $payment['waktu_kembali'] ?></span></h1>
            <?php if ($payment['status_pembayaran'] == 'pending' || $payment['status_pembayaran'] == null): ?>
              <h1 class="text-md text-red-400">Payment status: <span
                  class="font-light"><?= $payment['status_pembayaran'] ?></span>
              </h1>
            <?php elseif ($payment['status_pembayaran'] == 'berhasil'): ?>
              <h1 class="text-md text-green-400">Payment status: <span
                  class="font-light"><?= $payment['status_pembayaran'] ?></span>
              </h1>
            <?php endif ?>
          </div>
        <?php endif ?>
      <?php endforeach ?>
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

  <div>
    <h1 class="mt-10 font-bold text-2xl text-yellow-400">Payment Pending</h1>
    <div class="grid grid-cols-2 gap-4">
      <?php foreach ($rentals as $rental): ?>
        <?php if ($rental['status_pembayaran'] == 'pending'): ?>
          <div class="h-fit w-fit rounded-md border-l-4 border-green-500 p-5 flex flex-col gap-y-2">
            <span class="text-xs text-blue-600 uppercase">ID Transaksi: <?= $rental['rental_id'] ?></span>
            <h1 class="text-md">Customer name: <span class="font-light"><?= $rental['fullname'] ?></span></h1>
            <h1 class="text-md">Motorcycle: <span class="font-light"><?= $rental['merk'] ?> -
                <?= $rental['model'] ?></span>
            </h1>
            <h1 class="text-md">Rental Start: <span class="font-light"><?= $rental['waktu_sewa'] ?></span></h1>
            <h1 class="text-md">Return time: <span class="font-light"><?= $rental['waktu_kembali'] ?></span></h1>
            <?php if ($rental['status_pembayaran'] == 'pending' || $rental['status_pembayaran'] == null): ?>
              <h1 class="text-md text-red-400">Payment status: <span
                  class="font-light"><?= $rental['status_pembayaran'] ?></span>
              </h1>
            <?php elseif ($rental['status_pembayaran'] == 'berhasil'): ?>
              <h1 class="text-md text-green-400">Payment status: <span
                  class="font-light"><?= $rental['status_pembayaran'] ?></span></h1>
            <?php endif ?>
            <?php if ($rental['status_pembayaran'] == 'pending' || $rental['status_pembayaran'] == null): ?>
              <form action="functions/process_confirm_payment.php" method="POST">
                <input type="hidden" name="rental_id" value="<?= $rental['rental_id'] ?>">
                <input type="hidden" name="motorcycle_id" value="<?= $rental['motorcycle_id'] ?>">
                <input type="hidden" name="total_biaya" value="<?= $rental['total_biaya'] ?>">
                <input type="hidden" name="waktu_kembali" value="<?= $rental['waktu_kembali'] ?>">
                <button type="button"
                  class="approve-button bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                  data-rental-id="<?= $rental['rental_id'] ?>" data-motorcycle-id="<?= $rental['motorcycle_id'] ?>"
                  data-total-biaya="<?= $rental['total_biaya'] ?>" data-waktu-kembali="<?= $rental['waktu_kembali'] ?>">
                  Approve Payment
                </button>
              </form>
            <?php endif ?>
          </div>
        <?php endif ?>
      <?php endforeach ?>
    </div>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const approveButtons = document.querySelectorAll(".approve-button");
    const confirmationCard = document.getElementById("confirmation-card");
    const confirmApprove = document.getElementById("confirm-approve");
    const cancelApprove = document.getElementById("cancel-approve");

    let currentForm;

    approveButtons.forEach(button => {
      button.addEventListener("click", function () {
        currentForm = this.closest("form");
        confirmationCard.classList.remove("hidden");
      });
    });

    confirmApprove.addEventListener("click", function () {
      if (currentForm) {
        currentForm.submit();
      }
    });

    cancelApprove.addEventListener("click", function () {
      confirmationCard.classList.add("hidden");
    });
  });
</script>

<?php require_once 'src/layouts/footer.php'; ?>