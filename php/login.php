<!DOCTYPE html>
<html>
<head>
    <title>ADMIN - Login</title>
    <link rel="stylesheet" href="../css/login.css">
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
            <h2 class="p">Admin login</h2>
            <form method="post" action="check_password.php">
                <input type="password" name="password" class="inputPass" placeholder="Password"><br>
                <input type="submit" value="Login" class="app-form-button">
            </form>
        </div>
    </div>
</body>
</html>
