<?php
require_once '../app/Location.php';

$location_id = $_GET['location_id'];
if ($Location->deleteLocation($location_id)) {
  header("Location: /rental-motor-listrik/location.php?success=true&text=Location deleted successfully");
}
