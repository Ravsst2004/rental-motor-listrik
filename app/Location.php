<?php
require_once 'Database.php';

class Location extends Database
{
  private $tb_name = "locations";
  public function __construct()
  {
    parent::__construct();
  }

  public function getLocations()
  {
    $result = $this->conn->query("SELECT * FROM $this->tb_name");
    $rows = [];
    while ($data = mysqli_fetch_assoc($result)) {
      $rows[] = $data;
    }
    return $rows;
  }

  public function getLocationsWithPagination($locations_per_page, $offset)
  {
    $locations_per_page = max(0, (int) $locations_per_page);
    $offset = max(0, (int) $offset);
    $result = $this->conn->query("SELECT * FROM $this->tb_name LIMIT $locations_per_page OFFSET $offset");
    $rows = [];
    while ($data = mysqli_fetch_assoc($result)) {
      $rows[] = $data;
    }
    return $rows;
  }

  public function addLocation(array $data)
  {
    // Validasi semua Input
    if (empty($data['location_name']) || empty($data['location_address'])) {
      return 'All fields are required';
    }

    $location_name = mysqli_real_escape_string($this->conn, $data['location_name']);
    $location_address = mysqli_real_escape_string($this->conn, $data['location_address']);

    $query = "INSERT INTO $this->tb_name (location_name, location_address) VALUES ('$location_name', '$location_address')";
    $result = $this->conn->query($query);
    return $result;
  }

  public function updateLocation(array $data)
  {
    $location_id = mysqli_real_escape_string($this->conn, $data['edit_location_id']);
    $location_name = mysqli_real_escape_string($this->conn, $data['edit_location_name']);
    $location_address = mysqli_real_escape_string($this->conn, $data['edit_location_address']);

    $query = "UPDATE $this->tb_name SET location_name = '$location_name', location_address = '$location_address' WHERE location_id = $location_id";
    $result = $this->conn->query($query);
    return $result;
  }

  public function deleteLocation($location_id)
  {
    $query = "DELETE FROM $this->tb_name WHERE location_id = $location_id";
    $result = $this->conn->query($query);
    return $result;
  }
}

$Location = new Location();