<?php
require __DIR__ . '/../config/db.php';

$id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];
$category = $_POST['category'];
$quantity = $_POST['quantity'];
$old_image = $_POST['old_image'];
$old_gallery = $_POST['old_gallery'];

// IMAGE UPDATE
if (!empty($_FILES['image']['name'])) {
    $imageName = time() . "_" . $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];
    $imagePath = "uploads/" . $imageName;

    move_uploaded_file($tmp, "../" . $imagePath);

    if (!empty($old_image) && file_exists("../" . $old_image)) {
        unlink("../" . $old_image);
    }
} else {
    $imagePath = $old_image;
}

// GALLERY UPDATE
if (!empty($_FILES['gallery']['name'][0])) {
    $galleryArr = [];

    foreach ($_FILES['gallery']['name'] as $key => $val) {
        $gName = time() . "_" . $val;
        $gTmp = $_FILES['gallery']['tmp_name'][$key];
        $gPath = "uploads/" . $gName;

        move_uploaded_file($gTmp, "../" . $gPath);
        $galleryArr[] = $gPath;
    }

    $galleryJson = json_encode($galleryArr);
} else {
    $galleryJson = $old_gallery;
}

$stmt = $conn->prepare("UPDATE protable SET name=?, description=?, price=?, category=?, quantity=?, image=?, gallery=? WHERE id=?");
$stmt->bind_param("ssdssssi", $name, $description, $price, $category, $quantity, $imagePath, $galleryJson, $id);
$stmt->execute();

header("Location: ../index.php");