<?php

require('./vendor/autoload.php');
require('./ConnectDB.php');

$amountarr = [];

/**
 * Start session.
 */
session_start();
// $userId = $_SESSION['user_id'];

/**
 * @Constant HEALTHYPRODUCT.
 *  That is for the select the all healthy snacks.
 */
define('ALLHEALTHYPRODUCTS', "SELECT * FROM product WHERE cateogary = 'healthy'");

/**
 * @Constant UNHEALTHYPRODUCT.
 *  That is for the select the all unhealthy snacks.
 */
define('ALLUNHEALTHYPRODUCTS', "SELECT * FROM product WHERE cateogary = 'unhealthy'");


/**
 * Create the instase of the class Query.
 */
$db = new ConnectDB();
$conn = $db->connectDB();
$stmt = $conn->prepare(ALLHEALTHYPRODUCTS);
$stmt->execute();

// Fetch the healthy snacks result.
$healthyResult = $stmt->fetchAll();

$stmt = $conn->prepare(ALLUNHEALTHYPRODUCTS);
$stmt->execute();
// Fetch the unhealthy snacks result.
$unhealthyResult = $stmt->fetchAll();

array_push($amountarr, $_POST['selectitem']);
$totalAmount = 0;

for ($i = 0; $i < count($amountarr); $i++) {
  $totalAmount += $amountarr[$i];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="jquery-2.7.1.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style.css">
  <title>Document</title>
</head>
<script>
  $(document).ready(function() {
    $('#unhealthy').hide();
    $('#customerForm').hide();
    $('#healthy').hide();

    $("#healthybtn").click(function() {
      $('#unhealthy').hide();
      $('#customerForm').hide();
      $('#healthy').show();
    });

    $("#unhealthybtn").click(function() {
      $('#healthy').hide();
      $('#customerForm').hide();
      $('#unhealthy').show();
    });



    $("#submitItems").click(function() {
      $('#healthy').hide();
      $('#unhealthy').hide();
      $('#customerForm').show();
      const valuesArray = $('#selectItem').map(function() {
        return $(this).val();
      }).get();

      console.log(valuesArray);
    });
  });
</script>

<body>


  <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark sidebar" style="width: 200px;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
      <svg class="bi pe-none me-2" width="40" height="32">
        <use xlink:href="#bootstrap"></use>
      </svg>
      <span class="fs-4">Sidebar</span>
    </a>
    <span class="text-warning">Note: To see the content click on any links.</span>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li>
        <a href="#" class="nav-link  active text-white">
          <svg class="bi pe-none me-2" width="16" height="16">
            <use xlink:href="#speedometer2"></use>
          </svg>
          Dashboard
        </a>
      </li>
      <li id="healthybtn">
        <a class="nav-link text-white">
          <svg class="bi pe-none me-2" width="16" height="16">
            <use xlink:href="#table"></use>
          </svg>
          Healthy
        </a>
      </li>
      <li id="unhealthybtn">
        <a class="nav-link text-white ">
          <svg class="bi pe-none me-2" width="16" height="16">
            <use xlink:href="#grid"></use>
          </svg>
          Unhealthy
        </a>
      </li>
      <li>
        <a href="/admin-login" class="nav-link text-white " id="unhealthybtn">
          <svg class="bi pe-none me-2" width="16" height="16">
            <use xlink:href="#grid"></use>
          </svg>
          Login as admin
        </a>
      </li>
    </ul>
    <a type="submit" id="submitItems" class="btn btn-success">submit</a>
  </div>
  </div>

  <div class="healthy" id="healthy">
    <div class="wrapper">
      <div class="container mt-5">
        <table class="table caption-top  table-hover" id="myTable">
          <h1>Stocks</h1>
          <thead>
            <tr class="table-dark py-3">
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Price</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 1;
            // Print all data in the form of HTML table.
            foreach ($healthyResult as $value) {
            ?>
              <tr>
                <th scope="row"><?php echo $i; ?></th>
                <td><?php echo $value['name']; ?></td>
                <td><?php echo $value['price']; ?></td>
                <td>
                  <form method="post"><input type="checkbox" name="selectitem" id="selectitem" value="<?php echo $value['price'] ?>"> <input class="btn btn-primary" type="submit" value="submit"></form>
                </td>
              </tr>
            <?php $i++;
            } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="unhealthy" id="unhealthy">
    <div class="wrapper">
      <div class="container mt-5">
        <table class="table caption-top  table-hover" id="myTable">
          <h1>Stocks</h1>
          <thead>
            <tr class="table-dark py-3">
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Price</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 1;
            // Print all data in the form of HTML table.
            foreach ($unhealthyResult as $value) {
            ?>
              <tr>
                <th scope="row"><?php echo $i; ?></th>
                <td><?php echo $value['name']; ?></td>
                <td><?php echo $value['price']; ?></td>
                <td>
                  <form method="post"><input type="checkbox" name="selectitem" id="selectitem" value="<?php echo $value['price'] ?>"> <input type="submit" class="btn btn-primary" value="submit"></form>
                </td>
              </tr>
            <?php $i++;
            } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="container" id="customerForm">
    <div class="registerContent d-flex justify-center item.center flex-col">
      <div class="innerContent ">
        <h3 class="roboto-medium">Add Customer Details</h3>
        <hr>
        <form id="form" method="post" action="/customer">
          <!-- Input for last name. -->
          <div class="formDiv">
            <label for="">Name</label>
            <input class="roboto-light" type="text" id="name" name="name" placeholder="Customer Name" autocomplete="off">
          </div>
          <!-- Input for last name. -->
          <div class="formDiv">
            <label for="">Email</label>
            <input class="roboto-light" type="text" id="email" name="email" placeholder="Email of Customer" autocomplete="off">
          </div>
          <!-- Input for last name. -->
          <div class="formDiv">
            <label for="">Phone Number</label>
            <input class="roboto-light" type="tel" id="phone" name="phone" placeholder="Phone Number" autocomplete="off">
          </div>
          <!-- Input for last name. -->
          <div class="formDiv">
            <label for="">Payable Amount</label>
            <input class="roboto-light" type="text" id="paybleamount" name="paybleamount" value="<?php echo $totalAmount; ?>" autocomplete="off">
          </div>
          <!-- Input field for submit button. -->
          <input type="submit" value="Submit" name="submit" class="submitBtn roboto-medium">
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>
