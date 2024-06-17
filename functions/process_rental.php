<?php
require_once '../app/Rental.php';
require_once '../app/Motorcycle.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['motorcycle_id']) && isset($_POST['user_id'])) {
    $motorcycle_id = $_POST['motorcycle_id'];
    $user_id = $_POST['user_id'];
    if ($Rental->rentalMotorcyclesByID($motorcycle_id, $user_id)) {
      $Motorcycle->updateMotorcyclesStatus($motorcycle_id, 0);
      header("Location: ../service.php?success=true");
    }
  }
} else {
  echo "Invalid request method.";
}
