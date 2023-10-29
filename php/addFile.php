<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productName = $_POST['productName'];
    $price = $_POST['price'];
    $size = $_POST['size'];
    $styleId = $_POST['styleId'];
    $colorway = $_POST['colorway'];
    $retailPrice = $_POST['retailPrice'];
    $releaseDate = $_POST['releaseDate'];
    $description = $_POST['description'];

    $formattedDate = date("Y-m-d", strtotime($releaseDate));
    
    if (!empty($_FILES['file'])) {
        $file = $_FILES['file'];
        $name = $file['name'];
        $pathFile = __DIR__ . '/../img/' . $name;

        if (move_uploaded_file($file['tmp_name'], $pathFile)) {
            try {
                $stmt = $db->prepare("INSERT INTO products (productName, price, size, styleId, colorway, retailPrice, releaseDate, path, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([$productName, $price, $size, $styleId, $colorway, $retailPrice, $formattedDate, $name, $description]);
                echo "Product added successfully";
            } catch (PDOException $e) {
                echo "Error inserting data into the database: " . $e->getMessage();
            }
        } else {
            echo "Error uploading the file.";
        }
    }
    header("Location: admin.php");
}
?>
