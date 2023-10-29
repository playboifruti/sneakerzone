<?php
session_start();

if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header('Location: login.php');
    exit();
}

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['section'])) {
    $section = $_POST['section'];
}

include 'sectionsAdmin.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" type="text/css" href="../css/fancy.css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Bowlby+One" />
    <title>ADMIN - SNEAKERZONE</title>
</head>
<body>
<div class="navbar">
    <div class="navColumn columnLeft">
        <?php
        $current_time = date("H:i");
        $next_minute = date("H:i", strtotime($current_time . " +1 hour"));
        $current_date = date("D. d M");
        ?>
        <span class="nav time"><?php echo $next_minute ?></span>
        <span class="nav date"><?php echo $current_date ?></span>
    </div>
    <div class="navColumn">
        <a href="../index.php" class="nav logo"><img src="../img/logo.png" alt="logo" id="logo"></a>
    </div>
    <div class="navColumn">
        <a href="logout.php" class="nav login"><img src="../img/logout.png" alt="login" id="loginIcon"></a>
    </div>
</div>
<div class="main">
    <div class="mainBox">
        <div class="sectionTop">
            <h3>ADMIN DASHBOARD</h3>
        </div>
        <div class="leftCol">
            <div class="sections">
                <p class="sectionButton <?php echo $section === 'products' ? 'active' : ''; ?>">
                    <a href="?section=products" class="secA">
                        <img class="sectionIcon" src="../img/adminProduct.png" alt="homeIcon"> Products
                    </a>
                </p>
                <p class="sectionButton <?php echo $section === 'orders' ? 'active' : ''; ?>">
                    <a href="?section=orders" class="secA">
                        <img class="sectionIcon" src="../img/adminOrder.png" alt="homeIcon"> Order
                    </a>
                </p>
                <p class="sectionButton <?php echo $section === 'messages' ? 'active' : ''; ?>">
                    <a href="?section=messages" class="secA">
                        <img class="sectionIcon" src="../img/adminMess.png" alt="homeIcon"> Messages
                    </a>
                </p>
            </div>
        </div>
        <div class="rightCol">
            <div id="content">
                <?php
                if ($section === 'orders') {
                    echo '<h2>Orders</h2>
                    <div class="table-container">
                        <table class="tableOrders">
                            <tr class="trOrders">
                                <th class="thOrders">Order</th>
                                <th class="thOrders">Date</th>
                                <th class="thOrders">Customer</th>
                                <th class="thOrders">Email</th>
                                <th class="thOrders">Price</th>
                                <th class="thOrders">Items</th>
                            </tr>';
                    try {
                        $stmt = $db->query("SELECT id, date, name, price, item, email FROM orderDB");
                        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    } catch (PDOException $e) {
                        echo "Error fetching data from the database: " . $e->getMessage();
                    }

                    foreach ($results as $row) {
                        $orderID = $row['id'];
                        $orderDate = $row['date'];
                        $customerName = $row['name'];
                        $orderPrice = $row['price'];
                        $orderItems = $row['item'];
                        $email = $row['email'];

                        echo "<tr class='trOrdersList'>
                            <td id='orderID'>#$orderID</td>
                            <td>$orderDate</td>
                            <td>$customerName</td>
                            <td>$email</td>
                            <td>&euro; $orderPrice</td>
                            <td>$orderItems</td>
                        </tr>";
                    }

                    echo '</table>
                    </div>';
                } elseif ($section === 'messages') {
                    try {
                        $stmt = $db->query("SELECT id, name, email, phone, company, message FROM contactDB");
                        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    } catch (PDOException $e) {
                        echo "Error fetching data from the database: " . $e->getMessage();
                    }

                    echo '<h2>Messages</h2>
                          <div class="table-containerMess">';
                    foreach ($results as $row) {
                        $cusName = $row['name'];
                        $cusEmail = $row['email'];
                        $cusPhone = $row['phone'];
                        $cusCompany = $row['company'];
                        $cusMessage = $row['message'];

                        echo '<div class="message">
                                <h3 id="cusName">' . $cusName . '</h3>
                                <p id="cusEmail">' . $cusEmail . '</p>
                                <p id="cusPhone">' . $cusPhone . '</p>
                                <p id="cusCompany">' . $cusCompany . '</p>
                                <p id="cusMessage">' . $cusMessage . '</p>
                        </div>';
                    } echo "</div>";
                    
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $fromEmail = "dima.ninja07@gmail.com";
                        $to = $_POST['email'];
                        $subject = $_POST['theme'];
                        $messageBody = $_POST['message'];
                        $headers = "FROM: $fromEmail";
                        
                        if (mail($to, $subject, $messageBody, $headers)) {
                            echo '<script>alert("✅ Message has been successfully sent.")</script>';
                        } else {
                            echo '<script>alert("❌ Sorry, there was an error sending the message. Please try again later.")</script>';
                        }                        
                    }

                    echo '<div class="replyCont">
                        <h2>Reply Message</h2>
                            <form method="post" action="admin.php?section=messages">
                                <input type="email" name="email" placeholder="Email*" class="input"><br>
                                <input type="text" name="theme" class="input" placeholder="Theme"><br>
                                <textarea class="inputArea" name="message" id="message" cols="30" rows="3" placeholder="Message*" required></textarea><br>
                                <input class="app-form-button" type="submit" value="Send">
                            </form>
                        </div>';

                } elseif ($section === 'products') {
                    echo '<div class="table-containerProduct">
                    <h2>Add product</h2>
                    <div class="addProduct">
                        <form method="post" action="addFile.php" enctype="multipart/form-data">
                            <input type="text" name="productName" class="input pr" placeholder="Product Name"><br>
                            <input type="number" name="price" class="input pr" placeholder="Price"><br>
                            <input type="number" name="size" class="input pr" placeholder="Size"><br>
                            <input type="text" name="styleId" class="input pr" placeholder="Style ID"><br>
                            <input type="text" name="colorway" class="input pr" placeholder="Colorway"><br>
                            <input type="number" name="retailPrice" class="input pr" placeholder="Retail Price"><br>
                            <input type="date" name="releaseDate" class="input pr" placeholder="Release Date"><br>
                            <input type="file" name="file" class="app-form-control" value="Upload Image"><br>
                            <textarea class="inputArea" type="text" name="description" id="description" cols="30" rows="3" placeholder="description*" required></textarea><br>
                            <input class="app-form-button" type="submit" value="Add Product">
                        </form>
                    </div>
                </div>';

                    try {
                        $stmt = $db->query("SELECT id, productName, price, size, styleId, colorway, retailPrice, releaseDate, path, description	 FROM products");
                        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    } catch (PDOException $e) {
                        echo "Error fetching data from the database: " . $e->getMessage();
                    }

                    $deleteId = null;
                    if (isset($_POST['delete'])) {
                        $deleteId = $_POST['id'];
                        try {
                            $stmt = $db->prepare("DELETE FROM products WHERE id = ?");
                            $stmt->execute([$deleteId]);
                            echo '<script>alert("✅ID ' . $deleteId . ' is succesvol verwijderd uit de database")</script>';
                        } catch (PDOException $e) {
                            echo "Fout bij het verwijderen: " . $e->getMessage();
                        }
                    }
                    echo '<div class="products">
                    <h2>Products</h2>';
                    foreach ($results as $row) {
                        $id = $row['id'];
                        $productName = $row['productName'];
                        $price = $row['price'];
                        $styleId = $row['styleId'];
                        $path = $row['path'];

                        if ($id != $deleteId) {
                        echo '<div class="productCard">
                            <img src="../img/' . $path . '" alt="" id="productImg">
                            <div class="productInfo">
                                <p id="productName">' . $productName . '</p>
                                <p id="price">' . $price . '</p>
                                <p id="style">' . $styleId . '0</p>
                                <form action="" method="POST">
                                <input type="hidden" name="id" value="' . $id . '">
                                <input class="app-form-button-bordered" type="submit" name="delete" value="Delete">
                                </form>
                            </div>
                        </div>';
                        }
                    }
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
