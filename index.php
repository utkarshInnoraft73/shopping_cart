<?php

$url = parse_url($_SERVER['REQUEST_URI']);
$path = $url['path'];

$query = '';
if (isset($url['query'])) {
  $query = $url['query'];
}

switch ($path) {

    // Route for the /, /index, /home;
  case '/':
  case '/index':
  case '/home':
    require './Dashboard.php';
    break;

    // Route for the /admin-login;
  case '/admin-login':
    require './Login.php';
    break;

    // Route for the /add-product;
  case '/add-product':
    require './AddProduct.php';
    break;

    // Route for the /customer;
  case '/customer':
    require './Customer.php';
    break;
    // Route for the /logout;
  case '/logout':
    require './Logout.php';
    break;

    // Route for any bad-request.
  default:
    require('./404.php');
}
