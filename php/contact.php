<?php
include 'db.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $phone = $_POST['phone'];
      $company = $_POST['company'];
      $message = $_POST['message'];

      $name = htmlspecialchars($name);
      $email = filter_var($email, FILTER_SANITIZE_EMAIL);
      $phone = htmlspecialchars($phone);
      $company = htmlspecialchars($company);
      $message = htmlspecialchars($message);

      $to = "dima.ninja07@gmail.com";
      $subject = "Contact Form Submission";
      $messageBody = "Name: $name\nEmail: $email\nPhone: $phone\nCompany: $company\nMessage: $message";
      $headers = "From: $email";

      if (mail($to, $subject, $messageBody, $headers)) {
        echo '<script>alert("✅Message has been successfully sent.")</script>';

          $stmt = $db->prepare("INSERT INTO contactDB (name, email, phone, company, message) VALUES (?, ?, ?, ?, ?)");
          $stmt->execute([$name, $email, $phone, $company, $message]);

          $id = $db->lastInsertId();
      } else {
          echo "Sorry, there was an error processing your request. Please try again later.";
      }
    } 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Contact </title>
    <link rel="stylesheet" href="../css/contact.css">
</head>
<body>
<div class="navbar">
    <div class="navColumn columnLeft">
        <a href="../index.php" class="nav home active">Home</a>
        <a href="../index.php#products" class="nav products">Products</a>
        <a href="../index.php#info" class="nav information">Information</a>
        <a href="contact.php" class="nav contact">Contact</a>
    </div>
    <div class="navColumn">
        <a href="../index.php" class="nav logo"><img src="../img/logo.png" alt="logo" id="logo"></a>
    </div>
    <div class="navColumn">
        <a href="admin.php" class="nav login"><img src="../img/login.jpg" alt="login" id="loginIcon"></a>
    </div>
</div>
    <div class="container">
        <div class="screen">
            <h2 class="p">Contact Us</h2>
            <form method="post" action="contact.php">
            <input class="input" type="text" id="name" name="name" placeholder="Name*" required><br>
            <br>
            <input class="input" type="email" id="email" name="email" placeholder="Email*" required><br>
            <br>
            <input class="input" type="number" id="phone" name="phone" placeholder="Phone"><br>
            <br>
            <input class="input" type="text" id="company" name="company" placeholder="Company (Optional)"><br>
            <br>
            <textarea class="inputArea" name="message" id="message" cols="30" rows="3" placeholder="Message*" name="message" required></textarea><br>
            <br>
            <input class="app-form-button" type="submit" value="Toevoegen">
            </form>
        </div>
    </div>
</body>
</html>
