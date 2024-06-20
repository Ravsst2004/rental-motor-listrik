<?php

require_once '../app/Motorcycle.php';

$motorcycle_id = $_GET['motorcycle_id'];
if ($Motorcycle->deleteMotorcycles($motorcycle_id)) {
  header("Location: /rental-motor-listrik/motor.php?success=true&text=Motorcycle deleted successfully");
}


