<?php
require __DIR__ . '/../config/db.php';

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM protable WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: ../index.php");