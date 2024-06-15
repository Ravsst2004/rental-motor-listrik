<?php
require_once 'src/layouts/header.php';
require_once 'app/User.php';
require_once 'app/Rental.php';
require_once 'app/Payment.php';

$rentals = $Rental->getRentedMotorcycle();
$payments = $Payment->getPayments();
?>

<div class="p-4 sm:ml-64">
  <div class="grid grid-cols-2 gap-10 mt-14">
    <?php foreach ($payments as $payment): ?>
      <?php if ($payment['status_pembayaran'] == 'berhasil'): ?>
        <div class="h-fit rounded-md border-4 border-l-green-500  p-5 flex flex-col gap-y-2 border-gray-50 shadow-lg">
          <span class="text-xs text-blue-600 uppercase">ID Transaksi: <?= $payment['payment_id'] ?></span>
          <h1 class="text-md">Customer name: <span class="font-light"><?= $payment['fullname'] ?></span></h1>
          <h1 class="text-md">Motorcycle: <span class="font-light"><?= $payment['merk'] ?> - <?= $payment['model'] ?></span>
          </h1>
          <h1 class="text-md">payment Start: <span class="font-light"><?= $payment['waktu_sewa'] ?></span></h1>
          <h1 class="text-md">Return time: <span class="font-light"><?= $payment['waktu_sewa'] ?></span></h1>
          <?php if ($payment['status_pembayaran'] == 'pending' || $payment['status_pembayaran'] == null): ?>
            <h1 class="text-md text-red-400">Payment status: <span
                class="font-light"><?= $payment['status_pembayaran'] ?></span>
            </h1>
          <?php elseif ($payment['status_pembayaran'] == 'berhasil'): ?>
            <h1 class="text-md text-green-400">Payment status: <span
                class="font-light"><?= $payment['status_pembayaran'] ?></span>
            </h1>
          <?php endif ?>
          <?php if ($payment['status_pembayaran'] == 'pending' || $payment['status_pembayaran'] == null): ?>
            <form action="functions/process_confirm_payment.php" method="POST">
              <input type="hidden" name="payment_id" value="<?= $payment['payment_id'] ?>">
              <input type="hidden" name="motorcycle_id" value="<?= $payment['motorcycle_id'] ?>">
              <input type="hidden" name="motorcycle_id" value="<?= $payment['total_biaya'] ?>">
              <input type="hidden" name="motorcycle_id" value="<?= $payment['waktu_kembali'] ?>">
              <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Approve
                Payment</button>
            </form>
          <?php endif ?>
        </div>
      <?php endif ?>
    <?php endforeach ?>
  </div>

  <!-- ======= -->

  <div class="grid grid-cols-2 gap-4 mt-14">
    <?php foreach ($rentals as $rental): ?>
      <?php if ($rental['status_pembayaran'] == 'pending'): ?>
        <div class="h-fit rounded-md border-l-4 border-green-500 p-5 flex flex-col gap-y-2">
          <span class="text-xs text-blue-600 uppercase">ID Transaksi: <?= $rental['rental_id'] ?></span>
          <h1 class="text-md">Customer name: <span class="font-light"><?= $rental['fullname'] ?></span></h1>
          <h1 class="text-md">Motorcycle: <span class="font-light"><?= $rental['merk'] ?> - <?= $rental['model'] ?></span>
          </h1>
          <h1 class="text-md">Rental Start: <span class="font-light"><?= $rental['waktu_sewa'] ?></span></h1>
          <h1 class="text-md">Return time: <span class="font-light"><?= $rental['waktu_sewa'] ?></span></h1>
          <?php if ($rental['status_pembayaran'] == 'pending' || $rental['status_pembayaran'] == null): ?>
            <h1 class="text-md text-red-400">Payment status: <span
                class="font-light"><?= $rental['status_pembayaran'] ?></span></h1>
          <?php elseif ($rental['status_pembayaran'] == 'berhasil'): ?>
            <h1 class="text-md text-green-400">Payment status: <span
                class="font-light"><?= $rental['status_pembayaran'] ?></span></h1>
          <?php endif ?>
          <?php if ($rental['status_pembayaran'] == 'pending' || $rental['status_pembayaran'] == null): ?>
            <form action="functions/process_confirm_payment.php" method="POST">
              <input type="hidden" name="rental_id" value="<?= $rental['rental_id'] ?>">
              <input type="hidden" name="motorcycle_id" value="<?= $rental['motorcycle_id'] ?>">
              <input type="hidden" name="motorcycle_id" value="<?= $rental['total_biaya'] ?>">
              <input type="hidden" name="motorcycle_id" value="<?= $rental['waktu_kembali'] ?>">
              <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Approve
                Payment</button>
            </form>
          <?php endif ?>
        </div>
      <?php endif ?>
    <?php endforeach ?>
  </div>
</div>

<?php require_once 'src/layouts/footer.php'; ?>