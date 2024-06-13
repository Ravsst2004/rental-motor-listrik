<?php
require_once 'src/layouts/header.php';
require_once 'app/Rental.php';

// $rentals = $Rental->rentalMotorcyclesByQrCode();

?>


<div>

  <form action="" method="POST">
    <div>
      <label for="qr_code" class="block mb-2 text-sm font-medium text-gray-900">QR Code</label>
      <input type="text" id="qr_code" name="qr_code"
        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
        placeholder="Enter QR code" required="">
    </div>
  </form>
</div>

<?php require_once 'src/layouts/footer.php'; ?>