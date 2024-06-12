<?php
require_once 'Database.php';

class Motorcycle extends Database
{
  private $tb_name = "electric_motorcycles";
  public function __construct()
  {
    parent::__construct();
  }

  public function getMotorcycles()
  {
    $result = $this->conn->query("
    SELECT 
        $this->tb_name.*, 
        locations.location_name, 
        locations.location_address 
    FROM 
        $this->tb_name
    JOIN 
        locations 
    ON 
        $this->tb_name.location_id = locations.location_id
");

    $rows = [];
    while ($data = mysqli_fetch_assoc($result)) {
      $rows[] = $data;
    }
    return $rows;
  }

  public function addMotorcycles(array $data)
  {
    $merk = mysqli_real_escape_string($this->conn, $data['merk']);
    $model = mysqli_real_escape_string($this->conn, $data['model']);
    $year = mysqli_real_escape_string($this->conn, $data['model']);
    $hourly_rental_price = mysqli_real_escape_string($this->conn, $data['hourly_rental_price']);
    $status = 1;
    $location = mysqli_real_escape_string($this->conn, $data['location_id']);

    $query = "INSERT INTO $this->tb_name(merk, model, year, hourly_rental_price, status, location_id) VALUES ('$merk', '$model', '$year', '$hourly_rental_price', '$status', '$location')";
    $result = $this->conn->query($query);
    return $result;
  }

  public function deleteMotorcycles($motorcycle_id)
  {
    $query = "DELETE FROM $this->tb_name WHERE motorcycle_id = $motorcycle_id";
    $result = $this->conn->query($query);
    return $result;
  }

  public function getMotorcyclesWithPagination($motorcycle_per_page, $offset)
  {
    $sql = "SELECT 
    t.*, 
    l.location_name, 
    l.location_address 
FROM 
    $this->tb_name t
JOIN 
    locations l 
ON 
    t.location_id = l.location_id
LIMIT 
    $motorcycle_per_page 
OFFSET 
    $offset;
";
    $result = $this->conn->query($sql);
    $rows = [];
    while ($data = mysqli_fetch_assoc($result)) {
      $rows[] = $data;
    }
    return $rows;
  }

  public function updateMotorcycles(array $data)
  {
    $motorcycle_id = mysqli_real_escape_string($this->conn, $data['edit_motorcycle_id']);
    $merk = mysqli_real_escape_string($this->conn, $data['edit_merk']);
    $model = mysqli_real_escape_string($this->conn, $data['edit_model']);
    $year = mysqli_real_escape_string($this->conn, $data['edit_year']);
    $hourly_rental_price = mysqli_real_escape_string($this->conn, $data['edit_hourly_rental_price']);
    $location = mysqli_real_escape_string($this->conn, $data['edit_location_id']);

    $query = "UPDATE $this->tb_name SET merk = '$merk', model = '$model', year = '$year', hourly_rental_price = '$hourly_rental_price', location_id = '$location' WHERE motorcycle_id = $motorcycle_id";
    $result = $this->conn->query($query);
    return $result;
  }
}

$Motorcycle = new Motorcycle();