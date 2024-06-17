<?php
require_once 'src/layouts/header.php';
require_once 'app/Rental.php';

// Jika tombol rent_motorcycle ditekan
if (isset($_POST['rent_motorcycle'])) {
  // Mendapatkan ID motor dari hasil scan QR code
  $motorcycle_id = $_POST['qr_code'];

  // Mendapatkan data pelanggan (misalnya dari form)
  $customer_name = $_POST['customer_name'];
  $rental_duration = $_POST['rental_duration'];

  // Memanggil fungsi untuk menyewa motor berdasarkan ID
  $result = $Rental->rentalMotorcyclesByID($motorcycle_id, $customer_name);

  // Menampilkan pesan hasil penyewaan
  echo $result;
}
?>

<div class="p-4 sm:ml-64">
  <!-- Video untuk Pemindaian QR Code -->
  <!-- <video id="preview" class="w-fit h-64 bg-gray-200 mb-4 rounded-lg"></video> -->

  <!-- Form untuk mengisi data penyewaan -->
  <form action="" method="POST">
    <label for="qr_code">Hasil Scan QR Code:</label>
    <input type="text" id="qr_code" name="qr_code" placeholder="Tempat untuk hasil scan QR code" readonly>
    <br>
    <label for="customer_name">Nama Pelanggan:</label>
    <input type="text" id="customer_name" name="customer_name" required>
    <br>
    <label for="rental_duration">Durasi Sewa:</label>
    <input type="text" id="rental_duration" name="rental_duration" required>
    <br>
    <button type="submit" name="rent_motorcycle">Rent Motorcycle</button>
  </form>
</div>

<?php require_once 'src/layouts/footer.php'; ?>