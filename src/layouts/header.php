<?php
function getTitle()
{
  date_default_timezone_set('Asia/Makassar');
  // Array of titles mapped to their respective URLs
  $titles = [
    '/rental-motor-listrik' . '/index.php' => 'Home',
    '/rental-motor-listrik/login.php' => 'Login',
    '/rental-motor-listrik/registration.php' => 'Registration',
    '/rental-motor-listrik/admin_dashboard.php' => 'Admin Dashboard',
    '/rental-motor-listrik/service.php' => 'Service',
    '/rental-motor-listrik/customer-status.php' => 'Status Rental',
    '/rental-motor-listrik/profile.php' => 'Profile',
    '/rental-motor-listrik/admin-dashboard.php' => 'Admin Dashboard',
    '/rental-motor-listrik/motor.php' => 'Admin',
    '/rental-motor-listrik/location.php' => 'Admin',
    '/rental-motor-listrik/users.php' => 'Admin',
    '/rental-motor-listrik/qr-scan-motorcycle.php' => 'Admin',
    '/rental-motor-listrik/rented-motorcycle.php' => 'Admin',
  ];

  // Get the current request URI
  $current_url = $_SERVER['REQUEST_URI'];

  // Return the title if the current URL exists in the array, otherwise return 'Page Not Found'
  return isset($titles[$current_url]) ? $titles[$current_url] : 'Page Not Found';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= getTitle(); ?></title>

  <link rel="stylesheet" href="./src/css/output.css">
  <script src="https://cdn.tailwindcss.com"></script>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: "#254336",
            secondary: "#6B8A7A",
            tertiary: "#B7B597",
            quaternary: "#DAD3BE",
          }
        }
      }
    }
  </script>

</head>

<body class="font-poppins">

  <?php
  // Dapatkan URL saat ini
  $current_url = $_SERVER['REQUEST_URI'];

  // Daftar URL yang tidak memerlukan header
  $not_url = [
    '/rental-motor-listrik/login.php',
    '/rental-motor-listrik/registration.php'
  ];

  // Daftar URL untuk admin yang memerlukan sidebar
  $page_pagination = $_GET['page'] ?? '';
  $admin_url = [
    '/rental-motor-listrik/admin-dashboard.php',
    '/rental-motor-listrik/admin-dashboard.php?page=' . $page_pagination,
    '/rental-motor-listrik/motor.php',
    '/rental-motor-listrik/motor.php?page=' . $page_pagination,
    '/rental-motor-listrik/location.php',
    '/rental-motor-listrik/location.php?page=' . $page_pagination,
    '/rental-motor-listrik/users.php',
    '/rental-motor-listrik/users.php?page=' . $page_pagination,
    '/rental-motor-listrik/qr-scan-motorcycle.php',
    '/rental-motor-listrik/rented-motorcycle.php',
  ];

  // Periksa apakah URL saat ini ada di dalam daftar URL yang dikecualikan
  if (!in_array($current_url, $not_url) && !in_array($current_url, $admin_url)) {
    include 'navbar.php';
  }

  // Periksa apakah URL saat ini ada di dalam daftar URL admin
  if (in_array($current_url, $admin_url)) {
    include 'sidebar.php';
  }
  ?>