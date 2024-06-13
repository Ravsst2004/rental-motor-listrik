<?php

require_once 'library/phpqrcode/qrlib.php';
require_once 'app/Motorcycle.php';

$Motorcycle = new Motorcycle();

function generateQRCode($data, $filename)
{
  QRcode::png($data, $filename);
}

// Ambil semua data motor dari database
$motorcycles = $Motorcycle->getMotorcycles();
foreach ($motorcycles as $motorcycle) {
  $motorcycle_id = $motorcycle['motorcycle_id'];
  $motorcycle_merk = $motorcycle['merk'];
  $motorcycle_model = $motorcycle['model'];

  $data = "motorcycle_id:$motorcycle_id";
  $filename = "src/image/qr_code/$motorcycle_merk-$motorcycle_model.png";
  generateQRCode($data, $filename);
}