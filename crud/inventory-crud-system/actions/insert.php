<?php
require __DIR__ . '/../config/db.php';

$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];
$category = $_POST['category'];
$quantity = $_POST['quantity'];

// IMAGE
$imageName = time() . "_" . $_FILES['image']['name'];
$imageTmp = $_FILES['image']['tmp_name'];
$imagePath = "uploads/" . $imageName;
move_uploaded_file($imageTmp, "../" . $imagePath);

// GALLERY
$galleryArr = [];

if (!empty($_FILES['gallery']['name'][0])) {
    foreach ($_FILES['gallery']['name'] as $key => $val) {
        $gName = time() . "_" . $val;
        $gTmp = $_FILES['gallery']['tmp_name'][$key];
        $gPath = "uploads/" . $gName;
        move_uploaded_file($gTmp, "../" . $gPath);
        $galleryArr[] = $gPath;
    }
}

$galleryJson = json_encode($galleryArr);

$stmt = $conn->prepare("INSERT INTO protable (name, description, price, category, quantity, image, gallery) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssdssss", $name, $description, $price, $category, $quantity, $imagePath, $galleryJson);
$stmt->execute();

header("Location: ../index.php");