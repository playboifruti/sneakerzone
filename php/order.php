
<?php include 'db.php'; ?>
<?php 
$productName = $price = $size = $colorway = $retailPrice = $releaseDate = $image = $description = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $db->prepare("SELECT id, productName, price, size, styleId, colorway, retailPrice, releaseDate, path, description FROM products WHERE id = ?");
    $stmt->execute([$id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        $productName = $product['productName'];
        $price = $product['price'];
        $size = $product['size'];
        $styleId = $product['styleId'];
        $colorway = $product['colorway'];
        $retailPrice = $product['retailPrice'];
        $releaseDate = $product['releaseDate'];
        $image = $product['path'];
        $description = $product['description'];
    } else {
        echo "Product not found.";
    }
} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <link rel="stylesheet" href="../css/order.css">
    <link rel="stylesheet" type="text/css" href="../css/fancy.css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Bowlby+One" />
    <title>Order</title>
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

<div class="main">
        <div class="mainSection"> 
        <div class="mainContent">
          <form class="form" action="orderConfirmation.php" method="post">
             <table class="tableForm">
                <tr>
                    <td>Product Name:</td>
                    <td><input class="inputProduct" type="text" name="productName" value="<?= $productName ?>" readonly><br></td>
                </tr>
                <tr>
                    <td>Size EU:</td>
                    <td><input class="inputProduct" type="text" name="size" value="<?= $size ?>" readonly><br></td>
                </tr>
                <tr>
                    <td>Color Way:</td>
                    <td><input class="inputProduct" type="text" name="colorWay" value="<?= $colorway ?>" readonly><br></td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td><input class="inputProduct" type="text" name="price" value=" <?= $price ?>" readonly></td>
                </tr>
                <tr>
                    <td>Name:</td>
                    <td><input type="text" name="name" class="inputClass" required></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="email" name="email" class="inputClass" required></td>
                </tr>
                <tr>
                    <td colspan="2" class="submitTd"><input type="submit" value="Place Order" class="submitOrder"></td>
                </tr>
             </table>
          </form>
        </div>
        </div>
</div>

<div class="footer">
    <div class="footerContainer">
        <img src="../img/logoWhite.png" alt="logo" class="logoFooter">
        <div class="footerInfo">
            <p>@sneakerzone</p>
            <p>info@sneakerzone.com</p>
        </div>
    </div>
    <br>
    <div class="credit">&copy;2023 - Made by Dima Pavlov - 088894</div>
</div>
    
</body>
</html>