<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SneakerZone</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/fancy.css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Bowlby+One" />
</head>
<body>
<?php include 'php/db.php'; ?>
<div class="navbar">
    <div class="navColumn columnLeft">
        <a href="index.php" class="nav home active">Home</a>
        <a href="#products" class="nav products">Products</a>
        <a href="#info" class="nav information">Information</a>
        <a href="php/contact.php" class="nav contact">Contact</a>
    </div>
    <div class="navColumn">
        <a href="index.php" class="nav logo"><img src="img/logo.png" alt="logo" id="logo"></a>
    </div>
    <div class="navColumn">
        <a href="php/login.php" class="nav login"><img src="img/login.jpg" alt="login" id="loginIcon"></a>
    </div>
</div>

<div class="introImage">
        <img src="img/introSneakers.jpg" alt="jordan4" id="jordanIntroImg">
        <p class="typing fancy"></p>
</div>

<div class="main">
    <div class="mainContainer">

    <div class="twoBox">
            <div class="boxContainer">
                <div class="box">
                    <h3>What is makes unique</h3>
                    <p>A rare sneaker is defined by its scarcity, often stemming from limited production runs, exclusive collaborations, or vintage appeal. What makes them unique is their ability to command high prices in the sneaker market, driven by avid collectors and enthusiasts seeking distinct designs, historical significance, and a sense of exclusivity.</p>
                </div>
                <div class="box">
                    <h3>Why people collect them</h3>
                    <p>Rare sneakers, coveted for their limited availability and unique designs, captivate collectors for several reasons. These exclusive kicks symbolize individuality and style, making a fashion statement. Additionally, they often appreciate in value, appealing to both sneaker enthusiasts and investors.</p>
                </div>
            </div>
        </div>

        <div class="collection">
            <h2 class="clH" id="products">Our Collection</h2>
            <div class="cardContainer">

                <?php
                    try {
                    $stmt = $db->query("SELECT id, productName, price, size, styleId, colorway, retailPrice, releaseDate, path, description	 FROM products");
                    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    } catch (PDOException $e) {
                    echo "Error fetching data from the database: " . $e->getMessage();
                    }
                ?>
                <?php foreach($results as $row): ?>
                <div class="card">
                    <a href="php/product.php?id=<?= $row['id']?>">
                    <img src="img/<?= $row['path']; ?>" id="productImg" alt="sneaker">
                    <p class="cardName"><?= $row['productName']; ?></p>
                    <p>&euro;<?= $row['price']; ?></p>
                    </a>
                </div>
                <?php endforeach ?>

            </div>
        </div>


        <div class="history">
            <div class="historyCont" id="info">
                <h3>History about sneaker mode</h3>
                <div class="historyBox">
                <p>Sneaker culture has a rich history dating back to the early 20th century. Sneakers, initially designed for sports performance, gained popularity as casual footwear in the 1950s and 60s. The term "sneaker" originated because rubber soles allowed wearers to move quietly. Iconic brands like Converse's Chuck Taylor All-Stars and Nike's Air Jordan series emerged, becoming cultural symbols.

In the 1980s, sneaker collaborations with athletes and celebrities, like Michael Jordan, elevated their status. The 1990s saw the emergence of streetwear, boosting the sneaker's prominence. The 2000s ushered in sneakerheads, enthusiasts who collected, traded, and customized sneakers, leading to the rise of sneaker boutiques and resale markets.

Today, sneaker culture transcends sports and fashion, representing self-expression, artistry, and a global community deeply connected through a shared passion for kicks.</p>
                <img src="img/historyPic.jpg" alt="picture" id="historyPic">
            </div>
            </div>
        </div>
    </div>
</div>

<div class="footer">
    <div class="footerContainer">
        <img src="img/logoWhite.png" alt="logo" class="logoFooter">
        <div class="footerInfo">
            <p>@sneakerzone</p>
            <p>info@sneakerzone.com</p>
        </div>
    </div>
    <br>
    <div class="credit">&copy;2023 - Made by Dima Pavlov - 088894</div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.12/typed.min.js" referrerpolicy="no-referrer"></script>    
<script src="index.js"></script>
</body>
</html>