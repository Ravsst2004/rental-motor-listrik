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
    $fullname = stripcslashes($data['fullname']);
    $phone = stripcslashes($data['phone']);
    $username = stripcslashes($data['username']);
    $email = stripcslashes($data['email']);
    $password = mysqli_real_escape_string($this->conn, $data['password']);
    $confirm_password = mysqli_real_escape_string($this->conn, $data['confirm-password']);

    // check if password matches with confirm password
    if ($password !== $confirm_password) {
      // return false;
      die('Password does not match');
    }

    // check if username already exists
    $sql = "SELECT * FROM $this->tb_name WHERE username = '$username'";
    $result = $this->conn->query($sql);
    if ($result->num_rows > 0) {
      // return false;
      die('Username already exists');
    }

    // check if email already exists
    $sql = "SELECT * FROM $this->tb_name WHERE email = '$email'";
    $result = $this->conn->query($sql);
    if ($result->num_rows > 0) {
      $user = $result->fetch_assoc();
      if (password_verify($password, $user['password'])) {

      }
    }

    // password hash
    $password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO $this->tb_name (username, email, password, fullname, phone) VALUES ('$username', '$email', '$password', '$fullname', '$phone')";
    if ($this->conn->query($sql) === TRUE) {
      echo "Registration successfully";
      return true;
    } else {
      echo "Error: " . $sql . "<br>" . $this->conn->error;
    }

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
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];
        header("Location: index.php");
        die();
      }
    }
    return false;
  }

  public function logout()
  {
    session_start();
    session_unset();
    session_destroy();
    header("Location: /rental-motor-listrik/");
  }

}

$User = new User();
