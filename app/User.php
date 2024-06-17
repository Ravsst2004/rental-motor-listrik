<?php
require_once 'Database.php';
class User extends Database
{
  private $tb_name = 'users';
  public function __construct()
  {
    parent::__construct();
  }

  public function registration(array $data)
  {
    $fullname = mysqli_real_escape_string($this->conn, $data['fullname']);
    $phone = mysqli_real_escape_string($this->conn, $data['phone']);
    $username = mysqli_real_escape_string($this->conn, $data['username']);
    $email = mysqli_real_escape_string($this->conn, $data['email']);
    $password = mysqli_real_escape_string($this->conn, $data['password']);
    $confirm_password = mysqli_real_escape_string($this->conn, $data['confirm-password']);
    $address = mysqli_real_escape_string($this->conn, $data['address']);

    $result = $this->registrationValidation($fullname, $phone, $username, $email, $password, $confirm_password);
    if ($result === true) {
      $password = password_hash($password, PASSWORD_DEFAULT);
      $sql = "INSERT INTO $this->tb_name (username, email, password, fullname, address, phone) VALUES ('$username', '$email', '$password', '$fullname', '$address', '$phone')";
      if ($this->conn->query($sql)) {
        return true;
      } else {
        echo "Error: " . $sql . "<br>" . $this->conn->error;
      }
    } else {
      return $result;
    }
  }

  public function registrationValidation($fullname, $phone, $username, $email, $password, $confirm_password)
  {
    // Validasi semua Input
    if (empty($fullname) || empty($phone) || empty($username) || empty($email) || empty($password) || empty($confirm_password))
      return 'All fields are required';

    // Validasi Fullname (kosong, panjang max)
    if (empty($fullname))
      return 'Fullname cannot be empty';
    if (strlen($fullname) > 256)
      return 'Fullname must be less than 256 characters';

    // Validasi panjang phone (kosong, panjang min max, exist in database)
    if (empty($phone))
      return 'Phone number cannot be empty';
    if (strlen($phone) < 10 || strlen($phone) > 20)
      return 'Phone number must be between 10 and 20 characters';
    if (strpos($phone, ' ') !== false)
      return 'Phone number must not contain spaces';
    if (!is_numeric($phone))
      return 'Phone number must be a number';
    $sql = "SELECT * FROM $this->tb_name WHERE phone = '$phone'";
    $result = $this->conn->query($sql);
    if ($result->num_rows > 0)
      return 'Phone number already exists';

    // Validasi Username (kosong, panjang min max, space, exist in database)
    if (empty($username))
      return 'Username cannot be empty';
    if (strlen($username) < 5 || strlen($username) > 15)
      return 'Username must be between 5 and 15 characters';
    if (strpos($username, ' ') !== false)
      return 'Username must not contain spaces';
    $sql = "SELECT * FROM $this->tb_name WHERE username = '$username'";
    $result = $this->conn->query($sql);
    if ($result->num_rows > 0)
      return 'Username already exists';

    // Validasi Email (kosong, panjang min max, exist in database)
    if (empty($email))
      return 'Email cannot be empty';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
      return 'Invalid email format';
    $sql = "SELECT * FROM $this->tb_name WHERE email = '$email'";
    $result = $this->conn->query($sql);
    if ($result->num_rows > 0)
      return 'Email already exists';

    // Validasi password and confirm password (kosong, panjang min max, exist in database)
    if (empty($password))
      return 'Password cannot be empty';
    if (strlen($password) < 8 || strlen($password) > 20)
      return 'Password must be between 8 and 20 characters';
    if (empty($confirm_password))
      return 'Confirm password cannot be empty';
    if ($password !== $confirm_password) {
      return 'Password does not match';
    }

    return true;
  }

  public function login(array $data)
  {
    $username = htmlspecialchars($data['username']);
    $password = htmlspecialchars($data['password']);

    // check if username exists
    $sql = "SELECT * FROM $this->tb_name WHERE username = '$username'";
    $result = $this->conn->query($sql);
    if ($result->num_rows > 0) {
      $user = $result->fetch_assoc();
      if (password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        header("Location: index.php");
        die();
      }
    }
    return false;
  }

  public function getUsers()
  {
    $result = $this->conn->query("SELECT * FROM $this->tb_name");
    $rows = [];
    while ($data = mysqli_fetch_assoc($result)) {
      $rows[] = $data;
    }
    return $rows;
  }

  public function getUsersBId($user_id)
  {
    $result = $this->conn->query("SELECT * FROM $this->tb_name WHERE user_id = $user_id");
    $rows = [];
    while ($data = mysqli_fetch_assoc($result)) {
      $rows[] = $data;
    }
    return $rows;
  }

  public function logout()
  {
    session_start();
    session_unset();
    session_destroy();
    header("Location: /rental-motor-listrik/");
  }

  public function getUsersWithPagination($limit, $offset)
  {
    $sql = "SELECT * FROM users LIMIT $limit OFFSET $offset";
    $result = $this->conn->query($sql);
    $rows = [];
    if ($result && $result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
      }
    }
    return $rows;
  }
}

$User = new User();
