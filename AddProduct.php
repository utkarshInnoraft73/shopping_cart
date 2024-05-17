<?php

require('./vendor/autoload.php');
require('./ConnectDB.php');

/**
 * Start session.
 */
session_start();
$userId = $_SESSION['user_id'];

$db = new ConnectDB();
$conn = $db->connectDB();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_POST['name'];
  $price = $_POST['price'];
  $cateogary = $_POST['cateogary'];

  try {

    // Query for inser the data in the database.
    $query = "INSERT INTO product (`name`, `price`, `cateogary`) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);

    $stmt->bindParam(1, $name, PDO::PARAM_STR);
    $stmt->bindParam(2, $price, PDO::PARAM_STR);
    $stmt->bindParam(3, $cateogary, PDO::PARAM_STR);

    // set parameters and execute.
    if ($stmt->execute()) {

      // Locate the page in Homepage after successfully registered.
      $message = "Product is added successfully";
    }
  } catch (PDOException $e) {
    $message = "Opps Please try again.";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Linked font awesome. -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title>Add New products</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <section class="wrapper">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a href="/logout" class="btn btn-danger">Logout</a>
      </div>
    </nav>
    <div class="container">
      <div class="registerContent d-flex justify-center item.center flex-col">
        <div class="innerContent ">
          <h3 class="roboto-medium">Add Product.</h3>
          <?php echo $message; ?>
          <hr>
          <form id="form" method="post" enctype="multipart/form-data">
            <!-- Input for Name. -->
            <div class="formDiv">
              <input class="roboto-light" type="text" id="name" name="name" placeholder="Stock Name" autocomplete="off">
              <i class="fa-solid fa-check"></i>
              <i class="fa-solid fa-circle-exclamation"></i>
              <small class="roboto-light">Error msg</small>
            </div>
            <!-- Input for Price. -->
            <div class="formDiv">
              <input class="roboto-light" type="text" id="price" name="price" placeholder="Stock Price" autocomplete="off">
              <i class="fa-solid fa-check"></i>
              <i class="fa-solid fa-circle-exclamation"></i>
              <small class="roboto-light">Error msg</small>
            </div>
            <!-- Input for Cateogary. -->

            <div class="formDiv">
              <select class="roboto-light" type="text" id="cateogary" name="cateogary" placeholder="Added cateogary" autocomplete="off">
                <option value="healthy">Healthy</option>
                <option value="unhealthy">Unhealthy</option>

              </select>

            </div>
            <!-- Input field for submit button. -->
            <input type="submit" value="Submit" name="submit" class="submitBtn roboto-medium">
          </form>
        </div>
      </div>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
