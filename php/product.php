<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/product.css">
    <link rel="stylesheet" type="text/css" href="../css/fancy.css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Bowlby+One" />
    <title>Product</title>
</head>
<body>
<?php include 'db.php'; ?>
<?php
$productName = $price = $size = $colorway = $retailPrice = $releaseDate = $image = $description = "";

try {
    $stmt = $db->query("SELECT id, productName, price, size, styleId, colorway, retailPrice, releaseDate, path, description FROM products");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error fetching data from the database: " . $e->getMessage();
}

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

<div class="mainBody">
    <div class="mainContent">
        <div class="productColumn">
            <img src="../img/<?= $image ?>" alt="productImg" class="productPic">
        </div>
        <div class="productColumn">
            <h1 id="productName"><?= $productName;; ?></h1>
            <p style="font-size: 16px; color: #555; margin-top: 20px;">Price</p>
            <p id="price">&euro; <?= $price ?></p>
            <p style="font-size: 16px; color: #555; margin-top: 20px;">Size</p>
            <div id="productSize" onclick="changeStyle()"><?= $size ?></div>
            <br>
            <a href="order.php?id=<?= $id ?>" class="order">ORDER NOW</a>
        </div>
    </div>
    <div class="productDetails">
        <h3>Product Details</h3>
        <table>
            <tr>
                <td>Style</td>
                <td class="tdInput"><?= $styleId ?></td>
                <td rowspan="4" class="tdDiscription">
                    <b>Product Description</b>
                    <br>    
                    <?= $description ?>   
                </td>
            </tr>
            <tr>
                <td>Colorway</td>
                <td class="tdInput"><?= $colorway ?></td>
            </tr>
            <tr>
                <td>Retail Price</td>
                <td class="tdInput">&euro;<?= $retailPrice ?></td>
            </tr>
            <tr>
                <td>Release Date</td>
                <td class="tdInput"><?= $releaseDate ?></td>
            </tr>
 
        </table>
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


<script src="../js/functions.js"></script>
</body>
</html>