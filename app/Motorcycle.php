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
    if (empty($data['merk']) || empty($data['model']) || empty($data['year']) || empty($data['hourly_rental_price']) || empty($data['location_id']) || empty($_FILES['image']['name'])) {
      return 'All fields are required';
    }

    // Validasi Merk (kosong, panjang max)
    if (strlen($data['merk']) > 100) {
      return 'Merk must be less than 100 characters';
    }

    // Validasi Model (kosong, panjang max)
    if (strlen($data['model']) > 100) {
      return 'Model must be less than 100 characters';
    }

    // Validasi Year (kosong, harus angka, panjang 4 karakter)
    if (!is_numeric($data['year']) || strlen($data['year']) != 4) {
      return 'Year must be a 4-digit number';
    }

    // Validasi Harga Sewa per Jam (kosong, harus angka, harus positif)
    if (!is_numeric($data['hourly_rental_price']) || $data['hourly_rental_price'] <= 0) {
      return 'Hourly rental price must be a positive number';
    }

    $rand = rand();
    $allowedExtensions = array('png', 'jpg', 'jpeg');
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    if (!in_array($ext, $allowedExtensions)) {
      return 'Invalid file extension. Only png, jpg, and jpeg are allowed.';
    }

    if ($file_size > 2000000) {
      return 'File size must be less than 2MB.';
    }

    $image = $rand . '_' . $file_name;
    $upload_path = 'src/image/motor/' . $image;

    if (!move_uploaded_file($file_tmp, $upload_path)) {
      return 'Failed to upload image.';
    }

    $merk = mysqli_real_escape_string($this->conn, $data['merk']);
    $model = mysqli_real_escape_string($this->conn, $data['model']);
    $year = mysqli_real_escape_string($this->conn, $data['year']);
    $hourly_rental_price = mysqli_real_escape_string($this->conn, $data['hourly_rental_price']);
    $status = 1;
    $location = mysqli_real_escape_string($this->conn, $data['location_id']);

    $query = "INSERT INTO $this->tb_name (merk, model, year, hourly_rental_price, image_url, status, location_id) 
              VALUES ('$merk', '$model', '$year', '$hourly_rental_price', '$image', '$status', '$location')";
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
    $query = "SELECT merk, model, image_url FROM $this->tb_name WHERE motorcycle_id = $motorcycle_id";
    $result = $this->conn->query($query);
    $motorcycle = $result->fetch_assoc();

    if ($motorcycle) {
      $qr_code_filename = "../src/image/qr_code/" . $motorcycle['merk'] . "-" . $motorcycle['model'] . ".png";
      $motor_image_filename = "../src/image/motor/" . $motorcycle['image_url'];
      if (file_exists($qr_code_filename)) {
        unlink($qr_code_filename);
        unlink($motor_image_filename);
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
    if ($_FILES['edit_image']['name']) {

      $query = "SELECT image_url FROM $this->tb_name WHERE motorcycle_id = " . $data['edit_motorcycle_id'];
      $result = $this->conn->query($query);

      if ($result && $result->num_rows > 0) {
        $current_image = $result->fetch_assoc()['image_url'];
        $path_current_image = "src/image/motor/" . $current_image;

        if (file_exists($path_current_image)) {
          unlink($path_current_image);
        }
      }

      $rand = rand();
      $allowedExtensions = array('png', 'jpg', 'jpeg');
      $file_name = $_FILES['edit_image']['name'];
      $file_size = $_FILES['edit_image']['size'];
      $file_tmp = $_FILES['edit_image']['tmp_name'];
      $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

      if (!in_array($ext, $allowedExtensions)) {
        return 'Invalid file extension. Only png, jpg, and jpeg are allowed.';
      }

      if ($file_size > 2000000) {
        return 'File size must be less than 2MB.';
      }

      $image = $rand . '_' . $file_name;
      $upload_path = 'src/image/motor/' . $image;

      if (!move_uploaded_file($file_tmp, $upload_path)) {
        return 'Failed to upload image.';
      }
    } else {
      $image = mysqli_real_escape_string($this->conn, $data['existing_image_name']);
    }

    $motorcycle_id = mysqli_real_escape_string($this->conn, $data['edit_motorcycle_id']);
    $merk = mysqli_real_escape_string($this->conn, $data['edit_merk']);
    $model = mysqli_real_escape_string($this->conn, $data['edit_model']);
    $year = mysqli_real_escape_string($this->conn, $data['edit_year']);
    $hourly_rental_price = mysqli_real_escape_string($this->conn, $data['edit_hourly_rental_price']);
    $location = mysqli_real_escape_string($this->conn, $data['edit_location_id']);

    $query = "UPDATE $this->tb_name SET merk = '$merk', model = '$model', year = '$year', hourly_rental_price = '$hourly_rental_price', location_id = '$location', image_url = '$image' WHERE motorcycle_id = $motorcycle_id";

    $result = $this->conn->query($query);
    return $result;
  }


}

$Motorcycle = new Motorcycle();