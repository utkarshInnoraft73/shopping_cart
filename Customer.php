<?php

require('./vendor/autoload.php');

use Fpdf\Fpdf;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/**
 * @var array errors.
 * To Store the errors for respective fields.
 */
$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  /**
   * Getting the name.
   */
  $name = $_POST['name'];

  /**
   * Getting the email.
   */
  $email = $_POST['email'];

  /**
   * Getting phone number.
   */
  $phone = $_POST['phone'];

  /**
   * Getting Payable amount.
   */
  $payableAmount = $_POST['paybleamount'];

  /**
   * Create the instace of the class PHPMailer.
   */
  $mail = new PHPMailer(TRUE);
  try {
    // Server settings.

    // Send using SMTP.
    $mail->isSMTP();

    // Set the SMTP server to send through.
    $mail->Host = 'smtp.gmail.com';

    // Enable SMTP authentication.
    $mail->SMTPAuth = TRUE;

    // SMTP username.
    $mail->Username = 'utkarshsingh737091@gmail.com';

    // SMTP password.
    $mail->Password = 'hjsywaewazhjfblw';

    // Enable implicit TLS encryption.
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`.
    $mail->Port = 465;

    //Recipients.
    $mail->setFrom('utkarshsingh737091@gmail.com', 'Mailer');

    //Add a recipient.
    $mail->addAddress('utkarshsingh737091@gmail.com');

    // Content.

    //Set email format to HTML
    $mail->isHTML(TRUE);
    $mail->Subject = 'Customer Details';
    $mail->Body = 'Name = ' .
      $name . " " . 'Email = ' . $email . " " . 'Phone = '
      . $phone . " " . 'Amount Due = ' . $payableAmount;
    $mail->send();
  } catch (Exception $e) {

    $error = "There is found some issues.";
  }


/**
 * Create the new instace of class Fpdf.
 */
$pdf = new Fpdf();

// Adding The page.
$pdf->AddPage();
$pdf->SetFont('Arial', "", 15);
$pdf->Cell(0, 10, "Customer Details", 0, 1, "C");

$pdf->Cell(45, 15, "Name: ", 0, 0, "");
$pdf->Cell(76, 15, $name, 0, 1, "");

$pdf->Cell(45, 15, "Email: ", 0, 0, "");
$pdf->Cell(76, 15, $email, 0, 1, "");

$pdf->Cell(45, 15, "Phone:", 0, 0, "");
$pdf->Cell(76, 15, $phone, 0, 1, "");
$pdf->Cell(45, 15, "Amount Due:", 0, 0, "");
$pdf->Cell(76, 15, $payableAmount, 0, 1, "");

$file = time() . ".pdf";
$pdf->output();
}
