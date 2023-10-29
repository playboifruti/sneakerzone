<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = date("Y-m-d");
    $item = $_POST['productName'];
    $price = $_POST['price'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $formattedDate = date("Y-m-d", strtotime($date));

    $to = $email;
    $subject = "Order Confirmation";
    $messageBody = "Hi, " . $name . " Thank you for your order"; 
    $headers = "From: dima.ninja07@gmail.com";

    if(mail($to, $subject, $messageBody, $headers)) {
        echo '<div class="box">
        <img src="../img/succes.png" alt="confirmed">
        <h2>YOUR ORDER IS CONFIRMED</h2>
        <h3>Thank you <?= $name ?></h3>
        <p>Check your email inbox for order confirmation</p>
    </div>';

        $stmt = $db->prepare("INSERT INTO orderDB (date, name, price, item, email) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$formattedDate, $name, $price, $item, $email]);

        $id = $db->lastInsertId();
    } else {
        echo "error";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="../css/orderConf.css">
    <link rel="stylesheet" type="text/css" href="../css/fancy.css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Bowlby+One" />
    <title>Order Confirmation</title>
</head>
<body>

    
</body>
</html>