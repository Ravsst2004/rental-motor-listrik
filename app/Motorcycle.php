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
    // Validasi semua Input
    if (empty($data['merk']) || empty($data['model']) || empty($data['year']) || empty($data['hourly_rental_price']) || empty($data['location_id'])) {
      return 'All fields are required';
    }

    // Validasi Merk (kosong, panjang max)
    if (empty($data['merk'])) {
      return 'Merk cannot be empty';
    }
    if (strlen($data['merk']) > 100) {
      return 'Merk must be less than 100 characters';
    }

    // Validasi Model (kosong, panjang max)
    if (empty($data['model'])) {
      return 'Model cannot be empty';
    }
    if (strlen($data['model']) > 100) {
      return 'Model must be less than 100 characters';
    }

    // Validasi Year (kosong, harus angka, panjang 4 karakter)
    if (empty($data['year'])) {
      return 'Year cannot be empty';
    }
    if (!is_numeric($data['year']) || strlen($data['year']) != 4) {
      return 'Year must be a 4-digit number';
    }

    // Validasi Harga Sewa per Jam (kosong, harus angka, harus positif)
    if (empty($data['hourly_rental_price'])) {
      return 'Hourly rental price cannot be empty';
    }
    if (!is_numeric($data['hourly_rental_price']) || $data['hourly_rental_price'] <= 0) {
      return 'Hourly rental price must be a positive number';
    }

    // Jika semua validasi berhasil, lakukan sanitasi data dan insert ke database
    $merk = mysqli_real_escape_string($this->conn, $data['merk']);
    $model = mysqli_real_escape_string($this->conn, $data['model']);
    $year = mysqli_real_escape_string($this->conn, $data['year']);
    $hourly_rental_price = mysqli_real_escape_string($this->conn, $data['hourly_rental_price']);
    $status = 1;
    $location = mysqli_real_escape_string($this->conn, $data['location_id']);

    $query = "INSERT INTO $this->tb_name (merk, model, year, hourly_rental_price, status, location_id) 
              VALUES ('$merk', '$model', '$year', '$hourly_rental_price', '$status', '$location')";
    $result = $this->conn->query($query);

    if ($result) {
      return true;
    } else {
      return 'Failed to add motorcycle';
    }
  }


  public function updateMotorcyclesStatus($motorcycle_id, $status)
  {
    $query = "UPDATE $this->tb_name SET status = '$status' WHERE motorcycle_id = '$motorcycle_id'";
    $result = $this->conn->query($query);
    return $result;
  }

  public function deleteMotorcycles($motorcycle_id)
  {
    $query = "SELECT merk, model FROM $this->tb_name WHERE motorcycle_id = $motorcycle_id";
    $result = $this->conn->query($query);
    $motorcycle = $result->fetch_assoc();

    if ($motorcycle) {
      $filename = "../src/image/qr_code/" . $motorcycle['merk'] . "-" . $motorcycle['model'] . ".png";
      if (file_exists($filename)) {
        unlink($filename);
      }
      $deleteQuery = "DELETE FROM $this->tb_name WHERE motorcycle_id = $motorcycle_id";
      $deleteResult = $this->conn->query($deleteQuery);
      return $deleteResult;
    }
    return false;
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