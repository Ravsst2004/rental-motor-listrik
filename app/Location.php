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

  public function addLocation(array $data)
  {
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